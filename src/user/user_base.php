<?php
namespace Drupal\nfb_user_portal\user;
use Drupal\nfb_user_portal\civi_query\query_base;
class user_base
{
    public $user_id;
    public $user_role;
    public $user_name;
    public $user_email;
    public $user_language;
    public $user_civi_id;
    public function get_user_id()
    {
        return $this->user_id;
    }
    public function get_user_role()
    {
        return $this->user_role;
    }
    public function get_user_name()
    {
        return$this->user_name;
    }
    public function get_user_email()
    {
        return $this->user_email;
    }
    public function get_user_language()
    {
        return $this->user_language;
    }
    public function get_user_civi_id()
    {
        return $this->user_civi_id;
    }
    public function set_user_data()
    {
        $user = \Drupal::currentUser();
        $this->user_name = $user->getAccount()->getAccountName();
        $this->user_email = $user->getAccount()->getEmail();
        $this->user_language = $user->getPreferredLangcode();
        $this->user_id = $user->getAccount()->id();
        $this->user_role = $user->getRoles();
        $this->set_civi_useR_data();
    }
    public function set_civi_useR_data()
    {
        \Drupal::logger("civ_api_error")->notice*("Drupal_user_id: ".$this->get_user_id());
        $query = new query_base();
        $query->entity = "User";
        $query->mode = "get";
        $query->params = array(
            'sequential' => 1,
            'id' => $this->get_user_id(),
        );
        $query->civi_api_v3_query();
        foreach ($query->get_civi_result()['values'] as $user_data)
        {
            $this->user_civi_id = $user_data['contact_id'];
        }
    }
}