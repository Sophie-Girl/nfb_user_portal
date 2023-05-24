<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class FaqTabForm extends FormBase
{
    public function getFormId()
    {
       return "user_login_faq";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['faq_text'] = array(
          '#type' => 'item',
          '#markup' => "<p>This is a place holder</p>"
        );
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}