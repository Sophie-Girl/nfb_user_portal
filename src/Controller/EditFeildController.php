<?php
Namespace Drupal\nfb_user_portal\Controller;
use Drupal\address\Element\Address;
use \Drupal\Core\Controller\ControllerBase;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\html_builder\core_markup;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class EditFeildController extends ControllerBase
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
    public function content()
    {

    }
    public function set_field_map()
    {
        $request = Request::createFromGlobals();
        $this->field_map = $request->request->get('feildmap');
    }

    public function parse_array()
    {
        $this->contact_id = $this->get_field_map()[0];
        $this->field = $this->get_field_map()[1];
        $this->new_val = $this->get_field_map()[2];
        if($this->get_field() == "state")
        {
            $this->new_val_2 = $this->get_field_map()[3];
        }
    }
    public function civi_query()
    {
        $civi = new query_base();
        $civi->mode = "update";
        $this->entity_switch($civi);

    }
    public function entity_switch(query_base &$civi)
    {
        switch ($this->get_field())
        {
            case "name":
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
            case "deaf":
                $civi->entity = "Contact";
            case "disability":
                $civi->entity = "Contact";
            case "media":
                $civi->entity = "Contact";
        }
    }
    public function params_array(query_base &$civi)
    {

    }


}