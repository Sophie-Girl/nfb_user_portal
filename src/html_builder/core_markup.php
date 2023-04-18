<?php
Namespace Drupal\nfb_user_portal\html_builder;
use Drupal\nfb_user_portal\civi_query\query_base;
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
                    <form>
                    <p id='f_name'>First Name: ".$this->user_data->get_first_name()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit first Name' id='edit_f_name'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite'  id='first_name_edit_div' class='hidden_val'><input id='f_name_new_val' class= 'feild_custom_text'aria-label='enter new first name'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_f_name'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_f_name'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='l_name'>Last Name: ".$this->user_data->get_last_name()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Last Name' id='edit_l_name'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite'  id='last_name_edit_div' class='hidden_val'><input id='l_name_new_val' class= 'feild_custom_text' aria-label='enter new last name'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_l_name'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_l_name'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='prime_email'>Email: ".$this->user_data->get_prime_email()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Email' id='edit_prim_email'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite'  id='prim_email_edit_div' class='hidden_val'><input id='prim_email_new_val' class= 'feild_custom_text' aria-label='enter new primary email'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_email'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_email'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='prime_phone'>Phone: ".$this->user_data->get_prime_phone()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Phone' id='edit_prim_phone'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='prim_phone_edit_div' class='hidden_val'><input id='prim_phone_new_val' class= 'feild_custom_text' aria-label='enter new primary phone'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_phone'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_phone'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='prime_street'>Street Address: ".$this->user_data->get_prime_street()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Street Address' id='edit_prim_street'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='prim_street_edit_div' class='hidden_val'><input id='prim_street_new_val' class= 'feild_custom_text' aria-label='enter new primary street address'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_street'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_street'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                      <p id='prime_address_2'>Address Line 2: ".$this->user_data->get_prime_line_2()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Address Line 2' id='edit_prim_address_2'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='prim_address_2_edit_div' class='hidden_val'><input id='prim_address_2_new_val' class= 'feild_custom_text' aria-label='enter new primary address line 2'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_address_2'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_address_2'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='prime_city'>City: ".$this->user_data->get_prime_city()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary City' id='edit_prim_city'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='prim_city_edit_div' class='hidden_val'><input id='prim_city_new_val' class= 'feild_custom_text' aria-label='enter new primary City'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_city'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_city'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='prime_st_ct'>State and Country: ".$this->user_data->get_prime_state().", ".$this->user_data->get_prime_country()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary State and Country' id='edit_prim_state'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='prim_state_edit_div' class='hidden_val'><label for='prim_country_new_val' id='prim_country_new_val_lab' >Country:</label><select id='prim_country_new_val' class='feild_custom_select' aria-label='enter new primary country'>".$this->country_options()."</select>
                    <label id='prim_state_new_val_lab' for='prim_state_new_val'></label><select id='prim_state_new_val' class='feild_custom_select' aria-label='enter new primary state'>".$this->state_options()."</select>
                    <a role='button' id='cancel_prim_state'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_state'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='prime_zip'>Zip/Postal Code: ".$this->user_data->get_prime_zip()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Zip' id='edit_prim_zip'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='prim_zip_edit_div' class='hidden_val'><input id='prim_zip_new_val' class= 'feild_custom_text' aria-label='enter new primary zip code'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_zip'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_prim_zip'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    </form>
                    <h2>Your Demographics</h2>
                    <form>
                    <p id='prime_lnag_pref'>Your Prefered Langaunge: ".$this->user_data->get_preferred_language()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Your Preffered Langauge' id='edit_lang_pref'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='lang_pref_edit_div' class='hidden_val'><label for='lang_pref_new_val' id='lang_pref_new_val_lab'>Country:</label><select id='lang_pref_new_val' class='feild_custom_select' aria-label='enter new language prefference'>".$this->language_options()."</select>
                    <a role='button' id='cancel_lang_pref'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_lang_pref'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='gender_info'>Gender: ".$this->user_data->get_gender()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Your Gender' id='edit_gender'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='gender_edit_div' class='hidden_val'><label for='gender_new_val' id='gender_new_val_lab'>Gender:</label><select id='gender_new_val' class='feild_custom_select' aria-label='enter new gender'>".$this->gender_options()."</select>
                    <a role='button' id='cancel_gender'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_gender'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='pronouns'>Pronouns: ".$this->user_data->get_pronouns()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Pronouns' id='edit_pronouns'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='pronouns_edit_div' class='hidden_val'><input id='pronouns_new_val' class= 'feild_custom_text' aria-label='enter new pronouns'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_pronouns'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_pronouns'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='dob'>Date of Birth: ".$this->user_data->get_dob()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Date of Birth' id='edit_dob'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='dob_edit_div' class='hidden_val'><input id='dob_new_val' type='date' class= 'feild_custom_date' aria-label='enter new date of birth'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_dob'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_dob'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='blind_info'>Blindness Status: ".$this->user_data->get_is_blimd()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Change your blindness status' id='edit_blind'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='blind_edit_div' class='hidden_val'><label for='blind_new_val' id='blind_new_val_lab'>Blind?</label><select id='blind_new_val' class='feild_custom_select' aria-label='Change Blindness status'>".$this->yes_no()."</select>
                    <a role='button' id='cancel_blind'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_blind'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='deaf_info'>Deaf Blind Status: ".$this->user_data->get_deaf()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Change your deaf blind status' id='edit_deaf'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='deaf_edit_div' class='hidden_val'><label for='deaf_new_val'id='deaf_new_val_lab'>Deaf Blind?</label><select id='deaf_new_val' class='feild_custom_select' aria-label='Change Deafness status'>".$this->yes_no()."</select>
                    <a role='button' id='cancel_deaf'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_deaf'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='disability'>Other Disability: ".$this->user_data->get_disability()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Disability' id='edit_disability'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='disability_edit_div' class='hidden_val'><input id='disability_new_val' class= 'feild_custom_text' aria-label='enter new disability information'></input>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_disability'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_disability'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    <p id='meddia_preference_info'>Media Preference: ".$this->user_data->get_media_type()." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Change your Media Preference' id='edit_media_pref'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form' aria-live='polite' id='media_type_edit_div' class='hidden_val'><label for='nedia_type_new_val' id='media_type_new_val_lab'>Deaf Blind?</label><select id='media_type_new_val' class='feild_custom_select' aria-label='Change Meida Type status'>".$this->media_options()."</select>
                    <a role='button' id='cancel_media_type'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='save_media_type'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a></div>
                    </form>";
        $this->core_markup = $markup;

    }
    public function state_options()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "StateProvince";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['country_id', '=', 1228],
            ],
            'limit' => 65,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        $current = 1;
        $options = "<option value=''> &nbsp;&nbsp;&nbsp;-&nbsp;Select&nbsp;-&nbsp;&nbsp;&nbsp;</option>";
        while ($current <=  $count)
        {
            $state = $result->itemat($current);
            $options = $options."<option value='".$state['id']."'>&nbsp;&nbsp;&nbsp;".$state['name']."&nbsp;&nbsp;&nbsp;</option>";
            $current++;
        }
        return $options;
    }
    public function country_options()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "Country";
        $civi->params = [
            'select' => [
                '*',
            ],
            'limit' => 300,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        $current = 1;
        $options = "<option >&nbsp;&nbsp;&nbsp;-&nbsp;Select&nbsp;-&nbsp;&nbsp;&nbsp;</option>
                    <option value='1228'>&nbsp;&nbsp;&nbsp;United States&nbsp;&nbsp;&nbsp;</option>";
        while ($current <= $count) {
            $state = $result->itemat($current);
            if ($state['id'] != "1228"){
        $options = $options . "<option value='" . $state['id'] . "'>&nbsp;&nbsp;&nbsp;" . $state['name'] . "&nbsp;&nbsp;&nbsp;</option>";
    }
        $current++;
        }
        return $options;
    }
    public function gender_options()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "OptionValue";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['option_group_id', '=', 3],
            ],
            'limit' => 25,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        $current = 1;
        $options = "<option >&nbsp;&nbsp;&nbsp;-&nbsp;Select&nbsp;-&nbsp;&nbsp;&nbsp;</option>";
        while ($current <= $count) {
            $gender = $result->itemat($current);
            if($gender['id'] != "") {
                $options = $options . "<option value='" . $gender['id'] . "'>&nbsp;&nbsp;&nbsp;" . $gender['name'] . "&nbsp;&nbsp;&nbsp;</option>";
            }
            $current++;
        }
        return $options;
    }
    public function language_options()
    {
        $civi = new query_base();
        $civi->mode = "get";
        $civi->entity = "OptionValue";
        $civi->params = [
            'select' => [
                '*',
            ],
            'where' => [
                ['option_group_id:name', '=', 'languages'],
            ],
            'limit' => 500,
            'checkPermissions' => FALSE,
        ];
        $civi->civi_api_v4_query();
        $result = $civi->get_civi_result();
        $count = $result->count();
        $current = 1;
        $options = "<option >&nbsp;&nbsp;&nbsp;-&nbsp;Select&nbsp;-&nbsp;&nbsp;&nbsp;</option>";
        while ($current <= $count) {
            $gender = $result->itemat($current);
            if($gender['id'] != "") {
                $options = $options . "<option value='" . $gender['id'] . "'>&nbsp;&nbsp;&nbsp;" . $gender['label'] . "&nbsp;&nbsp;&nbsp;</option>";
            }
            $current++;
        }
        return $options;
    }
    public function yes_no()
    {
        $options = "<option value=''>&nbsp;&nbsp;&nbsp;-&nbsp;Select&nbsp;-&nbsp;&nbsp;&nbsp;</option>
<option value='1'>&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;</option>
<option value='0'>&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;</option>
";
        return $options;
    }
    public function media_options()
    {
        $options = "<option value=''>&nbsp;&nbsp;&nbsp;-&nbsp;Select&nbsp;-&nbsp;&nbsp;&nbsp;</option>
<option value='Print'>&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;</option>
<option value='Braille'>&nbsp;&nbsp;&nbsp;Braille&nbsp;&nbsp;&nbsp;</option>
<option value='Large Print'>&nbsp;&nbsp;&nbsp;Large Print&nbsp;&nbsp;&nbsp;</option>
<option value='E-Mail'>&nbsp;&nbsp;&nbsp;E-mail&nbsp;&nbsp;&nbsp;</option>
<option value='USB-drive'>&nbsp;&nbsp;&nbsp;USB-Drive&nbsp;&nbsp;&nbsp;</option>
";
        return $options;
    }


}