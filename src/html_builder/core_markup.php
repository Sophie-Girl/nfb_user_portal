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
<p tabindex='0' class='lead'>Welcome to your National Federation of the Blind member profile. Achieving our shared goals of equality, opportunity, and security for the blind are impossible without you as member.
 In your account, maintain your personal information and review membership status. The member profile is under construction and expanding; you’ll find several tabs to different areas of the member profile. 
 Review information in your profile, membership, FAQs, and more. Thank you for your active participation in the organized blind movement.
<br> <br>
To update your contact or demographic information, navigate to the appropriate field and select Edit. Enter the correct information (or select it from the menu) and select Save. Once you select Edit, you must Cancel or Save before editing another field.</p>
<p class='hidden_val' tabindex='0' id='user_id_val'>".\Drupal::currentUser()->getAccount()->id()."</p>
<p class='hidden_val' tabindex='0' id = 'civi_id_val'>".$this->user_data->get_user_civi_id()."</p>
<p class='hidden_val' tabindex='0' id = 'user_name_val'>".\Drupal::currentUser()->getAccountName()."</p>
<p class='hidden_val' tabindex='0' id='edit_open'>Not Open</p>
                   <p tabindex='0' class='hidden_val' id='open_field'>None</p>
                    <p tabindex='0' class='hidden_val' id='member_name'>".$this->user_data->get_first_name()." ".$this->user_data->get_last_name()."</p>
                    <h2 tabindex='0' >Your Contact Information</h2>
                    <p tabindex='0' id='f_name' style='display: inline'><span id='first_name_repalce'>First Name: ".$this->user_data->get_first_name()."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit first Name' style='display: inline' id='edit_f_name' class='btn btn-primary btn-sm' tabindex='0'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div  role='form'  id='first_name_edit_div'  class='hidden_val'><input  tabindex='0' id='f_name_new_val' class= 'form-control'aria-label='enter new first name'></input><br><a  tabindex='0' role='button' id='save_f_name' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_f_name' tabindex='0' class='btn btn-default btn-sm'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                    <br><p id='l_name' tabindex='0'><span id='last_name_repalce'>Last Name: ".$this->user_data->get_last_name()." </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a tabindex='0' role='button' aria-label='Edit Last Name' class='btn btn-primary btn-sm' id='edit_l_name'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'   id='last_name_edit_div' class='hidden_val' ><input tabindex='0'  id='l_name_new_val' class= 'form-control' aria-label='enter new last name'></input><br>&nbsp;&nbsp;&nbsp;<a tabindex='0'  role='button' id='save_l_name' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a tabindex='0'  role='button' id='cancel_l_name' class='btn btn-default btn-sm'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                    <br><p tabindex='0' id='prime_email'><span id='email_repalce'>Email: ".$this->user_data->get_prime_email()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a tabindex='0' role='button' aria-label='Edit Primary Email' class='btn btn-primary btn-sm' id='edit_prim_email'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'   id='prim_email_edit_div' class='hidden_val'><input tabindex='0'  id='prim_email_new_val' class= 'form-control' aria-label='enter new primary email'></input><br>&nbsp;&nbsp;&nbsp;<a tabindex='0' role='button' id='save_prim_email' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0'  id='cancel_prim_email' class='btn btn-default btn-sm'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                    <br><p tabindex='0' id='prime_phone'><span id='phone_replace'>Phone: ".$this->user_data->get_prime_phone()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  tabindex='0' role='button' aria-label='Edit Primary Phone' class='btn btn-primary btn-sm' id='edit_prim_phone'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='prim_phone_edit_div' class='hidden_val'><input tabindex='0' id='prim_phone_new_val' class= 'form-control' aria-label='enter new primary phone'></input><br>&nbsp;&nbsp;&nbsp;<a tabindex='0'  role='button' id='save_prim_phone' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a> &nbsp;&nbsp;&nbsp;<a role='button'  tabindex='0' id='cancel_prim_phone' class='btn btn-default btn-sm'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                    <br><p tabindex='0' id='prime_street'><span id='street_replace'>Street Address Line 1: ".$this->user_data->get_prime_street()." </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  tabindex='0' role='button' aria-label='Edit Primary Street Address' class='btn btn-primary btn-sm' id='edit_prim_street'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <p tabindex='0' id='prime_address_2'><span id='line_2_replace'>Street Address Line 2: ".$this->user_data->get_prime_line_2()."</span></p>
                    <p tabindex='0' id='prime_city'><span id='city_replace'>City: ".$this->user_data->get_prime_city()."</span><span id='state_repalce'> State, Country: ".$this->user_data->get_prime_state().", ".$this->user_data->get_prime_country()." </span>&nbsp;<span id='postal_repalce'>".$this->user_data->get_prime_zip()."</span></p>
                    <div role='form'  id='prim_street_edit_div' class='hidden_val'><label for='prim_street_new_val' id='prim_street_new_val_lab' tabindex='0'>Street Address:</label><input tabindex='0' id='prim_street_new_val' class= 'form-control' aria-label='enter new primary street address'></input><br>&nbsp;&nbsp;&nbsp;<a tabindex='0' role='button' id='save_prim_street' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_prim_street' class='btn btn-default btn-sm' tabindex='0'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                    <div role='form'  id='prim_address_2_edit_div' class='hidden_val'><label for='prim_address_2_new_val' id='prim_address_2_new_val_lab' tabindex='0'>Street Address Line 2:</label><input tabindex='0' id='prim_address_2_new_val' class= 'form-control' aria-label='enter new primary address line 2'></input><br>&nbsp;&nbsp;&nbsp;</div>
                    <div role='form'  id='prim_city_edit_div' class='hidden_val'><label for='prim_city_new_val' id='prim_city_new_val_lab' tabindex='0'>City:</label><input id='prim_city_new_val'  tabindex='0'  class= 'form-control' aria-label='enter new primary City'></input><br></div>
                    <div role='form'  id='prim_state_edit_div' class='hidden_val' ><label for='prim_country_new_val'  tabindex='0'  id='prim_country_new_val_lab' >Country:</label><select id='prim_country_new_val' class='form-control' tabindex='0' aria-label='enter new primary country'>".$this->country_options()."</select>
                    <label id='prim_state_new_val_lab' for='prim_state_new_val'></label><select id='prim_state_new_val' class='form-control' aria-label='enter new primary state' tabindex='0'>".$this->state_options()."</select></div>
                    <div role='form'  id='prim_zip_edit_div' class='hidden_val'><label for='prim_zip_new_val' id='prim_zip_new_val_lab' tabindex='0'>Zip/Postal Code:</label><input tabindex='0' id='prim_zip_new_val' class= 'form-control' aria-label='enter new primary zip code'></input><br>&nbsp;&nbsp;&nbsp;<a tabindex='0' role='button' id='save_prim_zip' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a  tabindex='0' role='button' id='cancel_prim_zip' class='btn btn-default btn-sm'  >&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                    <h2  tabindex='0'>Your Demographics</h2>
                   <br> <p  tabindex='0' id='prime_lnag_pref'><span id='lang_repalce'>Preferred Language: ".$this->user_data->get_preferred_language()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Your Preffered Langauge' id='edit_lang_pref' class='btn btn-primary btn-sm' tabindex='0'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='lang_pref_edit_div' class='hidden_val'><label  tabindex='0' for='lang_pref_new_val' id='lang_pref_new_val_lab'>Preferred Language:</label><select id='lang_pref_new_val' class='form-control' aria-label='enter new language prefference'  tabindex='0'>".$this->language_options()."</select>
                    <br><a role='button' class='btn btn-primary btn-sm'  tabindex='0' id='save_lang_pref'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_lang_pref' class='btn btn-default btn-sm'    tabindex='0'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                   <br> <p id='gender_info'  tabindex='0'><span id='gender_change' >Gender: ".$this->user_data->get_gender()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button'   tabindex='0' aria-label='Edit Your Gender' id='edit_gender' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='gender_edit_div' class='hidden_val'><label  for='gender_new_val'  tabindex='0' id='gender_new_val_lab'>Gender:</label><select  tabindex='0' id='gender_new_val' class='form-control' aria-label='enter new gender'>".$this->gender_options()."</select>
                    <br><a role='button'  class='btn btn-primary btn-sm' id='save_gender' tabindex='0'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a tabindex='0' role='button' id='cancel_gender' class='btn btn-default btn-sm'   tabindex='0'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                   <br> <p id='pronouns' tabindex='0'><span id ='pronouns_replace'>Pronouns: ".$this->user_data->get_pronouns()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Pronouns' id='edit_pronouns' tabindex='0' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                     <div role='form'   id='pronouns_edit_div' class='hidden_val'><input tabindex='0'  id='pronouns_new_val' class= 'form-control' aria-label='enter new pronouns'></input><br>&nbsp;&nbsp;&nbsp;<a tabindex='0' role='button' id='save_pronouns' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' class='btn btn-default btn-sm'   id='cancel_pronouns'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                   <br> <p id='dob' tabindex='0'><span id='dob_replace'>Date of Birth: ".$this->user_data->get_dob()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Date of Birth' id='edit_dob' tabindex='0' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='dob_edit_div' class='hidden_val'><input id='dob_new_val' type='date' class= 'form-control' aria-label='enter new date of birth' tabindex='0' ></input><br>&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' id='save_dob' tabindex='0' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0'  id='cancel_dob' class='btn btn-default btn-sm'   tabindex='0'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                   <br> <p id='blind_info' tabindex='0'><span id='blind_replace'>Blindness Status: ".$this->user_data->get_is_blimd()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' aria-label='Change your blindness status' id='edit_blind' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='blind_edit_div' class='hidden_val'><label for='blind_new_val' tabindex='0' id='blind_new_val_lab'>Blind?</label><select id='blind_new_val' tabindex='0' class='form-control' aria-label='Change Blindness status'>".$this->yes_no()."</select>
                    <br><a role='button' id='save_blind' class='btn btn-primary btn-sm' tabindex='0'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_blind' tabindex='0' class='btn btn-default btn-sm'  >&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                  <br>  <p id='braille_info' tabindex='0'><span id='braille_replace'>Braille Reader? ".$this->user_data->get_braille_reader()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Change your Braille Reader status' tabindex='0' id='edit_braille' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='braille_edit_div' class='hidden_val'><label for='braille_new_val' id='braille_new_val_lab' tabindex='0'>Braille Reader?</label><select id='braille_new_val' tabindex='0' class='form-control' aria-label='Change Braille Reader status'>".$this->yes_no()."</select>
                    <br><a role='button' class='btn btn-primary btn-sm' tabindex='0' id='save_braille' class='btn btn-primary btn-sm' >&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' class='btn btn-default btn-sm'   id='cancel_braille' tabindex='0'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                   <br> <p id='dog_info' tabindex='0'><span id='dog_replace'>Guide Dog Handler? ".$this->user_data->get_dog_user()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Change your guide dog handler status' tabindex='0' id='edit_dog' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'   id='dog_edit_div' class='hidden_val'><label for='dog_new_val' id='dog_new_val_lab' tabindex='0'>Guide Dog Handler?</label><select tabindex='0' id='dog_new_val' tabindex='0' class='form-control' aria-label='Change guide dog handler status'>".$this->yes_no()."</select>
                    <br><a role='button' class='btn btn-primary btn-sm' id='save_dog' tabindex='0'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' id='cancel_dog' class='btn btn-default btn-sm'  >&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                   <br> <p id='deaf_info' tabindex='0'><span id='deaf_replace'>Deafblind Status: ".$this->user_data->get_deaf()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' aria-label='Change your deaf blind status' id='edit_deaf' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='deaf_edit_div' class='hidden_val'><label for='deaf_new_val'id='deaf_new_val_lab'>Deaf Blind?</label><select id='deaf_new_val' tabindex='0'class='form-control' aria-label='Change Deafness status'>".$this->yes_no()."</select>
                    <br><a role='button' class='btn btn-primary btn-sm' tabindex='0' id='save_deaf'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' id='cancel_deaf' tabindex='0' class='btn btn-default btn-sm'  >&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                   <br> <p id='disability' tabindex='0'><span id='disability_replace'>Other Disability: ".$this->user_data->get_disability()."</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' aria-label='Edit Disability' id='edit_disability' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='disability_edit_div' class='hidden_val'><input id='disability_new_val' class= 'form-control' tabindex='0' aria-label='enter new disability information'></input><br>&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' id='save_disability' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' id='cancel_disability' class='btn btn-default btn-sm'>&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                  <br>  <p id='meddia_preference_info' tabindex='0'><span id='media_replace'>Media Preference: ".$this->user_data->get_media_type()." </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' aria-label='Change your Media Preference' id='edit_media_pref' class='btn btn-primary btn-sm'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a></p>
                    <div role='form'  id='media_type_edit_div' class='hidden_val'><label for='nedia_type_new_val' id='media_type_new_val_lab' tabindex='0'>New Media Preference:</label><select id='media_type_new_val' class='form-control' tabindex='0' aria-label='Change Meida Type status'>".$this->media_options()."</select>
                    <br><a role='button' id='save_media_type' class='btn btn-primary btn-sm' tabindex='0'>&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;<a role='button' tabindex='0' id='cancel_media_type' class='btn btn-default btn-sm'  >&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;</a></div>
                  ";
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
        $current = 0;
        $options = "<option value=''> &nbsp;&nbsp;&nbsp;-&nbsp;Select&nbsp;-&nbsp;&nbsp;&nbsp;</option>";
        while ($current <=  $count)
        {
            $state = $result->itemat($current);
            if($state['id'] != "") {
                $options = $options . "<option value='" . $state['id'] . "'>&nbsp;&nbsp;&nbsp;" . $state['name'] . "&nbsp;&nbsp;&nbsp;</option>";
            }
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
                if($state['id'] != ""){
        $options = $options . "<option value='" . $state['id'] . "'>&nbsp;&nbsp;&nbsp;" . $state['name'] . "&nbsp;&nbsp;&nbsp;</option>";
                }
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
        $current = 0;
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
        $current = 0;
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
<option value='Email'>&nbsp;&nbsp;&nbsp;Email&nbsp;&nbsp;&nbsp;</option>
<option value='USB'>&nbsp;&nbsp;&nbsp;Usb Drive&nbsp;&nbsp;&nbsp;</option>
<option value='Audio'>&nbsp;&nbsp;&nbsp;Audio&nbsp;&nbsp;&nbsp;</option>
";
        return $options;
    }


}
