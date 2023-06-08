<?php
Namespace Drupal\nfb_user_portal\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class AdminCompleteRequestForm extends FormBase
{
    public $rid;
    public function get_rid()
    {return $this->rid;}
    public $name;
    public function get_name()
    {
        return $this->name;
    }
    public $email;
    public function get_email()
    {
        return $this->email;
    }
    public $page;
    public function get_page()
    {
        return $this->page;
    }
    public $status;
    public function  get_status()
    {
        return $this->page;
    }
    public  $sort;
    public function getFormId()
    {
       return "nfb_user_admin_complete";
    }
    public function buildForm(array $form, FormStateInterface $form_stat, $rid = "1")
    {
        $string = $rid;
        $form['intro_text'] = array(
           '#type' => "item",
           '#makrup' => "<p> Placeholder text: Uh jsut odn't reuse emails. IDK</p>"
       );
       $form['rid'] = array(
           '#type' => "textfield",
           '#title' => "Member Name",
           '#size' => 20,
           '#value' => $this->get_rid(),
           '#attributes' => array('readonly' => 'readonly'),
       );
        $form['name'] = array(
            '#type' => "textfield",
            '#title' => "Member Name",
            '#size' => 20,
            '#value' => $this->get_name(),
            '#attributes' => array('readonly' => 'readonly'),

        );
        $form['email'] = array(
            '#type' => "textfield",
            '#title' => "Member email",
            '#size' => 20,
            '#value' => $this->get_email(),
            '#attributes' => array('readonly' => 'readonly'),
        );
        $form['status'] = array(
            '#type' => 'select',
            '#title' => "Filter by Status",
            '#options' => array(
                'Pending' => "Pending",
                'Complete' => "Complete",
                "Rejected" => "Rejected",
                "Duplicate Email" => "Duplicate Email",
                "Duplicate Name" => "Duplicate Name"
            ),
        );
        $form['comments'] = array(
            '#type'  => '#textarea',
            '#title' => "Notes:",
            '#max' => 500,
        );

    }
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
    public function set_paging_requirments($rid)
    {
        $orig_string = $rid;
        $end = strpos($orig_string, "&%");
        $string = substr($orig_string, 0, $end);
        $this->rid = $this->string_parser($string);
        $start = $end + 2;
        $post_page = substr($orig_string, $start, 200);
        \Drupal::logger("sigh")->notice("aiya ".$post_page);
        $new_end = strpos($post_page, "&%");
        $string = substr($post_page,0, $new_end);
        $this->name_filter = $this->string_parser($string);
        \Drupal::logger("filter_check")->notice("string 1 ".$string);
        $start = $new_end+2;
        $post_name = substr($post_page, $start, 200);
        \Drupal::logger("nfb_uer_portal")->notice("post_name ".$post_name);
        $end = strpos($post_name, "&%");
        $string = substr($post_name, 0, $end);
        \Drupal::logger("filter_check")->notice("string 3 ".$string);
        $this->email_filter = $this->string_parser($string);
        $start = $end + 2;
        $post_email = substr($post_name, $start, 200);
        $end = strpos($post_email, "&%");
        $string = substr($post_email, 0, $end);
        \Drupal::logger("filter_check")->notice("string 4 ".$string);
        $this->status_filter = $this->string_parser($string);
        $start = $end + 2;
        $post_status = substr($post_email, $start, 200);
        $end = strpos($post_status, "&%");
        $string = substr($post_status, 0, $end);
        $this->sort_field = $this->string_parser($string);
        if($this->get_sort_field() == "")
        {
            $this->sort_field = "rid";
        }



    }
}