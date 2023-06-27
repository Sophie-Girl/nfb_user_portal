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
    public function query_switch(FormStateInterface  $form_State)
    {

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