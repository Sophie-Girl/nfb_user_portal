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
    public function build_form_array(&$form, FormStateInterface  $form_state)
    {

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

        }

    }
    public function build_table_row($content, $markup_array)
    {
        $this->markup = $this->get_markup()."<tr><td>".$content['cid']."</td><td>".$content['markup_type']."</td><td>".$markup_array['title']."</td><td>".$content['tab']."</td>
        <td>".$content['limiter']."</td><td>".$content['civi_entity']."</td><td>".$content['active']."</td><td>".$markup_array['weight']."</td><td><a href='/member_portal/admin/markup/".$content['cid']."' role='button' aria-label='Edit '>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></td></tr>";

    }


}