<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;
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
        $form['completed_temp'] = array(
            '#type' => 'select',
            '#title' => "Completed User Request Email Template",
            '#options' => $this->template_options(),
            '#required' => true,
            '#description' => "This is the email template that goes to members after they have their account created"
        );
        $form['user_name'] = array(
            '#type' => 'select',
            '#title' => "Username Change",
            '#options' => $this->template_options(),
            '#required' => true,
            '#description' => "This is the email template that goes out to a member who requests a new username. 
            This goes to both the old email, and the new email. This is part of a our security protocols per discussions on 6/9/2023",
        );
        $form['password_change'] = array(
            '#type' => 'select',
            '#title' => "Password Change",
            '#options' => $this->template_options(),
            '#required' => true,
            '#description' => "This Template Goes out when the user changes their password.",
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Submit'),)
        ;
        $form['#attached']['library'][] =  'nfb_user_portal/admin-template';
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $this->sql_query();
        if($this->get_reset_user_name() != "")
        {
            $this->update_databse_records($form_state);
        }
        else{
            $this->create_database_records($form_state);
        }
    }
    public function sql_query()
    {
        $query = "select * from nfb_user_portal_templates";
        $key = "tid";
        $sql = new User_request_queries();
        $sql->select_query($query, $key);
        \Drupal::logger("sql_issue")->notice("results ".print_r($sql->get_result(), true));
        foreach ($sql->get_result() as $template)
        {
            $template = get_object_vars($template);

            if($template['type_id'] == '1')
            {
                $this->completed_request = $template['template_id'];
            }
            elseif($template['type_id'] == '2')
            {
                $this->reset_user_name = $template['template_id'];
            }
            elseif ($template['type_id'] == '3')
            {
               $this->request_pass_word = $template['template_id'];
            }
        }

    }
    public function template_options()
    {
        $options = [];
        $civi= new query_base();
        $civi->entity = "MessageTemplate";
        $civi->mode = "get";
        $civi->params =
            [
                'select' => [
                    '*',
                ],
                'limit' => 500,
                'checkPermissions' => FALSE,
            ];
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $total = $result->count();
        $current = 0;
        while($current < $total)
        {
            $tempalte = $result->itemat($current);
            $options[$tempalte['id']] = $tempalte['msg_title'];
            $current++;
        }
        return $options;
    }
    public function create_database_records(FormStateInterface  $form_state)
    {\drupal::logger("insert_test")->notice("I got here");
        $database = \Drupal::database();
        if ($database->schema()->tableExists("nfb_user_portal_templates")) {
            $fields = array(
                'type_id' => 1,
                'template_id' => $form_state->getValue("completed_temp"),
            );
            $table = 'nfb_user_portal_templates';
            $database->insert($table)->fields($fields)->execute();
            $fields = array(
                'type_id' => 2,
                'template_id' => $form_state->getValue("user_name"),
            );
            $table = 'nfb_user_portal_templates';
            $database->insert($table)->fields($fields)->execute();
            $fields = array(
                'type_id' => 3,
                'template_id' => $form_state->getValue("password_change"),
            );
            $table = 'nfb_user_portal_templates';
            $database->insert($table)->fields($fields)->execute();
        }
    }
    public function update_databse_records(FormStateInterface  $form_state)
    {
        $sql = new User_request_queries();
        $query = " update nfb_user_portal_templates
        set template_id = '".$form_state->getValue("completed_temp")."'
        where tid = 1; 
        ";
        $sql->update_query($query);
        $query = " update nfb_user_portal_templates
        set template_id = '".$form_state->getValue("user_name")."'
        where tid = 2; 
        ";
        $sql->update_query($query);
        $query = " update nfb_user_portal_templates
        set template_id = '".$form_state->getValue("password_change")."'
        where tid = 3; 
        ";
        $sql->update_query($query);
    }
}