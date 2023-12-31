<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;
use Drupal\nfb_washington\civicrm\civi_query;
use Drupal\user;
use Drupal\civicrm\Civicrm;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\RedirectResponse;
class AdminCompleteRequestForm extends FormBase
{
    public $rid;

    public function get_rid()
    {
        return $this->rid;
    }

    public $name;
    public function get_name()
    {
        return $this->name;
    }

    public $email;

    public function get_email()
    {
        return $this->email;
    }

    public $page;

    public function get_page()
    {
        return $this->page;
    }
    public $status;

    public function get_status()
    {
        return $this->page;
    }

    public $sort;

    public function get_sort()
    {
        return $this->sort;
    }

    public $name_value;

    public function get_name_value()
    {
        return $this->name_value;
    }

    public $email_vlaue;

    public function get_email_value()
    {
        return $this->email_vlaue;
    }

    public $civi_id;

    public function get_civi_id()
    {
        return $this->civi_id;
    }

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
    public $f_name;
    public $l_name;
    public function get_f_name()
    {
        return $this->f_name;
    }
    public function get_l_name()
    {
        return $this->l_name;
    }

    public function getFormId()
    {
        return "nfb_user_admin_complete";
    }

    public function buildForm(array $form, FormStateInterface $form_state, $rid = "1")
    {
        $this->set_paging_requirments($rid);
        $this->sql_query();
        $form['intro_text'] = array(
            '#type' => "item",
            '#makrup' => "<p> Placeholder text: Uh jsut odn't reuse emails. IDK</p>"
        );
        $form['pass_along'] = array(
            '#type' => "textfield",
            '#title' => "",
            '#size' => 20,
            '#value' => $rid,
            '#attributes' => array('readonly' => 'readonly'),
        );
        $form['rid'] = array(
            '#type' => "textfield",
            '#title' => "",
            '#size' => 20,
            '#value' => $this->get_rid(),
            '#attributes' => array('readonly' => 'readonly'),
        );
        $form['civi_id'] = array(
            '#type' => "textfield",
            '#title' => "Member civi_id",
            '#size' => 20,
            '#value' => $this->get_civi_id(),
            '#attributes' => array('readonly' => 'readonly'),

        );
        $form['name'] = array(
            '#type' => "textfield",
            '#title' => "Member Name",
            '#size' => 20,
            '#value' => $this->get_name_value(),
            '#attributes' => array('readonly' => 'readonly'),

        );
        $form['email'] = array(
            '#prefix' => '<div class="hidden_val" id="default_email">'.$this->get_email_value().'</div>',
            '#type' => "textfield",
            '#title' => "Member email",
            '#size' => 20,


        );
        $form['status'] = array(
            '#type' => 'select',
            '#title' => "Status",
            '#required' => true,
            '#options' => array(
                '' => ' - select - ',
                'Pending' => "Pending",
                'Complete' => "Complete",
                "Rejected" => "Rejected",
                "Duplicate Email" => "Duplicate Email",
                "Duplicate Name" => "Duplicate Name"
            ),
        );
        $form['comments'] = array(
            '#type' =>  'textarea',
            '#title' => "Notes:",
            '#max' => 500,
        );
        $orig_string = $rid;
        $end = strpos($orig_string, "&%");
        $string = substr($orig_string, 0, $end);
        $this->rid = $this->string_parser($string);
        $start = $end + 2;
        $post_rid = substr($orig_string, $start, 200);
        $form['submit'] = array(
           '#prefix' => "<a href='/member_portal/admin/user_request/".$this->set_rediect_url($post_rid)."' style='display: inline-block' class='btn btn-primary' role='button' aria-label='Go Back to User Request Table'>&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;</a>",
            '#type' => 'submit',
            '#value' => $this->t('Submit'),)
        ;
        $form['#attached']['library'][] =  'nfb_user_portal/admin-complete';
        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        if ($form_state->getValue("status") != "Complete") {
            $this->update_database($form_state);
        } else {
            $this->set_values($form_state); // store values needed
            $this->create_user($form_state); // create user account and get user reset link
            $this->civi_user_set_up(); // Civi UF match functions
            $this->update_database($form_state); // finalize the datbase change
            $this->emial_functions($form_state); // send Email
        }
        $this->url__Re_directy($form_state);
    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state); // TODO: Change the autogenerated stub
        if ($form_state->getValue("status") == "Complete") {
            $this->check_email_in_user($form_state);
            $this->check_if_contact_id_in_use($form, $form_state);
        }
    }

    public function check_if_contact_id_in_use(&$form, FormStateInterface $form_state)
    {
        $civi = new query_base();
        $civi->entity = "UFMatch";
        $civi->mode = "get";
        $civi->params = array(
            'select' => [
                '*',
            ],
            'where' => [
                ['contact_id', '=', $form_state->getValue("civi_id")],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        if ($count > 0) {
            $form_state->setValue("status", "Duplicate Name");
            $form_state->setErrorByName("email", "User Already Exists");
        }
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

    public function set_values(FormStateInterface $form_state)
    {
        $this->civi_id = $form_state->getValue("civi_id");
        $this->email = $form_state->getValue("email");
        $this->rid = $form_state->getValue("rid");
    }

    public function create_user(FormStateInterface $form_state)
    {
        $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
        $user = \Drupal\user\Entity\User::create();
        // set_up_needs
        $user->setPassword($this->generateRandomString());
        $user->enforceIsNew();
        $user->setEmail($form_state->getValue("email"));
        $user->setUsername($form_state->getValue("email"));
        // Optional.
        $user->set('init', 'email');
        $user->activate();

        // Save user account.
        $result = $user->save();
        $this->user_id = $user->id();
        $this->reset_link = user_pass_reset_url($user);
    }

    public function civi_user_set_up()
    {
        $civi = new query_base();
        $this->find_uf_match($civi);

    }

    public function find_uf_match(query_base $civi)
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
                    'contact_id' => $this->get_civi_id(),
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
                    'contact_id' => $this->get_civi_id(),
                ],
                'where' => [
                    ['id', '=', $id],
                ],
                'checkPermissions' => FALSE,
            );
            $civi->civi_api_v4_query();
        }
    }

    public function check_email_in_user(FormStateInterface $form_state)
    {
        $username = $form_state->getValue("email");

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
        if ($exists == "Not New") {
            $form_state->setValue("status", "Duplicate Email");
            $form_state->setErrorByName("email", "That email address already is in use, please contact member for a new one if needed");
        }

    }

    public function set_paging_requirments($rid)
    {
        $orig_string = $rid;
        $end = strpos($orig_string, "&%");
        $string = substr($orig_string, 0, $end);
        $this->rid = $this->string_parser($string);
        $start = $end + 2;
        $post_rid = substr($orig_string, $start, 200);
        $new_end = strpos($post_rid, "&%");
        $string = substr($post_rid, 0, $new_end);
        $this->page = $string;
        $start = $new_end + 2;
        $post_page = substr($post_rid, $start, 200);
        $new_end = strpos($post_page, "&%");
        $string = substr($post_page, 0, $new_end);
        $this->name = $this->string_parser($string);
        $start = $new_end + 2;
        $post_name = substr($post_page, $start, 200);
        $end = strpos($post_name, "&%");
        $string = substr($post_name, 0, $end);
        $this->email = $this->string_parser($string);
        $start = $end + 2;
        $post_email = substr($post_name, $start, 200);
        $end = strpos($post_email, "&%");
        $string = substr($post_email, 0, $end);
        $this->status = $this->string_parser($string);
        $start = $end + 2;
        $post_status = substr($post_email, $start, 200);
        $end = strpos($post_status, "&%");
        $string = substr($post_status, 0, $end);
        $this->sort = $this->string_parser($string);
        if ($this->get_sort() == "" || $this->get_sort() == " ") {
            $this->sort= "rid";
        }


    }

    public function string_parser($string)
    {
        $string = str_replace("%20", " ", $string);
        $string = str_replace("%26", "&", $string);
        $string = str_replace("%25", "%", $string);
        $string = str_replace("%23", "#", $string);
        $string = str_replace("%40", "@", $string);
        $string = str_replace("%2E", ".", $string);
        $string = str_replace("%2F", "/", $string);
        return $string;
    }

    public function sql_query()
    {
        $query = "Select * from nfb_user_portal_user_request where  rid = '" . $this->get_rid() . "';";
        $key = 'rid';
        $sql = new User_request_queries();
        $sql->select_query($query, $key);
        $result = $sql->get_result();
        foreach ($result as $info) {
            $info = get_object_vars($info);
            $this->name_value = $info['member_name'];
            $this->email_vlaue = $info['member_email'];
            $this->civi_id = $info['civi_contact_id'];
        }

    }

    public function emial_functions($form_state)
    {
        $array = $this->civi__find_id();
        $template = $array['text'];
        $subject = $array['subject'];
        $this->set_names();
       $template = str_replace("{display_name}", $this->get_name(), $template);
        $template = str_replace("{display_email}", $this->get_email(), $template);
        $template = str_replace("{reset_link}", $this->get_reset_link(), $template);
        $template = str_replace("{contact.first_name}", $this->get_f_name(), $template);
        $template = str_replace("{contact.last_name}", $this->get_f_name(), $template);
        $recipient_email = $this->get_email();
        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'nfb_user_portal';
        $key = 'nfb_user_portal_complete';
        $to = $this->get_email();
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
        foreach ($result as $string){
            $string = get_object_vars($string);
            if($template_id == null) {
                $template_id = $string['template_id'];
            }}
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
    public function set_names()
    {
        $civi = new query_base();
        $civi->entity = "Contact";
        $civi->mode = "get";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['id', '=', $this->get_civi_id()],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query(); $result = $civi->get_civi_result();
        $contact = $result->first();
        $this->f_name = $contact['first_name'];
        $this->l_name = $contact['last_name'];

    }

    public function update_database(FormStateInterface $form_state)
    {

        $sql = new User_request_queries();
        $query = "update nfb_user_portal_user_request
        set status  = '" . $form_state->getValue("status") . "'
        where rid = '" . $form_state->getValue("rid") . "';";
        $sql->update_query($query);
        $query = "update nfb_user_portal_user_request
        set member_email  = '" . $form_state->getValue("email") . "'
        where rid = '" . $form_state->getValue("rid") . "';";
        $sql->update_query($query);
        $query = "update nfb_user_portal_user_request
        set comment  = '" . $form_state->getValue("comments") . "'
        where rid = '" . $form_state->getValue("rid") . "';";
        $sql->update_query($query);
    }

    public function url__Re_directy(FormStateInterface $form_state)
    {
        $rid = $form_state->getValue("pass_along");
        $orig_string = $rid;
        $end = strpos($orig_string, "&%");
        $string = substr($orig_string, 0, $end);
        $this->rid = $this->string_parser($string);
        $start = $end + 2;
        $post_rid = substr($orig_string, $start, 200);
        $url = "/member_profile/admin/user_request/".$this->set_rediect_url($post_rid);
        $ender = new RedirectResponse($url);
        $ender->send(); exit;

    }
    public function set_rediect_url($post_rid)
    {
        $post_rid = str_replace("%", "%25",  $post_rid);
        $post_rid = str_replace(" ", "%20", $post_rid);
        $post_rid = str_replace("&", "%26", $post_rid);
        $post_rid = str_replace("#", "%23",  $post_rid);
        $post_rid = str_replace("@", "%40",  $post_rid);
        $post_rid = str_replace(".", "%2E",  $post_rid);
        $post_rid = str_replace( "/", "%2F", $post_rid);
        $post_rid = str_replace("%26%25%26%25", "%26%25", $post_rid);
        return $post_rid;
    }
}