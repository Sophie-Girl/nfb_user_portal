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
    {
        return $this->limiter;
    }

    public $page_need;

    public function get_page_need()
    {
        return $this->page_need;
    }

    public $page_max_id;

    public function get_page_max_id()
    {
        return $this->page_max_id;
    }

    public $first_id;

    public function get_first_id()
    {
        return $this->first_id;
    }
    public $name_filter;
    public function get_name_filter()
    {return $this->name_filter;}
    public $email_filter;
    public function get_email_filter()
    {
        return $this->email_filter;
    }
    public $status_filter;
    public function get_status_filter()
    {
        return $this->status_filter;
    }
    public $sort_field;
    public function get_sort_field()
    {
        return $this->sort_field;
    }

    public function build_form(&$form, FormStateInterface $form_state, $limiter)
    {
        $this->limiter = $limiter;
        if ($form_state->getValue("search_value") != "")
        {
                $this->limiter =   $form_state->getValue("search_value");
        }
        $this->search_form_submissions($form_state);
        $form['name_filt'] = array(
          '#type' => "textfield",
          '#title' => "Filter By Name",
           '#description' => "Enter the full first and last name or partial name to search for a specific member request",
           '#size' => 20
        );
        $form['email_filt'] = array(
            '#type' => "textfield",
            '#title' => "Filter By Email",
            '#description' => "Enter the full email  or partial email to search for a specific member request",
            '#size' => 20
        );
        $form['status_filt'] = array(
            '#type' => 'select',
            '#title' => "Filter by Status",
            '#options' => array(
                '' => "Select",
                'Pending' => "Pending",
                'Complete' => "Complete",
                "Rejected" => "Rejected",
                "Duplicate Email" => "Duplicate Email",
                "Duplicate Name" => "Duplicate Name"
            ),
            "#description" => "Filter by request status",
            '#required' => false,
        );
        $form['search_value'] = [
            '#type' => "textfield",
            '#prefix' => "<div id='page_val'>".$limiter."</div>
            <div id='page_num'>".$this->get_limiter()."</div>",
            '#title' => "Filter By Name",
        ];
        $form['sort_field'] = array(
            '#type' => 'select',
            '#title' => "Sort By:",
            '#options' => array(
                '' => "Select",
                'rid' => "Request ID",
                'member_name' => "Name",
                "member_email" => "Email",
                "member_status" => "Status",
            ),
            "#description" => "Sort Results by",
            '#required' => false,
        );
        $form['ajax_button'] = array(
            '#prifx' => "<div id='clear-filter' style='display: inline-block' role='button' class='btn btn-primary'>&nbsp;&nbsp;&nbsp;Clear&nbsp;&nbsp;&nbsp;</div>",
          '#type' => "button",
          '#value' => "Search",
            '#ajax' => array(
                'callback' => "::table_stuff",
                'wrapper' => "table_markup_id",
                'event' => 'click',),
        );

        $form['sub_table'] = array(
            '#prefix' => "<div id='table_markup_id'>",
          '#type' => 'item',
          '#markup' => $this->get_markup(),
            '#suffix' => "</div>",
        );
    }
    public function set_paging_requirments()
    {
        $orig_string = $this->get_limiter();
        $end = strpos($orig_string, "&%");
        $string = substr($orig_string, 0, $end);
        $this->limiter = $this->string_parser($string);
        $start = $end + 2;
        $post_page = substr($orig_string, $start, 200);
        $new_end = strpos($post_page, "&%");
        $string = substr($post_page,0, $new_end);
        $this->name_filter = $this->string_parser($string);
        $start = $new_end+2;
        $post_name = substr($post_page, $start, 200);
        $end = strpos($post_name, "&%");
        $string = substr($post_name, 0, $end);
        $this->email_filter = $this->string_parser($string);
        $start = $end + 2;
        $post_email = substr($post_name, $start, 200);
        $end = strpos($post_email, "&%");
        $string = substr($post_email, 0, $end);
        $this->status_filter = $this->string_parser($string);
        $start = $end + 2;
        $post_status = substr($post_email, $start, 200);
        $end = strpos($post_status, "&%");
        $string = substr($post_status, 0, $end);
        $this->sort_field = $this->string_parser($string);
        if($this->get_sort_field() == "" || $this->get_sort_field() == " ")
        {
            $this->sort_field = "rid";
        }



    }
    public function string_parser($string){
        $string = str_replace("%20", " ", $string);
        $string = str_replace("%26", "&", $string);
        $string = str_replace("%25", "%", $string);
        $string = str_replace("%23", "#", $string);
        $string = str_replace("%40", "@", $string);
        $string = str_replace("%2E", ".", $string);
        $string = str_replace("%2F", "/", $string);
        return $string;
    }

    public function search_form_submissions($form_state)
    {
        $this->set_paging_requirments();
        $this->start_of_page();
        $sql_result = $this->initial_query($form_state);
        $this->foreach_loop_for_initial($sql_result);

    }

    public function start_of_page()
    {
        $this->markup = "<p tabindex='0'>Bellow are submissions form the ENw member Form, and Member at Large form. From here you can approve a member request if there is no issue 
or review an issue with a potential account.</p>
 <table>
 <tr><th class='t_header'>Request ID</th><th class='t_header'>Civi Contact ID</th><th class='t_header'>Name</th><th class='t_header'>Email</th><th class='t_header'>Status</th><th class='t_header'>Comments</th><th class='t_header'>Process</th></tr>";

    }

    public function foreach_loop_for_initial($sql_result)
    {
        $first_id = null;
        $count = 0;
        foreach ($sql_result as $result) {
            $result = get_object_vars($result);
            if ($count == 0) {
                $this->last_id = $result['rid'];
            }
            if ($this->limiter == "1") {
                $this->build_row($result);
            }
            $count++;

        }
        if($this->get_limiter() == 1)
        {
            $this->find_page_need();
            $this->get_current_max_id();
        }
        if($this->get_limiter() != 1)
        {
            $this->establish_paging();
        }
        $this->end_table();
        $this->paging_markup();

    }
    public function establish_paging()
    {
        $this->find_page_need();
        $this->get_current_max_id();
        $this->additional_page_query();
    }
    public function end_table()
    {
        $this->markup = $this->get_markup()."
        </table>";
    }

    public function find_page_need()
    {
        $page_need = $this->get_last_id() / 50;
        if (ctype_digit((string)$page_need)) {
            $this->page_need = $page_need;
        } else {
            $this->page_need = ceil($page_need);
        }
    }

    public function initial_query(FormStateInterface  $form_state)
    {
        $query = $this->query_switch();
        $key = "rid";
        $this->sql->select_query($query, $key);
        $sql_result = $this->sql->get_result();
        return $sql_result;
    }
    public function set_filter_values()
    {
        $string= "&%".$this->get_name_filter()."&%".$this->get_email_filter()."&%".$this->get_status_filter()."&%".$this->get_sort_field();
        $string = str_replace( "%", "%25", $string);
        $string = str_replace( "&","%26", $string);
        $string = str_replace( " ","%20", $string);
        $string = str_replace( "#", "%23", $string);
        $string = str_replace( "@", "%40",$string);
        $string = str_replace( ".", "%2E", $string);
        $string = str_replace( "/", "%2F", $string);
        return $string;

    }

    public function query_switch()
    {
        \Drupal::logger("name_filter_check")->notice("name filter".$this->get_name_filter());
        if($this->get_name_filter() == " " || $this->get_name_filter() == "")
        {
            $name = false;
        }
        else{
            $name = true;
        }
        \Drupal::logger("email_filter_check")->notice("email filter".$this->get_email_filter());
        if($this->get_email_filter() == " " || $this->get_email_filter() == "")
        {
            $email = false;
        }
        else{
            $email = true;
        }
        \Drupal::logger("status_filter_check")->notice("status filter".$this->get_status_filter());
        if($this->get_status_filter() == " "  || $this->get_status_filter() == "")
        {
            $status = false;
        }
        else{
            $status = true;
        }
        if($name == false && $email == false && $status == false)
        {
            $query = "Select * from nfb_user_portal_user_request order by ".$this->get_sort_field()." desc limit 50;";
        }
        elseif ($name == true && $email == false && $status == false)
        {
            $query = "Select * from nfb_user_portal_user_request where member_name like '%".$this->get_name_filter()."%' order by ".$this->get_sort_field()." desc limit 50;";
        }
        elseif ($name == true && $email == true && $status == false)
        {
            $query = "Select * from nfb_user_portal_user_request where member_name like '%".$this->get_name_filter()."%' and member_email like '%".$this->get_email_filter()."%' order by ".$this->get_sort_field()." desc limit 50;";
        }
        elseif ($name == true && $email == true && $status == true)
        {
            $query = "Select * from nfb_user_portal_user_request where member_name like '%".$this->get_name_filter()."%' and member_email like '%".$this->get_email_filter()."%' and status = ".'"'.$this->get_status_filter().'"'." order by ".$this->get_sort_field()." desc limit 50;";
        }
        elseif ($name == true && $email == false && $status == true)
        {
            $query = "Select * from nfb_user_portal_user_request where member_name like '%".$this->get_name_filter()."%' and status = '".$this->get_status_filter()."' order by ".$this->get_sort_field()." desc limit 50;";
        }
        elseif ($name == false && $email == true && $status == false)
        {
            $query = "Select * from nfb_user_portal_user_request where  member_email like '%".$this->get_email_filter()."%' order by ".$this->get_sort_field()." desc limit 50;";
        }
        elseif ($name == false && $email == true && $status == true)
        {
            $query = "Select * from nfb_user_portal_user_request where member_email like '%".$this->get_email_filter()."%' and status = '".$this->get_status_filter()."' order by ".$this->get_sort_field()." desc limit 50;";
        }
        elseif ($name == false && $email == false && $status == true)
        {
            $query = "Select * from nfb_user_portal_user_request where  status = '".$this->get_status_filter()."' order by ".$this->get_sort_field()." desc limit 50;";
        }
        else
        {
            $query = "";
        }
        \drupal::logger("query_check")->notice("query text ". $query);
        return $query;
    }

    public function build_row($result)
    {
        $this->markup = $this->get_markup() . "<tr><td>" . $result['rid'] . "</td>
<td>" . $result['civi_contact_id'] . "</td><td>".$result['member_name']."</td><td>".$result['member_email']."</td><td>" . $result['status'] . "</td><td>" . $result['comment'] . "</td><td>&nbsp;&nbsp;&nbsp;<a href='/member_portal/admin/complete_request/".$result['rid']."%26%25".$this->get_limiter()."%26%25".$this->set_filter_values()."' class=''>&nbsp;&nbsp;&nbsp;Process&nbsp;&nbsp;&nbsp;</a></td></tr>";
    }
    public function get_current_max_id()
    {
        \Drupal::logger("filter_issue")->notice("sigh ". $this->get_limiter());
        $multiple = (int)$this->get_limiter() - 1;
        $subtractor = $multiple * 50;
        $max_id = $this->get_last_id() - $subtractor;
        $this->page_max_id = $max_id;
    }

    public function additional_page_query()
    {
        $this->get_current_max_id();
        $sql = \Drupal::database();
        $query = "Select * from nfb_user_portal_user_request where rid <= '" . $this->get_page_max_id() . "' order by rid desc limit 50;";
        \Drupal::logger("page_reload_issue")->notice("query val ".$query);
        $key = "sub_id";
        $sql_result = $sql->query($query)->fetchAllAssoc($key);
        foreach ($sql_result as $result) {
            $result = get_object_vars($result);
            $sub_array = get_object_vars(json_decode($result['form_submission_values']));
            $this->build_row($result, $sub_array);
        }
    }

    public function paging_markup()
    {
        $page = 1;
        $this->markup = $this->get_markup() . "<tr class='nfb-t-header'></tr></table>
    <p><a href='/nfb_member/admin/user_requests/1.".$this->set_filter_values()."' class='view_button' role='button' aria-label='First Page'>&nbsp;&nbsp;First&nbsp;&nbsp;</a> " . $this->paging_links($page) . " <a href='/nfb_member/admin/user_requests/" . $this->get_page_need().$this->set_filter_values() . "' class='view_button' role='button' aria-label='Last Page'>&nbsp;&nbsp;Last&nbsp;&nbsp;</a></p>";

    }

    public function paging_links($page)
    {
        $pager = '';
        while ($page <= $this->get_page_need()) {
            $pager = $pager . " <a href='/nfb_member/admin/user_requests/" . $page.$this->set_filter_values() . "' class='view_button' role='button' aria-label='Page Number ".$page."'>&nbsp;&nbsp;" . $page . "&nbsp;&nbsp;</a>";
            $page++;
        }
        return $pager;
    }
}