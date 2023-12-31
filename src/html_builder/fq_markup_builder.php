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
    public function get_faq_result()
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
            ksort($faqs);
            foreach($faqs as $faq){
            $this->build_markup($faq, $markup);}
        }
        else{
            $markup = "<p>No Faqs entered </p>";
        }
        return $markup;
    }
    public function look_for_faq_intro_text()
    {
        $key = "cid";
        $query = "select * from nfb_user_portal_content where markup_type = 'intro_text' and tab = 'faq' and active = '0';";
        $sql = new User_request_queries();
        $sql->select_query($query, $key);
        $markup = false;
        foreach ($sql->get_result() as $cotnent)
        {
            $content = get_object_vars($cotnent);
            $array = json_decode($content['markup']);
            $array = get_object_vars($array);
            if($markup == false)
            {
                $markup = $array['text'];
            }
        }
        if($markup == false)
        {
            $markup = "";
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
    }
    public function build_array()
    {
        $faqs = false;
        foreach($this->get_faq_result() as $content)
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