<?php
Namespace Drupal\nfb_user_portal\html_builder;
use Drupal\nfb_user_portal\civi_query\query_base;
use Drupal\nfb_user_portal\user\user_other;
class other_markup {
    public $user_data;
    public function __construct()
    {
        $this->user_data = new user_other();
    }
    public $markup;
    public function get_markup()
    {
        return $this->markup;
    }
    public function create_other_markup()
    {
        $this->user_data->other_page_markup(); // set data
        $this->build_event_markup(); // build event
        $this->past_donations_markup(); // build donations
        return $this->get_markup(); // render
    }
    public function build_event_markup()
    {
        $markup = "<h2 tabindex='0'>Your Events:</h2>
<p class='hidden_val' id='member_name'>".$this->user_data->get_first_name()." ".$this->user_data->get_last_name()."</p>
    <p tabindex='0'>Intro Text Goes here</p>";
        foreach ($this->user_data->get_event_array() as $event)
        {
            $markup = $markup. "<p tabindex='0' class='right_side'>".$event['title']."<span>".$event['start_date']." - ".$event['end_date']."</span></p>";
        }
        $this->markup = $markup;
    }
    public function past_donations_markup()
    {
        $markup = $this->get_markup()."<h2 tabindex='0'>Your Past Contributions:</h2>
<p tabindex='0'>Intro Text Goes Here</p>";
        foreach ($this->user_data->get_contribution_array() as $contribution)
        {
            $markup = $markup."<p tabindex='0' class='right_side'>Donation on:".$contribution['date']."<span>".$contribution['amount']."</span></p>";
        }
        $this->markup = $markup;
    }

}