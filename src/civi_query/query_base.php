<?php
namespace Drupal\nfb_user_portal\civi_query;
use Drupal\civicrm\Civicrm;
class query_base
{
    public $civi;
    public $entity;
    public $mode;
    public $params;
    public $result;
    public function __construct()
    {
        $this->civi = new Civicrm();
        $this->civi->initialize();
    }
    public function get_entity()
    {
        return $this->entity;
    }
    public function get_mode()
    {
        return $this->mode;
    }
    public function get_params()
    {
        return $this->params;
    }
    public function get_civi_result()
    {
        return $this->result;
    }
    public function civi_api_v4_query()
    {
        $this->result = civicrm_api4($this->get_entity(), $this->get_mode(),$this->get_params());
    }
    public function civi_api_v3_query()
    {
        $this->result = civicrm_api3($this->get_entity(), $this->get_mode(),$this->get_params());
    }
}
