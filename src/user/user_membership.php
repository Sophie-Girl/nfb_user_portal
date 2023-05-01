<?php
namespace Drupal\nfb_user_portal\user;
use Drupal\nfb_user_portal\civi_query\query_base;
class user_membership extends user_civi {
    public $membership_array;
    public function get_membership_array()
    {return $this->membership_array;}
    public $member_result;
    public function get_member_result()
    {
        return $this->member_result;
    }
    // Connell Sophi array structure should be ass follows 0: Membership ID
    // 1: Label 2: Status ID  3: status label 4: join date 5:end date
    public function set_up_member_page_data()
    {
        $this->set_user_data();
        $this->get_core_contact_info();
        $this->email_set();
        $this->phone_set();
        $this->address_set();
        $this->find_member_records();
    }
    public function find_member_records()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Membership";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['contact_id', '=', $this->get_user_civi_id()],
            ],
            'limit' => 50,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query();
        $this->member_result = $civi->get_civi_result();
    }
}