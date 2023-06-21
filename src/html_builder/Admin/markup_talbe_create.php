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
     //   $query = "select * from ";
    }


}