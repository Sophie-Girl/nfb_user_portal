<?php
namespace Drupal\nfb_user_portal\user;
use Drupal\nfb_user_portal\civi_query\query_base;
class user_membership extends user_civi {
    public $membership_array;
    public function get_membership_array()
    {return $this->membership_array;}
    // Connell Sophi array structure should be ass follows 0: Memberhisp Id
    // 1: Label 2: Status Id  3: status label 4: join date 5:end date
}