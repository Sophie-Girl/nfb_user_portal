<?php
namespace Drupal\nfb_user_portal\user;
use Drupal\nfb_user_portal\civi_query\query_base;
class user_civi extends user_base
{
    public $first_name;
    public function get_first_name()
    {return $this->first_name;}
    public $last_name;
    public function get_last_name()
    {return $this->last_name;}
    public $prime_email;
    public function get_prime_email()
    {return $this->prime_email;}
    public $prime_phone;
    public function get_prime_phone()
    {return $this->prime_phone;}
    public $prime_street;
    public function get_prime_street()
    {return $this->prime_street;}
    public $prime_line_2;
    public function get_prime_line_2()
    {return $this->prime_line_2;}
    public $prime_city;
    public function get_prime_city()
    {return $this->prime_city;}
    public $prime_state;
    public function get_prime_state()
    {return $this->prime_state;}
    public $prime_zip;
    public function get_prime_zip()
    {return $this->prime_zip;}
    public function prime_country()
    {return $this->prime_country();}
    public  $dob;
    public function get_dob()
    {return $this->dob;}
}