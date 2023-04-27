(function ($, Drupal) {
    Drupal.behaviors.up_main = {
        attach: function (context, settings) {
            window.onload = function () {
                hide_user_id();
                replace_title();
                console.log("I am running");
            }
            $('#save_brialle').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('braille_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "braille";
                    vfeildarray[2] = document.getElementById('braille_new_val').value
                }
                ajax_change_call(vfeildarray);
                alert("Changes made successfully");
            });
            $('#save_dog').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('dog_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "dog";
                    vfeildarray[2] = document.getElementById('dog_new_val').value
                }
                ajax_change_call(vfeildarray);
                alert("Changes made successfully");
            });
            $('#save_prim_street').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('prim_street_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "street_address";
                    vfeildarray[2] = document.getElementById('prim_street_new_val').value
                }
                ajax_change_call(vfeildarray);
                document.getElementById("street_replace").innerText = "Street Address: "+document.getElementById('prim_street_new_val').value;
                document.getElementById("prim_street_edit_div").style.display = "None";
                document.getElementById("prim_street_new_val").style.display = "None";
                document.getElementById("cancel_prim_street").style.display = "None";
                document.getElementById("save_prim_street").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("street_replace").focus();
                alert("Changes made successfully");
            });
            $('#save_prim_address_2').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('prim_address_2_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "Line 2";
                    vfeildarray[2] = document.getElementById('prim_address_2_new_val').value
                }
                ajax_change_call(vfeildarray);
                document.getElementById("line_2_replace").innerText = "Street Address Line 2: "+document.getElementById('prim_address_2_new_val').value;
                document.getElementById("prim_address_2_edit_div").style.display = "None";
                document.getElementById("prim_address_2_new_val").style.display = "None";
                document.getElementById("cancel_prim_address_2").style.display = "None";
                document.getElementById("save_prim_address_2").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("line_2_replace").focus();
                alert("Changes made successfully");
            });
            $('#save_prim_city').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('prim_city_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "City";
                    vfeildarray[2] = document.getElementById('prim_city_new_val').value
                }
                ajax_change_call(vfeildarray);
                document.getElementById("city_replace").innerText = "City: "+document.getElementById('prim_city_new_val').value;
                document.getElementById("prim_city_edit_div").style.display = "None";
                document.getElementById("prim_city_new_val").style.display = "None";
                document.getElementById("cancel_prim_city").style.display = "None";
                document.getElementById("save_prim_city").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("city_replace").focus();
                alert("Changes made successfully");
            });
            $('#save_prim_zip').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('prim_zip_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "zip";
                    vfeildarray[2] = document.getElementById('prim_zip_new_val').value
                }
                ajax_change_call(vfeildarray);
                document.getElementById("postal_replace").innerText = "ZIP/Postal Code: "+document.getElementById('prim_zip_new_val').value;
                document.getElementById("prim_zip_edit_div").style.display = "None";
                document.getElementById("prim_zip_new_val").style.display = "None";
                document.getElementById("cancel_prim_zip").style.display = "None";
                document.getElementById("save_prim_zip").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("postal_replace").focus();
                alert("Changes made successfully");
            });
            $('#save_pronouns').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('pronouns_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "pronouns";
                    vfeildarray[2] = document.getElementById('pronouns_new_val').value
                }
                ajax_change_call(vfeildarray);
                document.getElementById("pronouns_replace").innerText = "Pronouns: "+document.getElementById('pronouns_new_val').value;
                document.getElementById("pronouns_edit_div").style.display = "None";
                document.getElementById("pronouns_new_val").style.display = "None";
                document.getElementById("cancel_pronouns").style.display = "None";
                document.getElementById("save_pronouns").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("pronouns_replace").focus();
                alert("Changes made successfully");
            });
            $('#save_dob').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('dob_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "dob";
                    vfeildarray[2] = document.getElementById('dob_new_val').value
                }
                ajax_change_call(vfeildarray);
                document.getElementById("dob_replace").innerText = "Date of Birth: "+document.getElementById('dob_new_val').value;
                document.getElementById("dob_edit_div").style.display = "None";
                document.getElementById("dob_new_val").style.display = "None";
                document.getElementById("cancel_dob").style.display = "None";
                document.getElementById("save_dob").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("dob_replace").focus();
                alert("Changes made successfully");
            });
            $('#save_disability').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('disability_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "disability";
                    vfeildarray[2] = document.getElementById('disability_new_val').value
                }
                ajax_change_call(vfeildarray);
                document.getElementById("disability_replace").innerText = "Other Disability: "+document.getElementById('disability_new_val').value;
                document.getElementById("disability_edit_div").style.display = "None";
                document.getElementById("disability_new_val").style.display = "None";
                document.getElementById("cancel_disability").style.display = "None";
                document.getElementById("save_disability").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("disability_replace").focus();
                alert("Changes made successfully");
            });
            $('#save_prim_state').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('prim_country_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "State";
                    vfeildarray[2] = document.getElementById('prim_state_new_val').value;
                    vfeildarray[3] = document.getElementById('prim_country_new_val').value;
                }
                ajax_change_call(vfeildarray);
                alert("Changes made successfully");
            });
            $('#save_lang_pref').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('lang_pref_new_vall').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "lang";
                    vfeildarray[2] = document.getElementById('lang_pref_new_val').value;
                }
                ajax_change_call(vfeildarray);
                alert("Changes made successfully");
            });
            $('#save_gender').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('gender_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "gender";
                    vfeildarray[2] = document.getElementById('gender_new_val').value;
                }
                ajax_change_call(vfeildarray);
                alert("Changes made successfully");
            });
            $('#save_blind').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('blind_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "blind";
                    vfeildarray[2] = document.getElementById('blind_new_val').value;
                }
                ajax_change_call(vfeildarray);
                alert("Changes made successfully");
            });
            $('#save_deaf').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('deaf_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "deaf";
                    vfeildarray[2] = document.getElementById('deaf_new_val').value;
                }
                ajax_change_call(vfeildarray);
                alert("Changes made successfully");
            });
            $('#save_media_type').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('media_type_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "media";
                    vfeildarray[2] = document.getElementById('media_type_new_val').value;
                }
                ajax_change_call(vfeildarray);
                alert("Changes made successfully");
            });
            $('#save_prim_phone').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('prim_phone_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "phone";
                    vfeildarray[2] = document.getElementById('prim_phone_new_val').value
                }
                ajax_change_call(vfeildarray);
                document.getElementById("phone_replace").innerText = "Phone: "+document.getElementById('prim_phone_new_val').value;
                document.getElementById("prim_phone_edit_div").style.display = "None";
                document.getElementById("prim_phone_new_val").style.display = "None";
                document.getElementById("cancel_prim_phone").style.display = "None";
                document.getElementById("save_prim_phone").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("phone_replace").focus();
                alert("Changes made successfully");
            });
            $('#save_prim_email').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('prim_email_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "email";
                    vfeildarray[2] = document.getElementById('prim_email_new_val').value

                }
                ajax_change_call(vfeildarray);
                document.getElementById("email_repalce").innerText = "Email: "+document.getElementById('prim_email_new_val').value;
                document.getElementById("prim_email_edit_div").style.display = "None";
                document.getElementById("prim_email_new_val").style.display = "None";
                document.getElementById("cancel_prim_email").style.display = "None";
                document.getElementById("save_prim_email").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("email_repalce").focus();
                alert("Changes made successfully");

            });
            $('#save_f_name').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('f_name_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "f_name";
                    vfeildarray[2] = document.getElementById('f_name_new_val').value;
                }
                ajax_change_call(vfeildarray);
                document.getElementById("first_name_repalce").innerText = "First Name: "+document.getElementById('f_name_new_val').value;
                document.getElementById("first_name_edit_div").style.display = "None";
                document.getElementById("f_name_new_val").style.display = "None";
                document.getElementById("cancel_f_name").style.display = "None";
                document.getElementById("save_f_name").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("first_name_repalce").focus();
                alert("Changes made successfully");
            });
            $('#save_l_name').once().click(function () {
                var vfeildarray;
                var feild_data = document.getElementById('l_name_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "l_name";
                    vfeildarray[2] = document.getElementById('l_name_new_val').value

                }
                ajax_change_call(vfeildarray);
                document.getElementById("last_name_repalce").innerText = "Last Name: "+document.getElementById('l_name_new_val').value;
                document.getElementById("last_name_edit_div").style.display = "None";
                document.getElementById("l_name_new_val").style.display = "None";
                document.getElementById("cancel_l_name").style.display = "None";
                document.getElementById("save_l_name").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("last_name_repalce").focus();
                alert("Changes made successfully");
            });
            $('#edit_f_name').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("first_name_edit_div").style.display = "Block";
                    document.getElementById("f_name_new_val").style.display = "Block";
                    document.getElementById("cancel_f_name").style.display = "inline-block";
                    document.getElementById("save_f_name").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "First Name";
                    document.getElementById("f_name_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "First Name") {
                    document.getElementById("first_name_edit_div").style.display = "None";
                    document.getElementById("f_name_new_val").style.display = "None";
                    document.getElementById("cancel_f_name").style.display = "None";
                    document.getElementById("save_f_name").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_l_name').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("last_name_edit_div").style.display = "Block";
                    document.getElementById("l_name_new_val").style.display = "Block";
                    document.getElementById("cancel_l_name").style.display = "inline-block";
                    document.getElementById("save_l_name").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Last Name";
                    document.getElementById("l_name_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Last Name") {
                    document.getElementById("last_name_edit_div").style.display = "None";
                    document.getElementById("l_name_new_val").style.display = "None";
                    document.getElementById("cancel_l_name").style.display = "None";
                    document.getElementById("save_l_name").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_braille').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("braille_edit_div").style.display = "Block";
                    document.getElementById("braille_new_val").style.display = "Block";
                    document.getElementById("cancel_braille").style.display = "inline-block";
                    document.getElementById("save_braille").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Braille Reader";
                    document.getElementById("braille_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Braille Reader") {
                    document.getElementById("braille_edit_div").style.display = "None";
                    document.getElementById("braille_new_val").style.display = "None";
                    document.getElementById("cancel_braille").style.display = "None";
                    document.getElementById("save_braille").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_dog').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("dog_edit_div").style.display = "Block";
                    document.getElementById("dog_new_val").style.display = "Block";
                    document.getElementById("cancel_dog").style.display = "inline-block";
                    document.getElementById("save_dog").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Guide Dog User";
                    document.getElementById("dog_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Guide Dog User") {
                    document.getElementById("dog_edit_div").style.display = "None";
                    document.getElementById("dog_new_val").style.display = "None";
                    document.getElementById("cancel_dog").style.display = "None";
                    document.getElementById("save_dog").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_prim_email').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_email_edit_div").style.display = "Block";
                    document.getElementById("prim_email_new_val").style.display = "Block";
                    document.getElementById("cancel_prim_email").style.display = "inline-block";
                    document.getElementById("save_prim_email").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Email";
                    document.getElementById("prim_email_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Email") {
                    document.getElementById("prim_email_edit_div").style.display = "None";
                    document.getElementById("prim_email_new_val").style.display = "None";
                    document.getElementById("cancel_prim_email").style.display = "None";
                    document.getElementById("save_prim_email").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_prim_phone').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_phone_edit_div").style.display = "Block";
                    document.getElementById("prim_phone_new_val").style.display = "Block";
                    document.getElementById("cancel_prim_phone").style.display = "inline-block";
                    document.getElementById("save_prim_phone").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Phone";
                    document.getElementById("prim_phone_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Phone") {
                    document.getElementById("prim_phone_edit_div").style.display = "None";
                    document.getElementById("prim_phone_new_val").style.display = "None";
                    document.getElementById("cancel_prim_phone").style.display = "None";
                    document.getElementById("save_prim_phone").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_prim_street').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_street_edit_div").style.display = "Block";
                    document.getElementById("prim_street_new_val").style.display = "Block";
                    document.getElementById("cancel_prim_street").style.display = "inline-block";
                    document.getElementById("save_prim_street").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Street Address";
                    document.getElementById("prim_street_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Street Address") {
                    document.getElementById("prim_street_edit_div").style.display = "None";
                    document.getElementById("prim_street_new_val").style.display = "None";
                    document.getElementById("cancel_prim_street").style.display = "None";
                    document.getElementById("save_prim_street").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_prim_address_2').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_address_2_edit_div").style.display = "Block";
                    document.getElementById("prim_address_2_new_val").style.display = "Block";
                    document.getElementById("cancel_prim_address_2").style.display = "inline-block";
                    document.getElementById("save_prim_address_2").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Address Line 2";
                    document.getElementById("prim_address_2_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Address Line 2") {
                    document.getElementById("prim_address_2_edit_div").style.display = "None";
                    document.getElementById("prim_address_2_new_val").style.display = "None";
                    document.getElementById("cancel_prim_address_2").style.display = "None";
                    document.getElementById("save_prim_address_2").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_prim_city').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_city_edit_div").style.display = "Block";
                    document.getElementById("prim_city_new_val").style.display = "Block";
                    document.getElementById("cancel_prim_city").style.display = "inline-block";
                    document.getElementById("save_prim_city").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "City";
                    document.getElementById("prim_city_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "City") {
                    document.getElementById("prim_city_edit_div").style.display = "None";
                    document.getElementById("prim_city_new_val").style.display = "None";
                    document.getElementById("cancel_prim_city").style.display = "None";
                    document.getElementById("save_prim_city").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_prim_state').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_state_edit_div").style.display = "Block";
                    document.getElementById("prim_state_new_val").style.display = "Block";
                    document.getElementById("prim_state_new_val_lab").style.display = "inline-block";
                    document.getElementById("prim_country_new_val_lab").style.display = "inline-block";
                    document.getElementById("prim_country_new_val").style.display = "Block";
                    document.getElementById("cancel_prim_state").style.display = "inline-block";
                    document.getElementById("save_prim_state").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "State";
                    document.getElementById("prim_country_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "State") {
                    document.getElementById("prim_state_edit_div").style.display = "None";
                    document.getElementById("prim_state_new_val").style.display = "None";
                    document.getElementById("cancel_prim_state").style.display = "None";
                    document.getElementById("prim_state_new_val_lab").style.display = "None";
                    document.getElementById("prim_country_new_val_lab").style.display = "None";
                    document.getElementById("save_prim_city").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_prim_zip').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_zip_edit_div").style.display = "Block";
                    document.getElementById("prim_zip_new_val").style.display = "Block";
                    document.getElementById("cancel_prim_zip").style.display = "inline-block";
                    document.getElementById("save_prim_zip").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Zip Code";
                    document.getElementById("prim_zip_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Zip Code") {
                    document.getElementById("prim_zip_edit_div").style.display = "None";
                    document.getElementById("prim_zip_new_val").style.display = "None";
                    document.getElementById("cancel_prim_zip").style.display = "None";
                    document.getElementById("save_prim_zip").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_pronouns').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("pronouns_edit_div").style.display = "Block";
                    document.getElementById("pronouns_new_val").style.display = "Block";
                    document.getElementById("cancel_pronouns").style.display = "inline-block";
                    document.getElementById("save_pronouns").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Pronouns";
                    document.getElementById("pronouns_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Pronouns") {
                    document.getElementById("pronouns_edit_div").style.display = "None";
                    document.getElementById("pronouns_new_val").style.display = "None";
                    document.getElementById("cancel_pronouns").style.display = "None";
                    document.getElementById("save_pronouns").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_dob').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("dob_edit_div").style.display = "Block";
                    document.getElementById("dob_new_val").style.display = "Block";
                    document.getElementById("cancel_dob").style.display = "inline-block";
                    document.getElementById("save_dob").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Date of Birth";
                    document.getElementById("dob_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Date of Birth") {
                    document.getElementById("dob_edit_div").style.display = "None";
                    document.getElementById("dob_new_val").style.display = "None";
                    document.getElementById("cancel_dob").style.display = "None";
                    document.getElementById("save_dob").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_disability').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("disability_edit_div").style.display = "Block";
                    document.getElementById("disability_new_val").style.display = "Block";
                    document.getElementById("cancel_disability").style.display = "block";
                    document.getElementById("save_disability").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "disability";
                    document.getElementById("disability_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "disability") {
                    document.getElementById("disability_edit_div").style.display = "None";
                    document.getElementById("disability_new_val").style.display = "None";
                    document.getElementById("cancel_disability").style.display = "None";
                    document.getElementById("save_disability").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_blind').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("blind_edit_div").style.display = "Block";
                    document.getElementById("blind_new_val").style.display = "Block";
                    document.getElementById("blind_new_val_lab").style.display = "block";
                    document.getElementById("cancel_blind").style.display = "inline-block";
                    document.getElementById("save_blind").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "blindness status";
                    document.getElementById("blind_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "blindness status") {
                    document.getElementById("blind_edit_div").style.display = "None";
                    document.getElementById("blind_new_val").style.display = "None";
                    document.getElementById("blind_new_val_lab").style.display = "None";
                    document.getElementById("cancel_blind").style.display = "None";
                    document.getElementById("save_blind").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_deaf').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("deaf_edit_div").style.display = "Block";
                    document.getElementById("deaf_new_val").style.display = "Block";
                    document.getElementById("deaf_new_val_lab").style.display = "Block";
                    document.getElementById("cancel_deaf").style.display = "inline-block";
                    document.getElementById("save_deaf").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "deaf blind status";
                    document.getElementById("deaf_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "deaf blind status") {
                    document.getElementById("deaf_edit_div").style.display = "None";
                    document.getElementById("deaf_new_val").style.display = "None";
                    document.getElementById("deaf_new_val_lab").style.display = "None";
                    document.getElementById("cancel_deaf").style.display = "None";
                    document.getElementById("save_deaf").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_gender').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("gender_edit_div").style.display = "Block";
                    document.getElementById("gender_new_val").style.display = "Block";
                    document.getElementById("gender_new_val_lab").style.display = "Blcok";
                    document.getElementById("cancel_gender").style.display = "inline-block";
                    document.getElementById("save_gender").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "gender";
                    document.getElementById("gender_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "gender") {
                    document.getElementById("gender_edit_div").style.display = "None";
                    document.getElementById("gender_new_val").style.display = "None";
                    document.getElementById("gender_new_val_lab").style.display = "None";
                    document.getElementById("cancel_gender").style.display = "None";
                    document.getElementById("save_gender").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_lang_pref').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("lang_pref_edit_div").style.display = "Block";
                    document.getElementById("lang_pref_new_val").style.display = "Block";
                    document.getElementById("lang_pref_new_val_lab").style.display = "block";
                    document.getElementById("cancel_lang_pref").style.display = "inline-block";
                    document.getElementById("save_lang_pref").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "language preference";
                    document.getElementById("lang_pref_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "language preference") {
                    document.getElementById("lang_pref_edit_div").style.display = "None";
                    document.getElementById("lang_pref_new_val").style.display = "None";
                    document.getElementById("lang_pref_new_val_lab").style.display = "None";
                    document.getElementById("cancel_lang_pref").style.display = "None";
                    document.getElementById("save_lang_pref").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#edit_media_pref').once().click(function () {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("media_type_edit_div").style.display = "Block";
                    document.getElementById("media_type_new_val").style.display = "Block";
                    document.getElementById("media_type_new_val_lab").style.display = "block";
                    document.getElementById("cancel_media_type").style.display = "inline-block";
                    document.getElementById("save_media_type").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Media preference";
                    document.getElementById("media_type_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Media preference") {
                    document.getElementById("media_type_edit_div").style.display = "None";
                    document.getElementById("media_type_new_val").style.display = "None";
                    document.getElementById("media_type_new_val_lab").style.display = "None";
                    document.getElementById("cancel_media_type").style.display = "None";
                    document.getElementById("save_media_type").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            });
            $('#cancel_media_type').once().click(function () {
                document.getElementById("media_type_edit_div").style.display = "None";
                document.getElementById("media_type_new_val").style.display = "None";
                document.getElementById("cancel_media_type").style.display = "None";
                document.getElementById("save_media_type").style.display = "None";
                document.getElementById("media_type_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_dog').once().click(function () {
                document.getElementById("dog_edit_div").style.display = "None";
                document.getElementById("dog_new_val").style.display = "None";
                document.getElementById("cancel_dog").style.display = "None";
                document.getElementById("save_dog").style.display = "None";
                document.getElementById("dog_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_braille').once().click(function () {
                document.getElementById("braille_edit_div").style.display = "None";
                document.getElementById("braille_new_val").style.display = "None";
                document.getElementById("cancel_braille").style.display = "None";
                document.getElementById("save_braille").style.display = "None";
                document.getElementById("braille_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_blind').once().click(function () {
                document.getElementById("blind_edit_div").style.display = "None";
                document.getElementById("blind_new_val").style.display = "None";
                document.getElementById("cancel_blind").style.display = "None";
                document.getElementById("save_blind").style.display = "None";
                document.getElementById("blind_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_deaf').once().click(function () {
                document.getElementById("deaf_edit_div").style.display = "None";
                document.getElementById("deaf_new_val").style.display = "None";
                document.getElementById("cancel_deaf").style.display = "None";
                document.getElementById("save_deaf").style.display = "None";
                document.getElementById("deaf_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_gender').once().click(function () {
                document.getElementById("gender_edit_div").style.display = "None";
                document.getElementById("gender_new_val").style.display = "None";
                document.getElementById("cancel_gender").style.display = "None";
                document.getElementById("save_gender").style.display = "None";
                document.getElementById("gender_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_lang_pref').once().click(function () {
                document.getElementById("lang_pref_edit_div").style.display = "None";
                document.getElementById("lang_pref_new_val").style.display = "None";
                document.getElementById("cancel_lang_pref").style.display = "None";
                document.getElementById("save_lang_pref").style.display = "None";
                document.getElementById("lang_pref_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_state').once().click(function () {

                document.getElementById("prim_state_edit_div").style.display = "None";
                document.getElementById("prim_state_new_val").style.display = "None";
                document.getElementById("cancel_prim_state").style.display = "None";
                document.getElementById("prim_state_new_val_lab").style.display = "None";
                document.getElementById("prim_country_new_val_lab").style.display = "None";
                document.getElementById("save_prim_city").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

            });
            $('#cancel_disability').once().click(function () {
                document.getElementById("disability_edit_div").style.display = "None";
                document.getElementById("disability_new_val").style.display = "None";
                document.getElementById("cancel_disability").style.display = "None";
                document.getElementById("save_disability").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_pronouns').once().click(function () {
                document.getElementById("pronouns_edit_div").style.display = "None";
                document.getElementById("pronouns_new_val").style.display = "None";
                document.getElementById("cancel_pronouns").style.display = "None";
                document.getElementById("save_pronouns").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_dob').once().click(function () {
                document.getElementById("dob_edit_div").style.display = "None";
                document.getElementById("dob_new_val").style.display = "None";
                document.getElementById("cancel_dob").style.display = "None";
                document.getElementById("save_dob").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_zip').once().click(function () {
                document.getElementById("prim_zip_edit_div").style.display = "None";
                document.getElementById("prim_zip_new_val").style.display = "None";
                document.getElementById("cancel_prim_zip").style.display = "None";
                document.getElementById("save_prim_zip").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_city').once().click(function () {
                document.getElementById("prim_city_edit_div").style.display = "None";
                document.getElementById("prim_city_new_val").style.display = "None";
                document.getElementById("cancel_prim_city").style.display = "None";
                document.getElementById("save_prim_city").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_address_2').once().click(function () {
                document.getElementById("prim_address_2_edit_div").style.display = "None";
                document.getElementById("prim_address_2_new_val").style.display = "None";
                document.getElementById("cancel_prim_address_2").style.display = "None";
                document.getElementById("save_prim_address_2").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_street').once().click(function () {
                document.getElementById("prim_street_edit_div").style.display = "None";
                document.getElementById("prim_street_new_val").style.display = "None";
                document.getElementById("cancel_prim_street").style.display = "None";
                document.getElementById("save_prim_street").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_phone').once().click(function () {
                document.getElementById("prim_phone_edit_div").style.display = "None";
                document.getElementById("prim_phone_new_val").style.display = "None";
                document.getElementById("cancel_prim_phone").style.display = "None";
                document.getElementById("save_prim_phone").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_email').once().click(function () {
                document.getElementById("prim_email_edit_div").style.display = "None";
                document.getElementById("prim_email_new_val").style.display = "None";
                document.getElementById("cancel_prim_email").style.display = "None";
                document.getElementById("save_prim_email").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_l_name').once().click(function () {
                document.getElementById("last_name_edit_div").style.display = "None";
                document.getElementById("l_name_new_val").style.display = "None";
                document.getElementById("cancel_l_name").style.display = "None";
                document.getElementById("save_l_name").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_f_name').once().click(function () {
                document.getElementById("first_name_edit_div").style.display = "None";
                document.getElementById("f_name_new_val").style.display = "None";
                document.getElementById("cancel_f_name").style.display = "None";
                document.getElementById("save_f_name").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#prim_country_new_val').once().change(function ()
            {
                var vcountry = document.getElementById("prim_country_new_val").value;
                ajax_change_state_call(vcountry);
            });


        }
    }
    function ajax_change_call(vfeildarray) {
        console.log("test "+vfeildarray);
        if (vfeildarray != "no-run") {
            console.log("i should be doing a post");
            $.ajax({
                type: 'POST',
                url: '/member_portal/ajax/page_load',
                data: {feildarray: vfeildarray},
            }).done(function (data) {
                var info = data;
                if(vfeildarray[1] == "State")
                {
                    document.getElementById("state_repalce").innerText = "State, Country: "+info[0]+", "+info[1];
                    document.getElementById("prim_state_edit_div").style.display = "None";
                    document.getElementById("prim_state_new_val").style.display = "None";
                    document.getElementById("cancel_prim_state").style.display = "None";
                    document.getElementById("prim_state_new_val_lab").style.display = "None";
                    document.getElementById("prim_country_new_val_lab").style.display = "None";
                    document.getElementById("save_prim_city").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    document.getElementById("state_repalce").focus();
                }
                else if(vfeildarray[1] == "lang"){
                    document.getElementById("lang_repalce").innerText = "Preferred Language: "+info[0];
                    document.getElementById("lang_pref_edit_div").style.display = "None";
                    document.getElementById("lang_pref_new_val").style.display = "None";
                    document.getElementById("lang_pref_new_val_lab").style.display = "None";
                    document.getElementById("cancel_lang_pref").style.display = "None";
                    document.getElementById("save_lang_pref").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    document.getElementById("lang_repalce").focus();
                }
                else if(vfeildarray[1] == "gender")
                {
                    document.getElementById("gender_change").innerText = "Gender: "+info[0];
                    document.getElementById("gender_edit_div").style.display = "None";
                    document.getElementById("gender_new_val").style.display = "None";
                    document.getElementById("gender_new_val_lab").style.display = "None";
                    document.getElementById("cancel_gender").style.display = "None";
                    document.getElementById("save_gender").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    document.getElementById("gender_change").focus();
                }
                else if(vfeildarray[1] == "blind")
                {
                    document.getElementById("blind_replace").innerText = "Blindness Status: "+info[0];
                    document.getElementById("blind_edit_div").style.display = "None";
                    document.getElementById("blind_new_val").style.display = "None";
                    document.getElementById("blind_new_val_lab").style.display = "None";
                    document.getElementById("cancel_blind").style.display = "None";
                    document.getElementById("save_blind").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    document.getElementById("blind_replace").focus();

                }
                else if(vfeildarray[1] == "deaf")
                {
                    document.getElementById("deaf_replace").innerText = "Deafblind Status: "+info[0];
                    document.getElementById("deaf_edit_div").style.display = "None";
                    document.getElementById("deaf_new_val").style.display = "None";
                    document.getElementById("deaf_new_val_lab").style.display = "None";
                    document.getElementById("cancel_deaf").style.display = "None";
                    document.getElementById("save_deaf").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    document.getElementById("deaf_replace").focus();
                }
                else if(vfeildarray == "media")
                {
                    document.getElementById("media_replace").innerText = "Media Preference: "+info[0];
                    document.getElementById("media_type_edit_div").style.display = "None";
                    document.getElementById("media_type_new_val").style.display = "None";
                    document.getElementById("media_type_new_val_lab").style.display = "None";
                    document.getElementById("cancel_media_type").style.display = "None";
                    document.getElementById("save_media_type").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    document.getElementById("media_replace").focus();
                }
                else if(vfeildarray == "braille")
                {
                    document.getElementById("braille_replace").innerText = "Media Preference: "+info[0];
                    document.getElementById("braille_edit_div").style.display = "None";
                    document.getElementById("braille_new_val").style.display = "None";
                    document.getElementById("cancel_braille").style.display = "None";
                    document.getElementById("save_braille").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    document.getElementById("braille_replace").focus();
                }
                else if(vfeildarray == "dog")
                {
                    document.getElementById("dog_replace").innerText = "Media Preference: "+info[0];
                }
            });

        }
    }
        function ajax_change_state_call(vcountry)
        {
            if(vcountry != "") {
                $.ajax({
                    type: 'POST',
                    url: '/nfb_member_portal/ajax/state',
                    data: {country: vcountry},
                }).done(function (data) {
                    document.getElementById("prim_state_new_val").innerHTML = data;
                });
            }

    }

    })(jQuery, Drupal)
function show_hide_edit_feild(div_id)
{
    var disp = document.getElementById(div_id).style.display;
    if(disp == "None")
    {
        document.getElementById(div_id).style.display = "Block";
    }
    else
    {
        document.getElementById(div_id).style.display = "None";
    }
}
function replace_title()
{
    document.title = document.getElementById("member_name").innerText;
   var header = document.getElementsByClassName("js-quickedit-page-title page-title");
   if(header[0]){
   header[0].innerText = document.getElementById("member_name").innerText;}
   else {   header = document.getElementsByClassName("page-title");
       header[0].innerText = document.getElementById("member_name").innerText;}
}
function replace_old_value(lab_id, new_val)
{
    document.getElementById(lab_id).innerText = new_val;
}
function hide_user_id()
{
    document.getElementById("user_id_val").style.display = "None";
    document.getElementById("civi_id_val").style.display = "None";
    document.getElementById("user_name_val").style.display = "None";
    document.getElementById("first_name_edit_div").style.display = "None";
    document.getElementById("f_name_new_val").style.display = "None";
    document.getElementById("cancel_f_name").style.display = "None";
    document.getElementById("save_f_name").style.display = "None";
    document.getElementById("last_name_edit_div").style.display = "None";
    document.getElementById("l_name_new_val").style.display = "None";
    document.getElementById("cancel_l_name").style.display = "None";
    document.getElementById("save_l_name").style.display = "None";
    document.getElementById("prim_email_edit_div").style.display = "None";
    document.getElementById("prim_email_new_val").style.display = "None";
    document.getElementById("cancel_prim_email").style.display = "None";
    document.getElementById("save_prim_email").style.display = "None";
    document.getElementById("prim_phone_edit_div").style.display = "None";
    document.getElementById("prim_phone_new_val").style.display = "None";
    document.getElementById("cancel_prim_phone").style.display = "None";
    document.getElementById("save_prim_phone").style.display = "None";
    document.getElementById("prim_street_edit_div").style.display = "None";
    document.getElementById("prim_street_new_val").style.display = "None";
    document.getElementById("cancel_prim_street").style.display = "None";
    document.getElementById("save_prim_street").style.display = "None";
    document.getElementById("prim_address_2_edit_div").style.display = "None";
    document.getElementById("prim_address_2_new_val").style.display = "None";
    document.getElementById("cancel_prim_address_2").style.display = "None";
    document.getElementById("save_prim_address_2").style.display = "None";
    document.getElementById("prim_city_edit_div").style.display = "None";
    document.getElementById("prim_city_new_val").style.display = "None";
    document.getElementById("cancel_prim_city").style.display = "None";
    document.getElementById("save_prim_city").style.display = "None";
    document.getElementById("prim_state_edit_div").style.display = "None";
    document.getElementById("prim_state_new_val").style.display = "None";
    document.getElementById("prim_country_new_val").style.display = "None";
    document.getElementById("cancel_prim_state").style.display = "None";
    document.getElementById("save_prim_state").style.display = "None";
    document.getElementById("prim_country_new_val_lab").style.display = "None";
    document.getElementById("prim_state_new_val_lab").style.display = "None";
    document.getElementById("prim_zip_edit_div").style.display = "None";
    document.getElementById("prim_zip_new_val").style.display = "None";
    document.getElementById("cancel_prim_zip").style.display = "None";
    document.getElementById("save_prim_zip").style.display = "None";
    document.getElementById("lang_pref_edit_div").style.display = "None";
    document.getElementById("lang_pref_new_val").style.display = "None";
    document.getElementById("cancel_lang_pref").style.display = "None";
    document.getElementById("save_lang_pref").style.display = "None";
    document.getElementById("lang_pref_new_val_lab").style.display = "None";
    document.getElementById("gender_edit_div").style.display = "None";
    document.getElementById("gender_new_val").style.display = "None";
    document.getElementById("cancel_gender").style.display = "None";
    document.getElementById("save_gender").style.display = "None";
    document.getElementById("gender_new_val_lab").style.display = "None";
    document.getElementById("blind_edit_div").style.display = "None";
    document.getElementById("blind_new_val").style.display = "None";
    document.getElementById("cancel_blind").style.display = "None";
    document.getElementById("save_blind").style.display = "None";
    document.getElementById("blind_new_val_lab").style.display = "None";
    document.getElementById("deaf_edit_div").style.display = "None";
    document.getElementById("deaf_new_val").style.display = "None";
    document.getElementById("cancel_deaf").style.display = "None";
    document.getElementById("save_deaf").style.display = "None";
    document.getElementById("deaf_new_val_lab").style.display = "None";
    document.getElementById("media_type_edit_div").style.display = "None";
    document.getElementById("media_type_new_val").style.display = "None";
    document.getElementById("cancel_media_type").style.display = "None";
    document.getElementById("save_media_type").style.display = "None";
    document.getElementById("media_type_new_val_lab").style.display = "None";
    document.getElementById("pronouns_edit_div").style.display = "None";
    document.getElementById("pronouns_new_val").style.display = "None";
    document.getElementById("cancel_pronouns").style.display = "None";
    document.getElementById("save_pronouns").style.display = "None";
    document.getElementById("dob_edit_div").style.display = "None";
    document.getElementById("dob_new_val").style.display = "None";
    document.getElementById("cancel_dob").style.display = "None";
    document.getElementById("save_dob").style.display = "None";

}





