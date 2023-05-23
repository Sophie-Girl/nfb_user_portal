<?php
Namespace Drupal\nfb_user_portal\html_builder\Admin;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;

class USer_request_table extends User_request_activate
{
    public $sql;
    public function __construct()
    {
        $this->sql = new User_request_queries;
    }
    public $last_id;
    public function get_last_id()
    {
        return $this->last_id;
    }
    public $markup;
    public function get_markup()
    {
        return $this->markup;
    }
    public $limiter;
    public function get_limiter()
    {return $this->limiter;}
    public $page_need;
    public function get_page_need()
    {return $this->page_need;}
    public $page_max_id;
    public function get_page_max_id()
    {return $this->page_max_id;}
    public $first_id;
    public function get_first_id()
    {return $this->first_id;}

    public function build_form(&$form, FormStateInterface $form_state)
    {

    }
    public function search_form_submissions()
    {
        $this->start_of_page();
        $sql_result = $this->initial_query();


    }
    public function start_of_page()
    {
        $this->markup = "<p tabindex='0'>Bellow are submissions form the ENw member Form, and Member at Large form. From here you can approve a member request if there is no issue 
or review an issue with a potential account.</p>
 <table>
 <tr><th class='t_header'>Request ID</th><th class='t_header'>Civi Contact ID</th><th class='t_header'>Status</th><th class='t_header'>Comments</th></tr>";

    }
    public function foreach_loop_for_initial($sql_result)
    {
        $first_id = null; $count = 0;
        foreach ( $sql_result as $result) {
            $result = get_object_vars($result);
            if ($count == 0) {
                $this->last_id = $result['rid'];
            }
            if ($this->limiter == "1") {

            }
            $count++;
        }

    }
    public function initial_query()
    {
        $query = "Select * from nfb_user_portal_user_request order by rid desc limit 50;";
        $key = "rid";
        $this->sql->select_query($query, $key);
        $sql_result = $this->sql->get_result();
        return $sql_result;
    }

}