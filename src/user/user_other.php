<?php
namespace Drupal\nfb_user_portal\user;
use Drupal\nfb_user_portal\civi_query\query_base;
class user_other extends user_membership
{


    public $contribution_array;
    public function get_contribution_array()
    {return $this->contribution_array;}
    public $event_array;
    public function get_event_array()
    {return $this->event_array;}
    public function other_page_markup()
    {
        $this->civi_contact_set();
        $this->find_member_records();
        $this->set_memberhsip_array();
        $this->find_events();
        $this->find_contribution();
    }
    public function find_contribution()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Contribution";
        $civi->params = array(
            'select' => [
                '*',
            ],
            'where' => [
                ['contact_id', '=', $this->get_user_civi_id()],
                ['financial_type_id', '=', 1],
            ],
            'limit' => 50,
            'checkPermissions' => FALSE,
        );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        $current = 0;
        $array = [];
        while($current <= $count )
        {
            $contribution = $result->itemat($current);
            $array[$current]['date'] = $contribution['receive_date'];
            $array[$current]['amount'] = $contribution['total_amount'];
            $current++;
        }
        $this->contribution_array = $array;
    }
    public function find_events()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Participant";
        $civi->params = array(
            'select' => [
                '*',
                'event.*',
            ],
            'join' => [
                ['Event AS event', 'LEFT', ['event_id', '=', 'event.id']],
            ],
            'where' => [
                ['contact_id', '=', $this->get_user_civi_id()],
            ],
            'limit' => 50,
        );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        $current = 0;
        $array = [];
        while($current <= $count)
        {
            $event = $result->itemat($current);
            $array[$current]['title'] = $event['event.title'];
            $array[$current]['start_date'] = $event['event.start_date'];
            $array[$current]['end_date'] = $event['event.end_date'];
            $current++;
        }
        $this->event_array =  $array;
    }

}