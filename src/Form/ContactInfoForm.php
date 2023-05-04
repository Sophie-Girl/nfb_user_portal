<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\html_builder\core_markup;

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
            '#type' => 'textfield',
            '#title' => "Change Your Password",
            '#required' => True,
            '#min' => 5,
            '#size' => 20,
            '#attributes' => array('input_hiding' => true)
        );
        $form['confirm_password'] = array(
            '#type' => 'textfield',
            '#title' => "Confirm Your New Password",
            '#required' => True,
            '#min' => 5,
            '#size' => 20,
            '#attributes' => array('input hiding' => true)
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
        // TODO: Implement submitForm() method.
    }
}