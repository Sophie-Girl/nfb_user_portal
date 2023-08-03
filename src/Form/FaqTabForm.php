<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\html_builder\core_markup;
use Drupal\nfb_user_portal\html_builder\fq_markup_builder;

class FaqTabForm extends FormBase
{
    public function getFormId()
    {
       return "user_login_faq";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $page_builder = new fq_markup_builder();
        $page_builder->user_data->civi_contact_set();
        $form['intro_text_text'] = array(
          '#type' => 'item',
          '#markup' => "
<p class='hidden_val' id='yoshi'>".\Drupal::currentUser()->getAccountName()."</p>
                <p class='hidden_val' id='member_name'>".$page_builder->user_data->get_first_name()." ".$page_builder->user_data->get_last_name()."</p>".
              $page_builder->look_for_faq_intro_text();
        );
        $form['faqs'] = array(
            '#type' => 'item',
            '#markup' => $page_builder->build_faq_markup(),
        );
        $form['#attached']['library'][] = 'nfb_user_portal/up-faq';
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}