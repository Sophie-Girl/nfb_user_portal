<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;

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
        ini_set('max_execution_time', 1300); // make sure it can process big files
        $file = DRUPAL_ROOT."/modules/custom/nfb_user_portal/src/csv/data.csv";
        \Drupal::logger("file_reading_text")->notice("File name: ".$file);
        $this->Import_CSV($file, $contacts);
        foreach ($contacts as $contact)
        {
          $email_test =  $contact['email'];
            if (filter_var($email_test, FILTER_VALIDATE_EMAIL)){
                // if email good. Proceed.
               $run =  $this->check_email_in_user($email_test);
               if($run == "New")
               {
                   $this->create_user($contact);
                   $civi = new query_base();
                   $this->find_uf_match($civi, $contact);

               }
            }
        }
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
        $user->setEmail($contact['email']);
        $user->setUsername($contact['email']);
        // Optional.
        $user->set('init', 'email');
        $user->activate();

        // Save user account.
        $result = $user->save();
        $this->user_id = $user->id();
        $this->reset_link = user_pass_reset_url($user);
        \Drupal::logger("url_check")->notice("usl: ".$this->get_reset_link());
    }

    public function civi_user_set_up()
    {
        $civi = new query_base();
        $this->find_uf_match($civi);

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
                    'contact_id' => $contact['civi_id'],
                ],
                'checkPermissions' => FALSE,
            );
            $civi->civi_api_v4_query();
        } else {
            $uf_match = $result->first();
            $id = $uf_match['id'];
            $civi->mode = "update";
            $civi->params = array(
                'values' => [
                    'contact_id' => $contact['civi_id'],
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
            \Drupal::logger("error_stuff")->notice("entity:  I get here");
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
}