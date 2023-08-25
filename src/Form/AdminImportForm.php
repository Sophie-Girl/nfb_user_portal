<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;

class AdminImportForm extends FormBase
{
    public $user_id;
    public function get_user_id()
    {
        return $this->user_id;
    }
    public $reset_link;
    public function get_reset_link()
    {
        return $this->reset_link;
    }
    public function getFormId()
    {
        return "nfb_user_import_form";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        );
        return $form;

    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        ini_set('max_execution_time', 50000); // make sure it can process big files
        $file = DRUPAL_ROOT."/modules/custom/nfb_user_portal/src/csv/upload.csv";
        $this->Import_CSV($file, $contacts);
       $bad_contacts['0'] = array(
            'first_name' => "first_name",
            "last_name" => "last_name",
            "email" => "email",
            "contact_id" => "contact_id",
            "reason_for_rejection" => "reason_for_rejection"
        );

        foreach ($contacts as $contact)
        {
            $add = "no";
            $email_test = trim($contact['email']);
            if (filter_var($email_test, FILTER_VALIDATE_EMAIL)) {
                // if email good. Proceed.
                $run = $this->check_email_in_user($email_test);
                if ($run == "New") {
                    $new_user = $this->check_if_civi_id_in_use($contact);
                    if ($new_user == "yes") {

                        $this->create_user($contact);
                        $civi = new query_base();
                        $this->find_uf_match($civi, $contact);
                        $this->emial_functions($contact);
                    } else {
                        $add = "contact ID in use";
                    }
                } else {
                    $add = "email in use";
                }
            } else {
                $add = "invalid email";
            }
            if ($add != "no") {
                $bad_contacts[$contact['contact_id']] = array(
                    'first_name' => $contact['first_name'],
                    "last_name" => $contact['last_name'],
                    "email" => trim($contact['email']),
                    "contact_id" => $contact['contact_id'],
                    "reason_for_rejection" => $add
                );
            }
        }
        $data = $bad_contacts; $fileName = DRUPAL_ROOT."/sites/default/files/bad_user_requests_".date('m-d-y').'.csv';
        $this->download_report($fileName, $data);

      /*  foreach ($contacts as $contact) {
            $civi = new query_base();
            $civi->entity = "GroupContact";
            $civi->params = [
                'values' => [
                    'group_id' => 713,
                    'contact_id' => $contact['contact_id'],
                    'status' => 'Added',
                ],
                'checkPermissions' => FALSE,
            ];
            $civi->mode = "create";
            $civi->civi_api_v4_query();
        } */
    }
    public function check_if_civi_id_in_use($contact)
    {
        $civi = new query_base();
        $civi->entity = "UFMatch";
        $civi->mode = "get";
        $civi->params = array(
            'select' => [
                '*',
            ],
            'where' => [
                ['contact_id', '=', $contact['contact_id']],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
            );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        if ($result->count() > 0)
        {
            $run = "no";
        }
        else{
            $run = "yes";
        }
        return $run;
    }
    Public Function Import_CSV($file, &$contacts)
    {
        $contacts = $fields = array(); $i=0;
        $handle =  @fopen($file, "r" );
        if ($handle) {
            while (($row = fgetcsv($handle, 500)) !== false) {
                if (empty($fields)) {
                    $fields = $row;
                    continue;}
                foreach ($row as $k => $value) {
                    $contacts[$i][$fields[$k]] = $value;}
                $i++;}
            if (!feof($handle)) {
                echo PHP_EOL . "Error: unexpected fgets() fail\n";}
            fclose($handle);} // read in file for uplaod and tern it into associative array
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function create_user($contact)
    {
        $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
        $user = \Drupal\user\Entity\User::create();
        // set_up_needs
        $user->setPassword($this->generateRandomString());
        $user->enforceIsNew();
        $user->setEmail(trim($contact['email']));
        $user->setUsername(trim($contact['email']));
        // Optional.
        $user->set('init', 'email');
        $user->activate();

        // Save user account.
        $result = $user->save();
        $this->user_id = $user->id();
        $this->reset_link = user_pass_reset_url($user);
    }

    public function civi_user_set_up($contact)
    {
        $civi = new query_base();
        $this->find_uf_match($civi, $contact);

    }

    public function find_uf_match(query_base $civi, $contact)
    {
        $civi->entity = "UFMatch";
        $civi->mode = "get";
        $civi->params = array(

            'select' => [
                '*',
            ],
            'where' => [
                ['uf_id', '=', $this->get_user_id()],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,

        );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        if ($count == 0) {
            $civi->mode = "create";
            $civi->params = array(
                'values' => [
                    'domain_id' => 1,
                    'uf_id' => $this->get_user_id(),
                    'contact_id' => $contact['contact_id'],
                ],
                'checkPermissions' => FALSE,
            );
            $civi->civi_api_v4_query();
        } else {
            $uf_match = $result->first();
            $id = $uf_match['id'];
            $old_id = $uf_match['contact_id'];
            $civi->mode = "update";
            $civi->params = array(
                'values' => [
                    'contact_id' => $contact['contact_id'],
                ],
                'where' => [
                    ['id', '=', $id],
                ],
                'checkPermissions' => FALSE,
            );
            $civi->civi_api_v4_query();
        }
    }

    public function check_email_in_user($email_test)
    {
        $username = $email_test;
        $ids = \Drupal::entityQuery('user')
            ->condition('name', trim($username))
            ->range(0, 1)
            ->execute();
        if (!empty($ids)) {
            $exists = "Not New";
        } else {
            $exists = "New";
        }
        if($exists == "New")
        {
            $ids = \Drupal::entityQuery('user')
                ->condition('mail', trim($username))
                ->range(0, 1)
                ->execute();
            if (!empty($ids)) {
                $exists = "Not New";
            } else {
                $exists = "New";
            }
        }
        return $exists;
    }
    public function emial_functions($contact)
    {
        $array = $this->civi__find_id();
        $template = $array['text'];
        $subject = $array['subject'];
        $template = str_replace("{display_name}", $contact['contact_name'], $template);
        $template = str_replace("{display_email}", $contact['email'], $template);
        $template = str_replace("{reset_link}", $this->reset_link, $template);
        $template = str_replace("{contact.first_name}", $contact['contact_name'], $template);
        $recipient_email = trim($contact['email']);
        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'nfb_user_portal';
        $key = 'nfb_user_portal_complete';
        $to = $contact['email'];
        $send = true;
        $params['message'] = $template;
        $params['subject'] = $subject;
        $langcode = "en";
        $result = $mailManager->mail($module, $key, $to, $langcode, $params, $send);
    }
    public function find_tempalte_id()
    {
        $sql = new User_request_queries();
        $query = "select * from nfb_user_portal_templates 
where type_id = '1';";
        $key = 'tid';
        $sql->select_query($query, $key);
        $result = $sql->get_result();
        $template_id = null;
        foreach ($result as $string) {
            $string = get_object_vars($string);
            if($template_id == null){
            $template_id = $string['template_id'];}
        }
        if($template_id == null) {
        $template_id = "139";
        }
        return $template_id;
    }

    public function civi__find_id()
    {
        $civi = new query_base();
        $civi->entity = "MessageTemplate";
        $civi->mode = "get";
        $civi->params = array(
            'select' => [
                '*',
            ],
            'where' => [
                ['id', '=', $this->find_tempalte_id()],
            ],
            'limit' => 1,
            'checkPermissions' => FALSE,
        );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $template_array = $result->first();
        $template['text'] = $template_array['msg_text'];
        $template['subject'] = $template_array['msg_subject'];
        return $template;
    }
    public function set_headers($fileName)
    {
        ob_clean();
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $fileName);
    }
    public function check_file_size($data, $fileName, &$file, &$size)
    {
        if (isset($data['0'])) {
            $fp = fopen($fileName, 'w');
            fputcsv($fp, array_keys($data['0']));
            foreach ($data AS $values) {
                fputcsv($fp, $values);}

            fclose($fp);}
        ob_flush();

        $file = file_get_contents($fileName);
        $size = @filesize($fileName);
    }
    public function file_download($file, $size, $fileName)
    {
        if (strlen($file) > 0) {

            ob_start();  // buffer all but headers
            ob_end_clean();  // headers get sent, erase all buffering and enable output
            header("Content-type: text/csv");
            header("Content-length: " . $size);
            header('Pragma: public');
            header("Content-Description: PHP Generated Data");
            $new_file_name = str_replace(DRUPAL_ROOT."/sites/default/files/","", $fileName);
            header('Content-Disposition: attachment; filename="' .$new_file_name. '"');
            header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            echo "\xEF\xBB\xBF";
            echo $file;
            unlink($fileName);
            }
    }
    public function download_report($fileName, $data)
    {
        $this->set_headers($fileName);
        $this->check_file_size($data, $fileName, $file, $size);
        $this->file_download($file, $size, $fileName);
    }
}