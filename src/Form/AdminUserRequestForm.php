<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\html_builder\Admin\USer_request_table;
class AdminUserRequestForm extends FormBase
{
    public $table_builder;
    public function getFormId()
    {
       return "nfb_user_admin_u_request";
    }
    public function buildForm(array $form, FormStateInterface $form_state, $limiter = '1')
    {
        if($limiter == 1)
        {
            $limiter = "1&%  &%  &%  ";
        }
        $this->table_builder = new USer_request_table();
        $this->table_builder->build_form($form, $form_state, $limiter);
        $form['#attached']['library'][] = 'nfb_user_portal/admin-table';
        return $form;
    }
    public function table_stuff($form, $form_state, $limiter)
    {
        return    $form['sub_table'];
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }

}