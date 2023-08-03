<?php
Namespace Drupal\nfb_user_portal\html_builder;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;
use Drupal\nfb_user_portal\user\user_other;
class fq_markup_builder extends  other_markup
{
    public $faq_markup;
    public function get_faq_markup()
    {
        return $this->faq_markup;
    }
    public $faq_result;
    public function faq_result()
    {
        return $this->faq_result;
    }
    public function build_faq_markup()
    {
        $markup = "";
        $this->faq_query();
        $faqs = $this->build_array();
        if(is_array($faqs))
        {
            sort($faqs);
            foreach($faqs as $faq){
            $this->build_markup($faqs, $markup);}
        }
        else{
            $markup = "<p>No Faqs entered </p>";
        }
        return $markup;
    }
    public function faq_query()
    {
        $key = "cid";
        $query = "select * from nfb_user_portal_content where markup_type = 'faq' and tab = 'faq' and active = '0';";
        $sql = new User_request_queries();
        $sql->select_query($query, $key);
        $this->faq_result = $sql->get_result();
        \Drupal::logger("sigh")->notice("array: ".print_r($this->get_benifit_array(), true));
    }
    public function build_array()
    {
        $faqs = false;
        foreach($this->get_faq_markup() as $content)
        {
            $content =  get_object_vars($content);
            $array = json_decode($content['markup']);
            $array = get_object_vars($array);
            $faqs[$array['weight']] = [
                'question' => $array['title'],
                'text' => $array['text'],
            ];
        }
        return $faqs;
    }
    public function build_markup($faq, &$markup)
    {
        $markup = $markup. "<h3 tabindex='0'>".$faq['question']."</h3>
<p tabindex='0'>".$faq['text']."</p>";
    }
}