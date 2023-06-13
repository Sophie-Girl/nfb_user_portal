<?php
namespace Drupal\nfb_user_portal\SQL\admin;
class User_request_queries
{
    public $database;
    public $result;
    public function get_result()
    {
      return  $this->result;
    }
    public function select_query($query, $key)
    {
        $this->database = \Drupal::database();
        $this->result = $this->database->query($query)->fetchAllAssoc($key);
        $this->database = null;
    }
    public function update_query($query)
    {
        $this->database = \Drupal::database();
        $this->result = $this->database->query($query)->execute();
        $this->database = null;
    }
}