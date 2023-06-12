<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;

class AdminEmailTempForm extends FormBase {
    public $completed_request;
    public $reset_user_name;
    public $request_pass_word;
    public function get_completed_request()
    {
        return $this->completed_request;}
    public function get_reset_user_name()
    {
        return $this->reset_user_name;
    }
    public function get_request_pass_word()
    {
        return $this->request_pass_word;
    }
    public function getFormId()
    {
       return "user_profile_email_templates";
    }
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $this->sql_query();
        $form['intro'] = array(
          '#type' => 'item',
          '#markup' => "<p>This form allows you to set the current email templates for the member login, er portal
</p><p class='hidden_val' id='completed'>".$this->get_completed_request()."</p>
<p class='hidden_val' id='u_name'>".$this->get_reset_user_name()."</p>
<p class='hidden_val' id='pass'>".$this->get_request_pass_word()."</p>"
        );
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
    public function sql_query()
    {
        $query = "select * from nfb_user_portal_templates";
        $key = "tid";
        $sql = new User_request_queries();
        $sql->select_query($query, $key);
        foreach ($sql->get_result() as $template)
        {
            $template = get_object_vars($template);
            if($template['type_id'] == 1)
            {
                $this->completed_request = $template['template_id'];
            }
            elseif($template['type_id'] == 2)
            {
                $this->reset_user_name = $template['template_id'];
            }
            elseif ($template['type_id'] == 3)
            {
               $this->request_pass_word = $template['template_id'];
            }
        }

    }
}