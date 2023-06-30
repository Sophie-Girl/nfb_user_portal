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

    public function build_form_array(&$form, FormStateInterface  $form_state, $params)
    {
        $this->params = $params;

    }
    public function sql_query()
    {
        $this->sql = new User_request_queries();
        $query = "select * from nfb_user_portal_content order by active desc";
        $key = "cid";
        $this->sql->select_query($query, $key);
        foreach ($this->sql->get_result() as $content)
        {
            $content = get_object_vars($content);
            $array_markup = $content['markup'];
            $array_markup = json_decode($array_markup);
            $array_markup = get_object_vars($array_markup);
            $this->build_table_row($content, $array_markup);
        }

    }
    public function query_setup(FormStateInterface  $form_state)
    {
        $this->set_values($form_state);
        $this->assign_filters();
    }
    public function assign_filters()
    {
        \Drupal::logger("type_filter_check")->notice("name filter".$this->get_name_filter());
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
        \Drupal::logger("status_filter_check")->notice("status filter".$this->get_status_filter());
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


    }
    public function query_switches($type, $title, $active )
    {

    }
    public function set_values(FormStateInterface  $form_State)
    {
        $orig_string = $this->get_params();
        $end = strpos($orig_string, "&%");
        $string = substr($orig_string, 0, $end);
        $this->limiter = $this->string_parser($string);
        $start = $end + 2;
        $post_page = substr($orig_string, $start, 200);
        $new_end = strpos($post_page, "&%");
        $string = substr($post_page,0, $new_end);
        $this->title_filt = $this->string_parser($string);
        $start = $new_end + 2;
        $post_title = substr($post_page, $start, 200);
        $new_end = strpos($post_page, "&%");
        $string = substr($post_page,0, $new_end);
        $this->type_filt = $this->string_parser($string);
        $start = $new_end + 2;
        $post_page = substr($post_title, $start, 200);
        $end = strpos($post_page, "&%");
        $string = substr($post_page,0, $end);
        $this->active_filter = $this->string_parser($string);
        $start = $end + 2;
        $post_page = substr($post_page, $start, 200);
        $end = strpos($post_page, "&%");
        $string = substr($post_page,0, $end);
        $this->sort_field = $this->string_parser($string);
    }
    public function build_table_row($content, $markup_array)
    {
        $this->markup = $this->get_markup()."<tr><td>".$content['cid']."</td><td>".$content['markup_type']."</td><td>".$markup_array['title']."</td><td>".$content['tab']."</td>
        <td>".$content['limiter']."</td><td>".$content['civi_entity']."</td><td>".$content['active']."</td><td>".$markup_array['weight']."</td><td><a href='/member_portal/admin/markup/".$content['cid']."' role='button' aria-label='Edit '>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></td></tr>";

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


}