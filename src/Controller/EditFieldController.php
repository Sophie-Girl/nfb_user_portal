<?php
Namespace Drupal\nfb_user_portal\Controller;
use Drupal\address\Element\Address;
use \Drupal\Core\Controller\ControllerBase;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\html_builder\core_markup;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class EditFieldController extends ControllerBase
{
    public $field_map;
    public function get_field_map()
    {
        return $this->field_map;
    }
    public $contact_id;
    public function get_contact_id()
    {
        return $this->contact_id;
    }
    public $field;
    public function get_field(){
        return $this->field;
    }
    public $new_val;
    public function get_new_val()
    {
        return $this->new_val;
    }
    public $new_val_2;
    public function get_new_val_2()
    {
        return $this->new_val_2;
    }
    public $contact_data_id;
    public function get_contact_data_id()
    {
        return $this->contact_data_id;
    }
    public function content()
    {
        \Drupal::logger("ajax_test")->notice("I am getting the post");
        $this->set_field_map();
        $data =  $this->parse_array();
        return new JsonResponse($data);
    }
    public function set_field_map()
    {
        $request = Request::createFromGlobals();
        $this->field_map = $request->request->get('feildarray');
        \Drupal::logger("testing_ajax")->notice("array ".print_r($this->get_field_map(), true));
    }

    public function parse_array()
    {
        $cool = "Nothing";
        $this->contact_id = $this->get_field_map()[0];
        $this->field = $this->get_field_map()[1];
        $string = $this->get_field_map()[2];
        $this->new_val = $this->clean_string($string);
        if($this->get_field() == "zip")
        {
            $string = $this->get_field_map()[2];
            $array[1] = $this->clean_string($string); // zip
            $string = $this->get_field_map()[3];
            $array[2] = $this->clean_string($string); // street
            $string = $this->get_field_map()[4];
            $array[3] = $this->clean_string($string); // line 2
            $string = $this->get_field_map()[5];
            $array[4] = $this->clean_string($string); // city
            $string = $this->get_field_map()[6];
            $array[5] = $this->clean_string($string); // state
            $string = $this->get_field_map()[7];
            $array[6] = $this->clean_string($string); // country
            $this->new_val = $array;
        }
        \Drupal::logger("country_check")->notice("field_map_array ".print_r($this->get_field_map(), true));
        $this->civi_query($cool);
        return $cool;
    }
    public function clean_string($string)
    {
        $string = str_replace(";", "", $string);
        return $string;
    }
    public function civi_query(&$cool)
    {
        $civi = new query_base();
        $this->entity_switch($civi);
        \Drupal::logger("checking")->notice("entity_check :".$civi->get_entity());
        if($civi->get_entity() != "Contact")
        {   \Drupal::logger("checking")->notice("entity_check :".$civi->get_entity());
            $this->find_primary_id($civi);}
        $civi->mode = "update";
        $this->update_params_switch($civi);
        $cool =  $this->make_update($civi);

    }
    public function entity_switch(query_base &$civi)
    {
        \Drupal::logger("ajax_testing_step_1")->notice("entity switch ".$this->get_field());
        switch ($this->get_field())
        {
            case "f_name":
                $civi->entity = "Contact"; break;
            case "l_name":
                $civi->entity = "Contact"; break;
            case "email":
                $civi->entity = "Email"; break;
            case "phone":
                $civi->entity = "Phone"; break;
            case "street_address":
                $civi->entity = "Address"; break;
            case "State":
                $civi->entity = "Address"; break;
            case "Line 2":
                $civi->entity = "Address"; break;
            case "City":
                $civi->entity = "Address"; break;
            case "zip":
                $civi->entity = "Address"; break;
            case "lang":
                $civi->entity = "Contact"; break;
            case "dob":
                $civi->entity = "Contact"; break;
            case "gender":
                $civi->entity = "Contact"; break;
            case "pronouns":
                $civi->entity = "Contact"; break;
            case "blind":
                $civi->entity = "Contact"; break;
            case "deaf":
                $civi->entity = "Contact"; break;
            case "disability":
                $civi->entity = "Contact"; break;
            case "media":
                $civi->entity = "Contact"; break;
            case "dog":
                $civi->entity = "Contact"; break;
            case "braille":
                $civi->entity = "Contact"; break;
        }
    }
    public function find_primary_id(query_base &$civi)
    {
        $civi->params =  [
            'select' => [
                '*',
            ],
            'where' => [
                ['contact_id', '=', $this->get_contact_id()],
                ['is_primary', '=', TRUE],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        ];
        $civi->mode = "get";
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        \Drupal::logger("ajax_test")->notice("array: ".print_r($result, true));
        $count = $result->count();
        if($count != "0")
        {
            $data = $result->first();
            \Drupal::logger("ajax_test")->notice("array: ".print_r($data, true));
            $this->contact_data_id = $data['id'];
        }
    }
    public function update_params_switch(query_base &$civi)
    {
        switch ($this->get_field())
        {
            case "f_name":
                $civi->params = [
                    'values' => [
                        'first_name' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "l_name":
                $civi->params = [
                    'values' => [
                        'last_name' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "dob":
                $civi->params = [
                    'values' => [
                        'birth_date' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "lang":
                $civi->params = [
                    'values' => [
                        'preferred_language' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "gender":
                \Drupal::logger("I_hate_this")->notice("gender_sent ".$this->get_new_val());
                $civi->params = [
                    'values' => [
                        'gender_id:name' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "pronouns":
                $civi->params = [
                    'values' => [
                        'Individual_s_Information.Pronouns' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "blind":
                $civi->params = [
                    'values' => [
                        'Medical_Issues.Is_Blind' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "deaf":
                $civi->params = [
                    'values' => [
                        'Medical_Issues.Is_Deaf' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "disability":
                $civi->params = [
                    'values' => [
                        'Medical_Issues.Other_Disability' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "media":
                $civi->params = [
                    'values' => [
                        'Media_Preference.Media_Preference' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "email":
                $civi->params = [
                    'values' => [
                        'email' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_data_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "phone":
                $civi->params = [
                    'values' => [
                        'phone' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_data_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "zip":
                $civi->params = [
                    'values' => [
                        'street_address' => $this->get_new_val()[2],
                        'supplemental_address_1' => $this->get_new_val()[3],
                        'city' => $this->get_new_val()[4],
                        'state_province_id' => $this->get_new_val()[5],
                        'country_id' => $this->get_new_val()[6],
                        'postal_code' => $this->get_new_val()[1],
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_data_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "braille":
                $civi->params = [
                    'values' => [
                        'Individual_s_Information.Braille_Reader' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "dog":
                $civi->params = [
                    'values' => [
                        'IndividualNFB.ServiceAnimal' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
        }
    }
    public function make_update(query_base  $civi)
    {
        $civi->civi_api_v4_query();
        if($this->get_field() == "zip")
        {
            $data[0] = $this->get_state_name($civi);
            $data[1] = $this->find_country_name($civi);
        }
        elseif($this->get_field() == "blind" || $this->get_field() == "deaf" ||
         $this->get_field() == "dog" || $this->get_field() == "braille")
        {
            if ($this->get_new_val() == "1")
            {
                $data[0] = "Yes";
            }
            else{
                $data[0] = "No";
            }
        }
        elseif($this->get_field() == "gender")
        {
         /*   $civi->mode = "get";
            $civi->entity = "OptionValue";
            $civi->params = [
                'select' => [
                    '*',
                ],
                'where' => [
                    ['id', '=', $this->get_new_val()],
                    ['option_group_id', '=', 3],
                ],
                'limit' => 25,
                'checkPermissions' => FALSE,
            ];
            $civi->civi_api_v4_query();
            $result = $civi->get_civi_result();
            $state = $result->first(); */
            $data = $this->get_new_val();
        }
        elseif($this->get_field() == "lang")
        {
            $civi->mode = "get";
            $civi->entity = "Contact";
            $civi->params = [
                'select' => [
                    '*',
                    'custom.*',
                ],
                'where' => [
                    ['id', '=', $this->get_contact_id()],
                ],
                'limit' => 25,
                'checkPermissions' => FALSE,
            ];
            $civi->civi_api_v4_query();
            $result = $civi->get_civi_result();
            $contact = $result->first();
            $data[0] = $contact['preferred_language'];
            if($data[0] == "en_US")
            {
                $data[0] = "English";
            }
            else{
                $civi->mode = "get";
                $civi->entity = "OptionValue";
                $civi->params = [
                    'select' => [
                        '*',
                    ],
                    'where' => [
                        ['option_group_id', '=', 50],
                        ['id', '=', $data[0]],
                    ],
                    'limit' => 25,
                    'checkPermissions' => FALSE,
                ];
                $civi->civi_api_v4_query();
                $result = $civi->get_civi_result();
                $gp = $result->first();
                $data[0] = $gp['label'];
            }
            \drupal::logger("beth_issue")->notice($data[0]." data for lang");
        }
        elseif ($this->get_field() == "media")
        {
            $civi->mode = "get";
            $civi->entity = "Contact";
            $civi->params = [
                'select' => [
                    '*',
                    'custom.*',
                ],
                'where' => [
                    ['id', '=', $this->get_contact_id()],
                ],
                'limit' => 25,
                'checkPermissions' => FALSE,
            ];
            $civi->civi_api_v4_query();
            $result = $civi->get_civi_result();
            $contact = $result->first();
            $data[0] = $contact['Media_Preference.Media_Preference'];
        }
        else{
            $data = "success";
        }
        return $data;
    }
    public function get_state_name(query_base  $civi)
    {
        $civi->mode = "get";
        $civi->entity = "StateProvince";
        $civi->params = array(
            'select' => [
                '*',
            ],
            'where' => [
                ['id', '=', $this->get_new_val()[5]],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $state = $result->first();
        return $state['name'];
    }
    public function find_country_name(query_base  $civi)
    {
        $civi->mode = "get";
        $civi->entity = "Country";
        \Drupal::logger("country_check")->notice("country result: ".$this->get_new_val_2());
        $civi->params = array(
            'select' => [
                '*',
            ],
            'where' => [
                ['id', '=', $this->get_new_val()[6]],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        );
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $country = $result->first();
        \Drupal::logger("country_check")->notice("country result: ".print_r($result, true));
        return $country['name'];
    }





}