<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\html_builder\Admin\markup_talbe_create;

class AdminTemplateHomForm extends FormBase
{
    public function getFormId()
    {
       return "member_template_text_home";
    }

    public function buildForm(array $form, FormStateInterface $form_state,$content = "new" )
    {
        $factory = new markup_talbe_create();
        $factory->build_form_array($form, $form_state, $content);
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}