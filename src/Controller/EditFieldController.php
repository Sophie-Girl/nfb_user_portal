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
        $this->set_field_map();
        $data =  $this->parse_array();
        return new JsonResponse($data);
    }
    public function set_field_map()
    {
        $request = Request::createFromGlobals();
        $this->field_map = $request->request->get('feildarray');
    }

    public function parse_array()
    {
        $cool = "Nothing";
        $this->contact_id = $this->get_field_map()[0];
        $this->field = $this->get_field_map()[1];
        $this->new_val = $this->get_field_map()[2];
        if($this->get_field() == "state")
        {
            $this->new_val_2 = $this->get_field_map()[3];
        }
        $this->civi_query($cool);
        return $cool;
    }
    public function civi_query(&$cool)
    {
        $civi = new query_base();
        $this->entity_switch($civi);
        if($civi->get_entity() != "Contact")
        {$this->find_primary_id($civi);}
        $civi->mode = "update";
        $this->update_params_switch($civi);
        $cool =  $this->make_update($civi);

    }
    public function entity_switch(query_base &$civi)
    {
        switch ($this->get_field())
        {
            case "f_name":
                $civi->entity = "Contact";
            case "l_name":
                $civi->entity = "Contact";
            case "email":
                $civi->entity = "Email";
            case "phone":
                $civi->entity = "Phone";
            case "street_address":
                $civi->entity = "Address";
            case "State":
                $civi->entity = "Address";
            case "Line 2":
                $civi->entity = "Address";
            case "City":
                $civi->entity = "Address";
            case "zip":
                $civi->entity = "Address";
            case "lang":
                $civi->entity = "Contact";
            case "dob":
                $civi->entity = "Contact";
            case "gender":
                $civi->entity = "Contact";
            case "pronouns":
                $civi->entity = "Contact";
            case "blind":
                $civi->entity = "Contact";
            case "deaf":
                $civi->entity = "Contact";
            case "disability":
                $civi->entity = "Contact";
            case "media":
                $civi->entity = "Contact";
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
        $count = $result->count();
        if($count != "0")
        {
            $data = $result->first();
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
                $civi->params = [
                    'values' => [
                        'gender_id' => $this->get_new_val(),
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
                        'Subscriptions.Media' => $this->get_new_val(),
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
            case "street_address":
                $civi->params = [
                    'values' => [
                        'street_address' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_data_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "Line 2":
                $civi->params = [
                    'values' => [
                        'supplemental_address_1' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_data_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "City":
                $civi->params = [
                    'values' => [
                        'city' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_data_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "zip":
                $civi->params = [
                    'values' => [
                        'postal_code' => $this->get_new_val(),
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_data_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
            case "State":
                $civi->params = [
                    'values' => [
                        'state_province_id' => $this->new_val,
                        'country_id' => $this->new_val_2,
                    ],
                    'where' => [
                        ['id', '=', $this->get_contact_data_id()],
                    ],
                    'checkPermissions' => FALSE,
                ]; break;
        }
    }
    public function make_update(query_base  $civi)
    {
        $civi->civi_api_v4_query();
        return "success";
    }




}