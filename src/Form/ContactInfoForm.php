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
            '#allowed_tags' => ['div', 'table','thead', 'th', 'td', 'input', 'form', 'select', 'a', 'option', 'button', 'tr', 'p'],
        );
        $form['#attached']['library'][] = 'nfb_user_portal/up-main';
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}