<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\html_builder\memberhisp_markup;

class MembershipInfoForm extends FormBase
{
    public function getFormId()
    {
       return "member_portal_second_tab";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $page_builder = new memberhisp_markup();
        $form['portal_markup'] = array(
            '#type' => "item",
            '#markup' => $page_builder->build_membership_markup(),
            '#allowed_tags' => ['div', 'em', 'i', 'h4', 'h3', 'b', 'image', 'span', 'br', 'h2','label','table','thead', 'th', 'td', 'input', 'form', 'select', 'a', 'option', 'button', 'tr', 'p', 'ul', 'li'],
        );
        $form['member_benefit'] = array(
            '#type' => "item",
            '#markup' => $page_builder->member_benefits_section(),
            '#allowed_tags' => ['div', 'em','i','h3', 'b', 'h4','image','span', 'br', 'h2','label','table','thead', 'th', 'td', 'input', 'form', 'select', 'a', 'option', 'button', 'tr', 'p', 'ui', 'li'],
        );
        $form['#attached']['library'][] = 'nfb_user_portal/up-membership';
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}