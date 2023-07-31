<?php
Namespace Drupal\nfb_user_portal\html_builder;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;
class member_account {
    public $intro_markup;
    public function get_intro_markup()
    {
        return $this->intro_markup;
    }
    public $sql_result;
    public function get_sql_result()
    {
        return $this->sql_result;
    }
    public function build_intro_markup()
    {
        $this->sql_query();
        $makrup = $this->process_reuslt();
        return $makrup;
    }
    public function sql_query()
    {
        $key = "cid";
        $query = "select * from nfb_user_portal_content where markup_type = 'intro_text' and tab = 'manage_account' and active = '0';";
        $sql = new User_request_queries();
        $sql->select_query($query, $key);
        $this->sql_result = $sql->get_result();
    }
    public function process_reuslt()
    {
        $markup = false;
        foreach ($this->get_sql_result() as $content)
        {
            $content =  get_object_vars($content);
            $array = json_decode($content['markup']);
            $array = get_object_vars($array);
            $markup = $array['text'];
        }
        if(!$markup)
        {
            $markup  = "<p></p>";
        }
        return $markup;
    }
}