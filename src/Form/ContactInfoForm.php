<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\facets\Exception\Exception;
use Drupal\nfb_user_portal\html_builder\core_markup;
use Drupal\user\Entity\User;
class ContactInfoForm extends FormBase
{
    public function getFormId()
    {
        return "user_portal_page_one";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $page_builder = new core_markup();
        $form['portal_markup'] = array(
          '#type' => "item",
            '#markup' => $page_builder->create_core_markup(),
            '#allowed_tags' => ['div','span', 'br', 'h2','label','table','thead', 'th', 'td', 'input', 'form', 'select', 'a', 'option', 'button', 'tr', 'p'],
        );
        $form['change_username'] = array(
          '#type' => 'textfield',
          '#title' => "Change User Name",
          '#required' => True,
          '#min' => 5,
          '#size' => 20
        );
        $form['change_password'] = array(
            '#type' => 'password',
            '#title' => "Change Your Password",
            '#required' => True,
            '#min' => 5,
            '#size' => 20,
        );
        $form['confirm_password'] = array(
            '#type' => 'password',
            '#title' => "Confirm Your New Password",
            '#required' => True,
            '#min' => 5,
            '#size' => 20,
        );
        $form['#attached']['library'][] = 'nfb_user_portal/up-main';
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        );
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $user = \Drupal::currentUser(); // get the user.
        $uname =  $user->getAccountName();
        \Drupal::logger("username_check")->notice("username check ".$uname);
        $uid = $user->getAccount()->id();
        $entity = User::load($uid);
        $entity->setEmail($form_state->getValue("change_username"));
        $entity->setUsername($form_state->getValue("change_username"));
        $entity->setPassword($form_state->getValue("change_password"));
        try{
        $entity->save(); }
        catch (Exception $e)
        {
            $messager = \Drupal::messenger();
            $messager->addError("Couldn't save user ".$e->getMessage());
        }
        $uname =  $entity->getAccountName();
        \Drupal::logger("username_check")->notice("username check ".$uname);
    }
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state); // TODO: Change the autogenerated stub
        $this->validate_username($form, $form_state);
        $this->validate_password($form, $form_state);

    }
    public function validate_username(&$form, FormStateInterface $form_state){
        $username = $form_state->getValue("change_username");
        $email_entered = $this->check_if_email($username);
        if($email_entered == "No")
        {
            $form_state->setErrorByName("change_username", "You must enter an email address for your username");
        }
        else{
            $email_status = $this->check_if_email_is_already_used($username);
            if($email_status == "Not New")
            {
                $form_state->setErrorByName("change_username", "That email address already is in use, please pick another one");
            }
            else if( $email_status == "no change")
            {
                $form_state->setErrorByName("change_username", "If you are changing your username, please enter a enw email address.");
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
        return $match;
    }
    public function validate_password(&$form, FormStateInterface $form_state)
    {
        $pword = $form_state->getValue("change_password");
        $confirm_pword = $form_state->getValue("confirm_password");
        if($pword != $confirm_pword)
        {
            $form_state->setErrorByName("change_password", "Entered passwords do not match");
        }
        else{
           $check =  $this->check_password($pword);
           if($check == "No")
           {
               $form_state->setErrorByName("change_password", "Entered password must contain at least one special character, one number, and one upper and lower case letter. Passwords must also be at least eight characters in length. ");
           }
           elseif (strlen($pword) < 8)
           {
               $form_state->setErrorByName("change_password", "Entered password must contain at least one special character, one number, and one upper and lower case letter. Passwords must also be at least eight characters in length. ");
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

}