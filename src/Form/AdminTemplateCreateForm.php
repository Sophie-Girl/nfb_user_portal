<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\html_builder\Admin\edit_create_contnet;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;
class AdminTemplateCreateForm extends FormBase
{

    public function getFormId()
    {
        return "template_member_creation";
    }
    public function buildForm(array $form, FormStateInterface $form_state, $content=1)
    {
        $user_request_queries = new User_request_queries();
        $factory =  new edit_create_contnet($user_request_queries);
        $factory->build_form_array($form, $form_state, $content);
        $form['#attached']['library'][] = 'nfb_user_portal/admin-content-edit';
        return $form;
    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
       if($form_state->getValue("content_value") == "new")
       {
           $this->new_content_functions($form_state);  // create new context records
           \Drupal::messenger()->addMessage("New Content Made Successfully");
       }
       else{
           $this->edit_content_functions($form_state); //  edit the current record. 0
           \Drupal::messenger()->addMessage("Changes Made Successfully");
       }

       $form_state->setRedirect("nfb_user_portal.content_table");

    }
    public function ValidateForm(array &$form, FormStateInterface  $form_state)
    {
        parent::validateForm($form, $form_state);

    }
    public function search_for_otherweights($form, FormStateInterface $form_state)
    {if($form_state->getValue("markup_type") == "member_benefit" && $form_state->getValue("active") == "0")
    {
        $this->sql_query($form_state);
    }
    elseif ($form_state->getValue("markup_type") == "faq" && $form_state->getValue("active") == "0")
    {
        $this->sql_query($form_state);
    }
    }
    public function sql_query(FormStateInterface $form_state)
    {
        $sql = \Drupal::database();
        $query = "Select * from nfb_user_portal_content where markup_type = '" . $form_state->getValue("markup_type") . "' and active == 0 order by cid desc limit 50;";
        $key = "c_id";
        $sql_result = $sql->query($query)->fetchAllAssoc($key);
        foreach ($sql_result as $content)
        {
            $content = get_object_vars($content);
            $array = json_decode($content['markup']);
            $array = get_object_vars($array);
            if($array['group'] == $form_state->getValue("benefit_group") && $array['weight'] == $form_state->getValue("weight"))
            {
                $form_state->setErrorByName("weight", "Another Benefit has this weight. Either deactivate it or select a different weight. ");
            }
            elseif($array['group'] == $form_state->getValue("faq_grouping") && $array['weight'] == $form_state->getValue("weight"))
            {
                $form_state->setErrorByName("weight", "Another Faq has this weight. Either deactivate it or select a different weight. ");
            }

        }
    }
    public function new_content_functions(FormStateInterface  $form_state)
    {
        $this->set_limiter_values($form_state, $limiter, $value);
        $this->set_Date_values($form_state, $end_date, $beginning_date);
        $fields = array(
            'markup_type' => $form_state->getValue("markup_type"),
            'tab' => $form_state->getValue("tab"),
            'limiter' => $limiter,
            'civi_entity' => $value,
            'beginning_date' => $beginning_date,
            'end_date' => $end_date,
            'permanent' => $form_state->getValue("permanent"),
            'active' => $form_state->getValue("active"),
            'markup' => $this->create_markup_array($form_state),
        );
        $table = "nfb_user_portal_content";
       $sql =  \Drupal::database();
        $sql->insert($table)->fields($fields)->execute();
    }
    public function create_markup_array(FormStateInterface $form_state)
    {
        $array['title'] = $form_state->getValue("markup_title");
        $array['text'] = $form_state->getValue("content")['value'];
        $array['weight'] = $form_state->getValue("weight");
        if ($form_state->getValue("markup_type") == "faq")
        {
            $array['group'] =  $form_state->getValue("faq_grouping");
        }
        elseif($form_state->getValue("markup_type") == "member_benefit")
        {
            $array['group'] =  $form_state->getValue("benefit_group");
        }
        else{
            $array['group'] = "none";
        }
        $array = json_encode($array);
        return $array;
    }
    public function edit_content_functions(FormStateInterface $form_state)
    {
        $this->set_limiter_values($form_state, $limiter, $value);
        $this->set_Date_values($form_state, $end_date, $beginning_date);
        $sql = \Drupal::database();
        $query = "delete from nfb_user_portal_content
where cid = '".$form_state->getValue("content_value")."';";
        $sql->query($query)->execute();
        $fields = array(
            'cid' => $form_state->getValue("content_value"),
            'markup_type' => $form_state->getValue("markup_type"),
            'tab' => $form_state->getValue("tab"),
            'limiter' => $limiter,
            'civi_entity' => $value,
            'beginning_date' => $beginning_date,
            'end_date' => $end_date,
            'permanent' => $form_state->getValue("permanent"),
            'active' => $form_state->getValue("active"),
            'markup' => $this->create_markup_array($form_state),
        );
        $table = "nfb_user_portal_content";
        $sql =  \Drupal::database();
        $sql->insert($table)->fields($fields)->execute();

    }
    public function set_limiter_values(FormStateInterface $form_state, &$limiter, &$value)
    {
        if($form_state->getValue("limited_by") == "civi_entity")
        {
            $limiter = $form_state->getValue("civi_entity");
            $value = $form_state->getValue("civi_entity_value");
        }
        else
        {
            $limiter = $form_state->getValue("limited_by");
            $value = "null";
        }
    }
    public function set_Date_values(FormStateInterface $form_state, &$end_date, &$beginning_date)
    {
        if($form_state->getValue("markup_type") == "member_benefit")
        {
            $beginning_date = $form_state->getValue("start_date");
            $end_date = $form_state->getValue("end_date");
            $end_date = $end_date->format("Y-m-d");
            $beginning_date = $beginning_date->format("Y-m-d");
        }
        else{
            $beginning_date =  "null";
            $end_date = "null";
        }
    }
    public function  option_reset(&$form, FormStateInterface  &$form_state,  $content=1)
    {
        return $form['civi_entity_value'];
    }
}