<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;
class AdminTemplateCreateForm extends FormBase
{
    public function getFormId()
    {
        return "template_member_creation";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // TODO: Implement buildForm() method.
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}