<?php
Namespace Drupal\nfb_user_portal\html_builder\Admin;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;

class markup_talbe_create extends markup_table_edit {

    public $sql;
    public $civi_query;
    public $markup;
    public function get_markup()
    {
        return $this->markup;
    }
    public $type_filt;
    public function get_type_filt()
    {
        return $this->type_filt;
    }
    public $title_filt;
    public function get_title_filt()
    {
        return $this->title_filt;
    }
    public $active_filter;
    public function get_active_filter()
    {
        return $this->active_filter;
    }
    public $sort_field;
    public function get_sort_feidl()
    {
        return $this->sort_field;
    }
    public $limiter_filt;
    public function get_lmiter_filt()
    {
        return $this->limiter_filt;
    }
    public $params;
    public function get_params()
    {
      return  $this->params;
    }
    public $title_status;
    public function get_title_status()
    {
        return $this->title_status;
    }
    public function build_form_array(&$form, FormStateInterface  $form_state)
    {
        $this->params = $form_state->getValue("filter_val");
        $this->set_values($form_state);
        $this->sql_query($form_state);
        $form['type_filt'] = array(
            '#type' => "select",
            '#title' => "Filter By Markup Type",
            '#options' => array(
                '' => '- select -',
              'intro_text' => "Intro Text",
                "member_benefit" => "Member Benefit",
                'faq' => "FAQ",
                'content_text' => "Conent Text"
            ),
        );
        $form['title_filt'] = array(
          '#title' => "Filter By Markup Title",
            "#type" => "textfield",
            '#size' => "20",
        );
        $form['filter_val'] = array(
          '#type' => "textfield",
          '#title' => "IGNORE ME!",
        );
        $form['active_filt'] = array(
            '#type' => "select",
            '#title' => "Filter By Active Status",
            '#options' => array(
                '' => '- select -',
                '0' => "No",
                '1'=> "Yes",
            ),
        );
        $form['ajax_button'] = array(
            '#prefix' => "<div id='clear-filter' style='display: inline-block' role='button' class='btn btn-primary'>&nbsp;&nbsp;&nbsp;Clear&nbsp;&nbsp;&nbsp;</div>",
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
    public function sql_query(FormStateInterface $form_state)
    {

        $this->sql = new User_request_queries();
        $query = $this->query_setup($form_state);
        $key = "cid";
        $this->sql->select_query($query, $key);
        $this->header_build();
        foreach ($this->sql->get_result() as $content)
        {
            $content = get_object_vars($content);
            $array_markup = $content['markup'];
            $array_markup = json_decode($array_markup);
            $array_markup = get_object_vars($array_markup);
            if($this->get_title_status() == true){
            if($this->get_title_filt() != "" and $this->get_title_filt() != " ")
            {
                $filter_value = strtolower(trim($this->get_title_filt()));
                $actual_value = strtolower(trim($array_markup['title']));
                if(strpos(" ".$actual_value, $filter_value) > 0)
                {
                    $this->build_table_row($content, $array_markup);
                }
            }
            }
            else {
                $this->build_table_row($content, $array_markup);
            }
            }
        $this->end_table();

    }
    public function query_setup(FormStateInterface  $form_state)
    {
        $this->set_values($form_state);
        $query =  $this->assign_filters();
        return $query;
    }
    public function assign_filters()
    {
        \Drupal::logger("type_filter_check")->notice("name filter".$this->get_type_filt());
        if($this->get_type_filt() == " " || $this->get_type_filt() == "")
        {
            $type = false;
        }
        else{
            $type = true;
        }
        if($this->get_title_filt() == " " || $this->get_email_filter() == "")
        {
            $title = false;
        }
        else{
            $title = true;
        }
        \Drupal::logger("status_filter_check")->notice("status filter".$this->get_active_filter());
        if($this->get_active_filter() == " "  || $this->get_active_filter() == "")
        {
            $active = false;
        }
        else{
            $active = true;
        }
        if($this->get_sort_field() == " "  || $this->get_sort_field()== "")
        {
          $this->sort_field = "cid";
        }
        $query = $this->query_switches($type, $title, $active);
        return $query;
    }
    public function query_switches($type, $title, $active )
    {
            If($type == false && $title == false && $active == false)
            {
                $query = "select * from nfb_user_portal_content order by  ".$this->get_sort_field()." desc";
                $this->title_status = false;
            }
            elseif($type == True && $title == false && $active == false)
            {
                $query = "select * from nfb_user_portal_content where markup_type = '".$this->get_type_filt()."'order by  ".$this->get_sort_field()." desc";
                $this->title_status = false;
            }
            elseif($type == True && $title == true && $active == false)
            {
                $query = "select * from nfb_user_portal_content where markup_type = '".$this->get_type_filt()."'order by  ".$this->get_sort_field()." desc";
                $this->title_status = true;
            }
            elseif($type == True && $title == true && $active == true)
            {
                $query = "select * from nfb_user_portal_content where markup_type = '".$this->get_type_filt()."' and active = '".$this->get_active_filter()."'order by  ".$this->get_sort_field()." desc";
                $this->title_status = true;
            }
            elseif($type == false && $title == true && $active == true)
            {
                $query = "select * from nfb_user_portal_content where  active = '".$this->get_active_filter()."'order by  ".$this->get_sort_field()." desc";
                $this->title_status = true;
            }
            elseif($type == false && $title == false && $active == true)
            {
                $query = "select * from nfb_user_portal_content where  active = '".$this->get_active_filter()."'order by  ".$this->get_sort_field()." desc";
                $this->title_status = false;
            }
            return $query;
    }
    public function set_values(FormStateInterface  $form_state)
    {
        $orig_string = $this->get_params();

        $end = strpos($orig_string, "&%");
        $string = substr($orig_string, 0, $end);
        $this->type_filt = $this->string_parser($string);
        $start = $end + 2;
        $post_page = substr($orig_string, $start, 200);
        $new_end = strpos($post_page, "&%");
        $string = substr($post_page,0, $new_end);
        $this->title_filt = $this->string_parser($string);
        $start = $new_end + 2;
        $post_title = substr($post_page, $start, 200);
        $new_end = strpos($post_title, "&%");
        $this->active_filter = $post_title;
    }
    public function build_table_row($content, $markup_array)
    {
        $this->markup = $this->get_markup()."<tr><td>".$content['cid']."</td><td>".$content['markup_type']."</td><td>".$markup_array['title']."</td><td>".$content['tab']."</td>
        <td>".$content['limiter']."</td><td>".$content['civi_entity']."</td><td>".$content['active']."</td><td>".$markup_array['weight']."</td><td><a href='/member_portal/admin/content/".$content['cid']."' role='button' aria-label='Edit '>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></td></tr>";

    }
    public function header_build()
    {
        $this->markup = "<table>
<tr><th>Content ID</th><th>Markup Type</th><th>Markup Title</th><th>Tab</th><th>Limiter</th><th>Civi Entity</th><th>Active</th>
<th>Weight</th><th>Edit</th></tr>";
    }
    public function end_table()
    {
        $this->markup = $this->get_markup()."</table>";
    }
    public function other_additional_page_query()
    {
        $this->get_current_max_id();
        $sql = \Drupal::database();
        $query = "Select * from nfb_user_portal_content where cid <= '" . $this->get_page_max_id() . "' order by rid desc limit 50;";
        \Drupal::logger("page_reload_issue")->notice("query val ".$query);
        $key = "sub_id";
        $sql_result = $sql->query($query)->fetchAllAssoc($key);
        foreach ($sql_result as $result) {
            $result = get_object_vars($result);
            $sub_array = get_object_vars(json_decode($result['form_submission_values']));
            $this->build_row($result, $sub_array);
        }
    }



}