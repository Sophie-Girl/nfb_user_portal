<?php
Namespace Drupal\nfb_user_portal\Controller;
use \Drupal\Core\Controller\ControllerBase;
use Drupal\nfb_user_portal\civi_query\query_base;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StateSelectorAjaxController extends ControllerBase
{
    public $data;
    public $country_id;
    public function get_data()
    {
        return $this->data;
    }
    public function get_country_id()
    {
        return $this->country_id;
    }
    public function content()
    {
        $this->set_country();
        $this->query_for_country_id();
        return new JsonResponse($this->get_data());
    }
    public function set_country()
    {
        $request = Request::createFromGlobals();
        $this->country_id = $request->request->get('country');
        \Drupal::logger("ajax_test")->notice("country ".$this->get_country_id());

    }
    public function query_for_country_id()
    {
        $civi = new query_base();
        $civi->entity = "StateProvince";
        $civi->mode = "get";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['country_id', '=', $this->get_country_id()],
            ],
            'limit' => 100,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query();
        \Drupal::logger("ajax_test")->notice("getting here");
        $result = $civi->get_civi_result();
        $count = $result->count();
        $current = 0;
        $options = "<option value=''>&nbsp;&nbsp;&nbsp;-&nbsp;Select&nbsp;-&nbsp;&nbsp;&nbsp;</option>";
        if($count != 0) {
            while ($count >= $current) {
                $state = $result->itemat($current);
                if ($state['id'] != "") {
                    $options = $options . "<option value='" . $state['id'] . "'> &nbsp;" . $state['name'] . " </option>";
                }
                $current++;
            }
        }
        \Drupal::logger("ajax_test")->notice("Options ".$options);
        $this->data = $options;
    }

}