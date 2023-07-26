<?php
Namespace Drupal\nfb_user_portal\html_builder;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\SQL\admin\User_request_queries;
use Drupal\nfb_user_portal\user\user_membership;
class memberhisp_markup
{
    public $user_data;
    public $markup;
    public function get_user_data()
    {
        return $this->user_data;
    }
    public function get_markup()
    {
        return $this->markup;
    }
    public $beneift_array;
    public function get_benifit_array()
    {
        return $this->beneift_array;
    }
    public $base_benefit;
    public function get_base_benefit()
    {
        return $this->base_benefit;
    }
    public $additional_benefit;
    public function get_additional_benefit()
    {
        return $this->additional_benefit;
    }
    public function build_membership_markup()
    {
        $this->user_data = new user_membership();
        $this->user_data->set_up_member_page_data();
        $this->membership_markup();
        $this->subscription_loop();
        return  $this->get_markup();
    }
    public function membership_markup()
    {
        $markup = "<h2 tabindex='0'>Member Status</h2>";

        foreach ($this->user_data->get_membership_array() as $membership) {
            if ($membership[1] != "7" && $membership[1] != "6"
                && $membership[1] != "4" && $membership[1] != "5"
                && $membership[1] != "10" && $membership[1] != "11") {
                if ($membership[0] != "") {
                    $markup = $markup . "<p tabindex='0'>" . $membership[0] . ": &nbsp;<span class='right'>" . $membership[3] . "</span></p>";
                }
            }


        }
        $markup = $markup . $this->get_content_memberhsip_text();
        $this->markup = $markup;
    }
    public function subscription_loop()
    {
        $markup = "<h2 tabindex='0'>Subscription Status</h2>"
        ."<p class='hidden_val' id='member_name'>".$this->user_data->get_first_name()." ".$this->user_data->get_last_name()."</p>";
        foreach ($this->user_data->get_membership_array() as $membership)
        {
            if($membership[1] == "7" || $membership[1] == "6" )
            {
                $membership_id = $membership[6];
                $type = $membership[1];
                $markup = $markup."<p tabindex='0' class='right-side'><i>".$membership[0]."</i>: &nbsp;<span>".$this->user_data->find_media_type($membership_id, $type)."</span></p>";
            }
        }
        $markup = $markup.$this->get_conent_subscription_text();
        $this->markup = $this->get_markup().$markup;
    }
    public function get_intro_text()
    {
        $key = "cid";
        $query = "select * from nfb_user_portal_content where markup_type = 'intro_text' and tab = 'membership' and active = '0';";
        $type = "intro";
        $makrup = $this->query_for_markups($query, $key, $type);
        return $makrup;
    }
    public function get_content_memberhsip_text(){
        $key = "cid";
        $query = "select * from nfb_user_portal_content where markup_type = 'content_text' and tab = 'membership' and active = '0';";
        $type = "content_1";
        $makrup = $this->query_for_markups($query, $key, $type);
        return $makrup;
    }
    public function get_conent_subscription_text()
    {
        $key = "cid";
        $query = "select * from nfb_user_portal_content where markup_type = 'content_text' and tab = 'membership' and active = '0';";
        $type = "content_1";
        $makrup = $this->query_for_markups($query, $key, $type);
        return $makrup;
    }
    public function query_for_markups($query, $key, $type)
    {

        $sql = new User_request_queries();
        $sql->select_query($query, $key);
        $markup = false;
        foreach ($sql->get_result() as $cotnent)
        {
            $content = get_object_vars($cotnent);
            $array = json_decode($markup['markup']);
            $array = get_object_vars($array);
            if($markup == false)
            {
                if($type == "content_1")
                {
                    if($array['weight'] == '1')
                    {
                        $markup = $array['text'];
                    }

                }
                elseif($type == "content_2")
                {
                    if($array['weight'] == '2')
                    {
                        $markup = $array['text'];
                    }
                }
                else {
                    $markup = $array['text'];
                }}
        }
        if($markup == false)
        {
           if($type == "intro")
           {
               $markup = $this->default_intro_text();
           }
           elseif($type == "content_1")
           {
               $markup = $this->defualt_content_1_text();
           }
           else{
               $markup = $this->default_content_2_text();
           }
        }
        return $markup;
    }
    public function default_intro_text()
    {
        return "";
    }
    public function defualt_content_1_text()
    {
        return "<p tabindex='0'>In order to keep your membership status current, you must pay dues to your chapter or affiliate every January. If you are a member of a national division, you will need to pay dues separate from your chapter/affiliate dues to maintain a current membership with the division as well. Contact the treasurer of your chapter, affiliate, and or division for payment options. If you find discrepancies in membership information, contact the designated membership coordinator.</p>";
    }
    public function default_content_2_text()
    {
        return "<p tabindex='0'>If you need to update your subscription information for the <i>Braille Monitor</i> or <i>Future Reflections</i>, please contact XXXX. Based on the distribution schedule, it may take up to two months for your change to take effect.    </p>";
    }
    public function member_benefits_section()
    {
        $markup = "<h2>Membership Benefits</h2>";
        $this->member_benifit_query();


    }
    public function member_benifit_query()
    {
        $key = "cid";
        $query = "select * from nfb_user_portal_content where markup_type = 'member_benefit' and tab = 'membership' and active = '0';";
        $sql = new User_request_queries();
        $sql->select_query($query, $key);
        $this->beneift_array = $sql->get_result();
    }
    public function process_array()
    {
        $alternative_benefit = false;
        $base_benefit = false;
        foreach ($this->get_benifit_array() as $content)
        {
            $content = get_object_vars($content);
            $array = json_decode($content['markup']);
            $array = get_object_vars($array);
            if($markup['group'] == "base")
            {
                $base_benefit[$markup['weight']] = array(
                  'text' => $markup['text'],
                  'start_date' =>  $content['beginning_date'],
                  'end_date' => $content['end_date'],
                    'limiter' => $content['limiter'],
                    'civi_entity' => $content['civi_entity'],
                    'cid' => $content['cid'],
                );
            }
            elseif($markup['group'] == "additional")
            {
                $alternative_benefit[$markup['weight']] = array(
                    'text' => $markup['text'],
                    'start_date' =>  $content['beginning_date'],
                    'end_date' => $content['end_date'],
                    'limiter' => $content['limiter'],
                    'civi_entity' => $content['civi_entity'],
                    'cid' => $content['cid'],
                );
            }
        }
        $this->base_benefit = $base_benefit;
        $this->additional_benefit = $alternative_benefit;
    }
    public function process_benefit($benefit)
    {

    }
}