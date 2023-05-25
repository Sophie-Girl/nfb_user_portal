<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\html_builder\other_markup;

class OtherInfoForm extends FormBase
{
    public function getFormId()
    {
       return "member_portal_other_info";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
       $builder =  new other_markup();
       $builder->user_data->civi_contact_set();
        $form['other_info'] = array(
            '#type' => "item",
            '#markup' => "<p>This are is under construction.</p>
        <p class='hidden_val' id='member_name'>".$builder->user_data->get_first_name()." ".$this->builder->get_last_name()."</p>",//$builder->create_other_markup(),
            '#allowed_tags' => ['div','span', 'br', 'h2','label','table','thead', 'th', 'td', 'input', 'form', 'select', 'a', 'option', 'button', 'tr', 'p'],
        );
        $form['#attached']['library'][] = 'nfb_user_portal/up-other';

        return $form;

    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}