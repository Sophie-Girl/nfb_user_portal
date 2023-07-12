<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\html_builder\Admin\edit_create_contnet;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;
class AdminTemplateCreateForm extends FormBase
{

    public function getFormId()
    {
        return "template_member_creation";
    }
    public function buildForm(array $form, FormStateInterface $form_state, $content=1)
    {
        $user_request_queries = new User_request_queries();
        $factory =  new edit_create_contnet($user_request_queries);
        $factory->build_form_array($form, $form_state, $content);
        $form['#attached']['library'][] = 'nfb_user_portal/admin-content-edit';
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
       if($form_state->getValue("content_value") == "new")
       {

       }
       else{

       }
    }
    public function new_content_functions(FormStateInterface  $form_state)
    {

    }
    public function edit_content_functions(FormStateInterface $form_state)
    {

    }
}