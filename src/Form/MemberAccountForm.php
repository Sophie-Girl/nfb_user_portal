<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\facets\Exception\Exception;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\html_builder\member_account;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;
use Drupal\user\Entity\User;
use Drupal\nfb_user_portal\html_builder\core_markup;


class MemberAccountForm extends FormBase
{
    public $old_user_name;
    public function get_old_user_name()
    {
        return $this->old_user_name;
    }
    public $new_user_name;
    public function get_new_user_name(){
        return $this->new_user_name;
    }
    public $user_name_email_template;
    public function get_user_name_email_template()
    {return $this->user_name_email_template;}
    public $password_email_template;
    public function get_password_email_template()
    {return $this->password_email_template;}
    public $user_id;
    public function get_user_id()
    {return $this->user_id;}
    public $user_first_name;
    public function get_user_first_name()
    {return $this->user_first_name;}
    public $user_last_name;
    public function get_user_last_name()
    {return $this->user_last_name;}
    public $message_subject;
    public function get_message_subject()
    { return $this->message_subject;}
    public function getFormId()
    {
       return "nfb_user_manage_account";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $page_builder = new core_markup();
        $page_builder->user_data->civi_contact_set();
        $form['vals'] = array(
          '#type' => 'item',
          '#markup' => "<p class='hidden_val' id='yoshi'>".\Drupal::currentUser()->getAccountName()."</p>
                <p class='hidden_val' id='member_name'>".$page_builder->user_data->get_first_name()." ".$page_builder->user_data->get_last_name()."</p>"
        );
        $maker = new member_account();
        $form['intro_text'] = array(
          '#type' => 'item',
          '#markup' => $maker->build_intro_markup(),
        );
        $form['desire_change_uanme'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t("Select to change your username. Important note: Username must be an email address. However, changing your username does not change the email address that we use to contact you for most Federation matters.")
        );
        $form['change_username'] = array(
          '#type' => 'textfield',
          '#title' => "Change User Name",
          '#min' => 5,
          '#size' => 20,
            '#states' => [
                'visible' =>[
                    [':input[name="desire_change_uanme"]' => ['checked' => true]]],
                'and',
                'required' => [
                    [':input[name="desire_change_uanme"]' => ['checked' => true]]]
            ]
        );
        $form['desire_change_pword'] = array(
            '#type' => 'checkbox',
            '#title' => $this->t("Select to change your password. Password must be at least eight characters long and include one lowercase letter, one uppercase letter, one number, and one special character (such as !, #, or %).")
        );
        $form['change_password'] = array(
            '#type' => 'password',
            '#title' => "Change Your Password",
            '#min' => 5,
            '#size' => 20,
            '#states' => [
                'visible' =>[
                    [':input[name="desire_change_pword"]' => ['checked' => true]]],
                'and',
                'required' => [
                    [':input[name="desire_change_pword"]' => ['checked' => true]]]
            ]

        );
        $form['confirm_password'] = array(
            '#type' => 'password',
            '#title' => "Confirm Your New Password",
            '#min' => 5,
            '#size' => 20,
            '#states' => [
                'visible' =>[
                    [':input[name="desire_change_pword"]' => ['checked' => true]]],
                'and',
                'required' => [
                    [':input[name="desire_change_pword"]' => ['checked' => true]]]
            ]

        );
           $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
               '#states' => [
                   'visible' =>[
                       [':input[name="desire_change_pword"]' => ['checked' => true]],
                   'or',
                   [':input[name="desire_change_uanme"]' => ['checked' => true]]],

                   'and',
                   'required' => [
                       [':input[name="desire_change_pword"]' => ['checked' => true]],
                       'or',
                       [':input[name="desire_change_uanme"]' => ['checked' => true]]]
               ]
        );
        $form['#attached']['library'][] = 'nfb_user_portal/up-account';
           return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $user = \Drupal::currentUser(); // get the user.
        $uname =  $user->getAccountName();
        $this->old_user_name = $uname;
        $uid = $user->getAccount()->id();
        $this->user_id = $uid;
        $entity = User::load($uid);
        if($form_state->getValue("desire_change_uanme") == 1) {
            $entity->setEmail($form_state->getValue("change_username"));

            $entity->setUsername($form_state->getValue("change_username"));
            $this->new_user_name = $form_state->getValue("change_username");
        }
        if ($form_state->getValue("desire_change_pword") == 1){
            $entity->setPassword($form_state->getValue("change_password"));
        }
        try{
            $entity->save(); }
        catch (Exception $e)
        {
            $messager = \Drupal::messenger();
            $messager->addError("Couldn't save user ".$e->getMessage());
        }
        $this->Email_functions($form_state);
    }
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state); // TODO: Change the autogenerated stub
        $this->validate_username($form, $form_state);
        $this->validate_password($form, $form_state);

    }
    public function validate_username(&$form, FormStateInterface $form_state)
    {
        $username = $form_state->getValue("change_username");
        if(strpos(" ".$username, ";") > 0)
        {
            $form_state->setErrorByName("change_username", "Entered password cannot contain a semi colon.");
        }
        if ($form_state->getValue("desire_change_uanme") == 1) {
        $email_entered = $this->check_if_email($username);
        if ($email_entered == "No") {
            $form_state->setErrorByName("change_username", "You must enter an email address for your username");
        } else {
            $email_status = $this->check_if_email_is_already_used($username);
            if ($email_status == "Not New") {
                $form_state->setErrorByName("change_username", "That email address already is in use, please pick another one");
            } else if ($email_status == "no change") {
                $form_state->setErrorByName("change_username", "If you are changing your username, please enter a enw email address.");
            }
        }
    }
    }
    public function check_if_email($username)
    {
        $at_check = false;
        $at_pos = strpos(" ".$username, "@");
        if($at_pos > 1)
        {
            $at_check = true;
        }
        $per_check = false;
        $per_pos = strpos(" ".$username, ".");
        if($per_pos > 1)
        {
            $per_check = true;
        }
        if($per_check == true && $at_check == true)
        {
            $good = "Yes";
        }
        else {$good = "No";}
        return $good;
    }
    public function check_if_email_is_already_used($username)
    {
        $old_user = \Drupal::currentUser();
        $old_username = $old_user->getAccountName();
        if(strtolower($old_username) == strtolower($username))
        {
            $match = true;
        }
        else {$match = false;}
        if($match == false)
        {
            $ids = \Drupal::entityQuery('user')
                ->condition('name',  $username)
                ->range(0, 1)
                ->execute();
            if(!empty($ids)){
                $exists = "Not New";
            }
            else{
                $exists = "New";
            }
        }
        if($match == true)
        {
            $exists = "no change";
        }
        return $exists;
    }
    public function validate_password(&$form, FormStateInterface $form_state)
    {
        if($form_state->getValue("desire_change_pword") == 1) {
            $pword = $form_state->getValue("change_password");
            if(strpos(" ".$pword, ";") > 0)
            {
                $form_state->setErrorByName("change_password", "Entered password cannot contain a semi colon.");
            }
            $confirm_pword = $form_state->getValue("confirm_password");
            if ($pword != $confirm_pword) {
                $form_state->setErrorByName("change_password", "Entered passwords do not match");
            } else {
                $check = $this->check_password($pword);
                if ($check == "No") {
                    $form_state->setErrorByName("change_password", "Entered password must contain at least one special character, one number, and one upper and lower case letter. Passwords must also be at least eight characters in length. ");
                } elseif (strlen($pword) < 8) {
                    $form_state->setErrorByName("change_password", "Entered password must contain at least one special character, one number, and one upper and lower case letter. Passwords must also be at least eight characters in length. ");
                }
            }
        }
    }
    public function check_password($pword)
    {

        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $pword))
        {
            $char_good = true;
        }
        else{
            $char_good = false;
        }
        if (preg_match('~[0-9]+~', $pword))
        {
            $num_good = true;
        }
        else {
            $num_good = false;
        }
        if(preg_match('/[A-Z]/', $pword))
        {
            $cap_good = true;
        }
        else {
            $cap_good = false;
        }
        if(preg_match('/[a-z]/', $pword)) {
            $low_good = true;
        }
        else{
            $low_good = false;
        }
        if( $cap_good == true && $low_good == true &&
            $char_good == true && $num_good == true)
        {
            $clear = "Yes";
        }
        else{
            $clear = "No";
        }
        return $clear;
    }
    public function Email_functions(FormStateInterface $form_state)
    {
        $this->find_member_name();
        if($form_state->getValue("desire_change_pword") == 1)
        {
            $this->find_password_email_template();
            $this->password_mail_manager($form_state);
        }
        if($form_state->getValue("desire_change_uname" ) == 1)
        {
            $this->find_user_name_tempalte();
            $this->user_name_mail_manager($form_state);
        }

    }
    public function find_user_name_tempalte()
    {
        $sql =  new User_request_queries();
        $query = "select * from nfb_user_portal_templates where type_id = '2';";
        $key = "tid";
        $sql->select_query($query, $key);
        $this->user_name_email_template = null;
        foreach ($sql->get_result() as $template)
        {
            $template = get_object_vars($template);
            if($this->get_user_name_email_template() == null) {
                $this->user_name_email_template = $template['template_id'];

            }
        }
        $sql = null;
    }
    public function find_password_email_template()
    {
        $sql =  new User_request_queries();
        $query = "select * from nfb_user_portal_templates where type_id = '3';";
        $key = "tid";
        $sql->select_query($query, $key);
        $this->password_email_template = null;
        foreach ($sql->get_result() as $template) {
            $template = get_object_vars($template);
            if ($this->get_password_email_template() == null) {

            $this->password_email_template = $template['template_id'];
        }
        }
        $sql = null;
    }
    public function find_member_name()
    {
        $civi = new query_base();
        $civi->entity = "UFMatch";
        $civi->mode = "get";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['uf_id', '=', $this->get_user_id()],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query();; $result = $civi->get_civi_result();
        $uf_match = $result->first();
        $contact = $uf_match['contact_id'];
        $civi->entity = "Contact";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['id', '=', $contact],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query(); $result = $civi->get_civi_result();
        $contact_info = $result->first();
        $this->user_first_name =  $contact_info['first_name'];
        $this->user_last_name = $contact_info['last_name'];
    }
    public function repalce_tempalte_text($template)
    {
        $template = str_replace("[old_uname]", $this->get_old_user_name(), $template);
        $template = str_replace("[new_uname]", $this->get_new_user_name(), $template);
        $template = str_replace("[f_name]", $this->get_user_first_name(), $template);
        $template = str_replace("[l_name]", $this->get_user_last_name(), $template);
        return $template;
    }
    public function find_tempalte_text_and_subject($template)
    {
        $civi = new query_base();
        $civi->entity = "MessageTemplate";
        $civi->mode = "get";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['id', '=', $template],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query(); $result = $civi->get_civi_result();
        $array = $result->first();

        $template = $array['msg_text'];
        $this->message_subject = $array['msg_subject'];
        return $template;
    }
    public function password_mail_manager(FormStateInterface  $form_state)
    {

        $template = $this->get_password_email_template();
        $template = $this->find_tempalte_text_and_subject($template);
        $this->password_email_template = $this->repalce_tempalte_text($template);
        if($form_state->getValue("desire_change_uanme") == 1){
        $recipient_email = $this->get_new_user_name();}
        else{
            $recipient_email = $this->get_old_user_name();
        }
        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'nfb_user_portal';
        $key = 'nfb_user_portal_pass_wrod';
        $to = $recipient_email;
        $send = true;
        $params['message'] = $this->get_password_email_template();
        $params['subject'] = $this->get_message_subject();
        $langcode = "en";
        $result = $mailManager->mail($module, $key, $to, $langcode, $params, $send);
    }
    public function user_name_mail_manager(FormStateInterface  $form_state)
    {

        $template = $this->get_user_name_email_template();
        $template = $this->find_tempalte_text_and_subject($template);
        $this->user_name_email_template = $this->repalce_tempalte_text($template);
            $recipient_email = $this->get_old_user_name();
        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'nfb_user_portal';
        $key = 'nfb_user_portal_u_name_1';
        $to = $recipient_email;
        $send = true;
        $params['message'] = $this->get_user_name_email_template();
        $params['subject'] = $this->get_message_subject();
        $langcode = "en";
        $result = $mailManager->mail($module, $key, $to, $langcode, $params, $send);
        $recipient_email = $this->get_new_user_name();
        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'nfb_user_portal';
        $key = 'nfb_user_portal_u_name_2';
        $to = $recipient_email;
        $send = true;
        $params['message'] = $this->get_user_name_email_template();
        $params['subject'] = $this->get_message_subject();
        $langcode = "en";
        $result = $mailManager->mail($module, $key, $to, $langcode, $params, $send);
    }

}