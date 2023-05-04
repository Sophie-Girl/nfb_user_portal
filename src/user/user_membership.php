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
        $this->civi_contact_set();
        $this->find_member_records();
        $this->set_memberhsip_array();
    }
    public function find_member_records()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Membership";
        $civi->params = [
            'select' => [
                '*',
                'membership_type_id:label',
                'status_id:label',
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
    public function set_memberhsip_array()
    {
        $count = $this->get_member_result()->count();
        $current = 0;
        $member_array = [];
        while($current <= $count)
        {
            $member = $this->member_result->itemat($current);
            $member_array[$current][0] =  $member['membership_type_id:label'];
            $member_array[$current][1] =  $member['membership_type_id'];
            $member_array[$current][2] = $member['status_id'];
            $member_array[$current][3] = $member['status_id:label'];
            $member_array[$current][4] = $member['join_date'];
            $member_array[$current][5] = $member['end_date'];
            $member_array[$current][6] = $member['id'];
            $current++;
        }
        $this->membership_array = $member_array;
    }
    public function find_media_type($membership_id, $type)
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "LineItem";
        $civi->params = [
            'select' => [
                '*',
                'price_field_id:label',
                'price_field_value_id:label',
            ],
            'where' => [
                ['entity_table', '=', 'civicrm_membership'],
                ['qty', '!=', 0],
                ['entity_id', '=', $membership_id],
            ],
            'limit' => 25,
        ];
        $civi->civi_api_v4_query();
        $array = $civi->get_civi_result();
        $count = $array->count();
        $current = 0;
        $media_type = null;
        while($current <= $count)
        {
            $line_item =  $array->itemat($current);
            if($type == "6")
            {
                switch ($line_item['price_field_id']) {
                    case "219":
                        if( $media_type == null)
                        {
                            $media_type = "Print";
                        }
                        break;
                    case "220":
                        if( $media_type == null)
                        {
                            $media_type = "Braille";
                        }
                        break;
                    case "221":
                        if( $media_type == null)
                        {
                            $media_type = "USB";
                        }
                        break;
                }
                if($media_type == null)
                {
                    $media_type = "Email";
                }
            }
            else {
                switch ($line_item['price_field_id']) {
                    case "223":
                        if ($media_type == null) {
                            $media_type = "Print";
                        }
                        break;
                    case "224":
                        if ($media_type == null) {
                            $media_type = "Braille";
                        }
                        break;
                }
                if($media_type == null)
                {
                    $media_type = "Email";
                }
            }
            $current++;
        }
        return $media_type;
    }
}