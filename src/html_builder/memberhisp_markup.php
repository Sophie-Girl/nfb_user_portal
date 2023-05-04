<?php
Namespace Drupal\nfb_user_portal\html_builder;
use Drupal\nfb_user_portal\civi_query\query_base;
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
    public function build_membership_markup()
    {
        $this->user_data = new user_membership();
        \Drupal::logger("interesting")->notice("500 happens at start of injection");
        $this->user_data->set_up_member_page_data();
        \Drupal::logger("interesting")->notice("500 happens at data import");
        $this->membership_markup();
        \Drupal::logger("interesting")->notice("500 happens at markup_maker");
        $this->subscription_loop();
        \Drupal::logger("interesting")->notice("500 happens at subscription");
        return  $this->get_markup();
    }
    public function membership_markup()
    {
        $markup = "<h2 tabindex='0'>Member Status</h2>";
        foreach ($this->user_data->get_membership_array() as $membership)
        {
            if($membership[1] != "7" && $membership[1] != "6"
            && $membership[1] != "4" && $membership[1] != "5"
            && $membership[1] != "10" && $membership[1] != "11")
            {
                $markup = $markup."<p tabindex='0'>".$membership[0].": &nbsp;<span class='right'>".$membership[3]."</span></p>";
            }
        }
        $this->markup = $markup."<p>Info text goes here</p>";
    }
    public function subscription_loop()
    {
        $markup = "<h2 tabindex='0'>Subscription</h2>";
        foreach ($this->user_data->get_membership_array() as $membership)
        {
            if($membership[1] == "7" || $membership[1] == "6" )
            {
                $membership_id = $membership[6];
                $type = $membership[1];
                $markup = $markup."<p tabindex='0' class='right-side'>".$membership[0].": &nbsp;<span>".$this->user_data->find_media_type($membership_id, $type)."</span></p>";
            }
        }
        $this->markup = $this->get_markup().$markup;
    }
}