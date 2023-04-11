<?php
Namespace Drupal\nfb_user_portal\html_builder;
use Drupal\nfb_user_portal\user\user_civi;
class core_markup
{
    public $user_data; // user civi class object
    public $core_markup; //string
    public function __construct()
    {
        $this->user_data = new user_civi();
    }
    public function get_core_markup()
    {
        return $this->core_markup;
    }
    public function create_core_markup()
    {
        $this->user_data->civi_contact_set(); //set all data
        $this->header_2();
        return $this->get_core_markup();
    }
    public function header_2(){
        $markup = "
<p>Intro text goes here.</p>
<p class='hidden_val' id='user_id_val'>".\Drupal::currentUser()->getAccount()->id()."</p>
<p class='hidden_val' id = 'civi_id_val'>".$this->user_data->get_user_civi_id()."</p>
<p class='hidden_val' id = 'user_name_val'>".\Drupal::currentUser()->getAccountName()."</p>
<p class='hidden_val' id='edit_open'>Not Open</p>
                   <p class='hidden_val' id='open_field'>None</p>
                    <p class='hidden_val' id='member_name'>".$this->user_data->get_first_name()." ".$this->user_data->get_last_name()."</p>
                    <h2>Your Contact Information</h2>
                    <p id='f_name'>First Name: ".$this->user_data->get_first_name()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit first Name' id='edit_f_name'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div id='first_name_edit_div' class='hidden_val'><input id='f_name_new_val' class= 'feild_custom_text'aria-label='enter new first name'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_f_name'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_f_name'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='l_name'>Last Name: ".$this->user_data->get_last_name()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Last Name' id='edit_l_name'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div id='last_name_edit_div' class='hidden_val'><input id='l_name_new_val' class= 'feild_custom_text' aria-label='enter new last name'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_l_name'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_l_name'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='prime_email'>Email: ".$this->user_data->get_prime_email()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Email' id='edit_prim_email'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div id='prim_email_edit_div' class='hidden_val'><input id='prim_email_new_val' class= 'feild_custom_text' aria-label='enter new primary email'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_email'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_email'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='prime_phone'>Phone: ".$this->user_data->get_prime_phone()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Phone' id='edit_prim_phone'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div id='prim_phone_edit_div' class='hidden_val'><input id='prim_phone_new_val' class= 'feild_custom_text' aria-label='enter new primary phone'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_phone'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_phone'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    ";
        $this->core_markup = $markup;

    }


}
