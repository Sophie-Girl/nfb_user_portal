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
    public $prime_country;
    public function get_prime_country()
    {return $this->prime_country;}
    public  $dob;
    public function get_dob()
    {return $this->dob;}
    public $gender;
    public function get_gender()
    {return $this->gender;}
    public $pronouns;
    public function get_pronouns()
    {return $this->pronouns;}
    public $ethnicity;
    public function get_ethnicity()
    {return $this->ethnicity;}
    public $is_blind;
    public function get_is_blimd()
    {return $this->is_blind;}
    public $dog_user;
    public function get_dog_user()
    {return $this->dog_user;}
    public $deaf;
    public function get_deaf()
    {return $this->deaf;}
    public $braille_reader;
    public function get_braille_reader()
    {return $this->braille_reader;}
    public $disability;
    public function get_disability()
    {return $this->disability;}
    public $media_type;
    public function get_media_type()
    {return $this->media_type;}
    public function civi_contact_set()
    {
        $this->set_user_data();
        $this->get_core_contact_info();
        $this->email_set();
        $this->phone_set();
        $this->address_set();
    }
    public function get_core_contact_info()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Contact";
        $civi->params = array(
            'select' => [
                'first_name',
                'last_name',
                'birth_date',
                'gender_id:label',
                'custom.*'
            ],
            'where' => [
                ['id', '=', $this->get_user_civi_id()],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        );
        $civi->civi_api_v4_query();
        $contact = $civi->get_civi_result();
        $contact = $contact->first();
        $this->first_name = $contact['first_name'];
        $this->last_name = $contact['last_name'];
        $this->dob = $contact['birth_date'];
        $this->gender = $contact['gender_id:label'];
        $this->is_blind = $contact['Medical_Issues.Is_Blind'];
        $this->deaf = $contact['Medical_Issues.Is_Deaf'];
        $this->disability = $contact['Medical_Issues.Other_Disability'];
        $this->dog_user = $contact['Individual_s_Information.Uses_a_Service_Animal'];
        $this->pronouns = $contact['Individual_s_Information.Pronouns'];
        $this->ethnicity = $contact['Individual_s_Information.Race_Ethnicity'];
        $civi = null;
    }
    public function email_set()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Email";
        $civi->params = array(
            'select' => [
                'email',
            ],
            'where' => [
                ['contact_id', '=', $this->get_user_civi_id()],
                ['is_primary', '=', TRUE],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        );
        $email =  $civi->get_civi_result();
        $email = $email->first();
        $this->prime_email = $email['email'];
        $civi = null;
    }
    public function phone_set()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Phone";
        $civi->params = array(
            'select' => [
                'phone',
            ],
            'where' => [
                ['contact_id', '=', $this->get_user_civi_id()],
                ['is_primary', '=', TRUE],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        );
        $phone =  $civi->get_civi_result();
        $phone = $phone->first();
        $this->prime_phone = $phone['phone'];
        $civi = null;
    }
    public function address_set()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Address";
        $civi->params = array(
            'select' => [
                'street_address',
                'supplemental_address_1',
                'city',
                'state_province_id:label',
                'country_id:label',
                'postal_code',
            ],
            'where' => [
                ['contact_id', '=', $this->get_user_civi_id()],
                ['is_primary', '=', TRUE],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        );
        $address =  $civi->get_civi_result();
        $address = $address->first();
        $this->prime_street = $address['street_address'];
        $this->prime_line_2 = $address['supplemental_address_1'];
        $this->prime_city = $address['city'];
        $this->prime_state = $address['state_province_id:label'];
        $this->prime_country = $address['country_id:label'];
        $this->prime_zip = $address['postal_code'];
        $civi = null;
    }


}