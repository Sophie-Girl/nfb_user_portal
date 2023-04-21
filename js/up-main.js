(function ($, Drupal) {
    Drupal.behaviors.up_main = {
        attach: function (context, settings) {
            window.onload = function () {
                hide_user_id();
                replace_title();
                console.log("I am running");
            }

            $('#save-prim-phone').once().click(function () {
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
                document.getElementById("prime_phone").innerText = "Phone: "+document.getElementById('prim_phone_new_val').value + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Phone' id='edit_prim_phone'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>";
                alert("Changes made successfully");
            });
            $('#save-prim-email').once().click(function () {
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
                document.getElementById("prime_email").innerhtml = "Email: "+document.getElementById('prim_email_new_val').value + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Primary Email' id='edit_prim_email'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>";
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
                document.getElementById("f_name").innerHTML = "First Name: "+document.getElementById('f_name_new_val').value+" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                alert("Changes made successfully");
            });
            $('#save-l-name').once().click(function () {
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
                document.getElementById("l_name").innerhtml = "Last Name: "+document.getElementById('l_name_new_val').value+ "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a role='button' aria-label='Edit Last Name' id='edit_l_name'>&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</a>";
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
                    document.getElementById("cancel_disability").style.display = "inline-block";
                    document.getElementById("save_disability").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "disability";
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
                    document.getElementById("blind_new_val_lab").style.display = "inline-block";
                    document.getElementById("cancel_blind").style.display = "inline-block";
                    document.getElementById("save_blind").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "blindness status";
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
                    document.getElementById("deaf_new_val_lab").style.display = "None";
                    document.getElementById("cancel_deaf").style.display = "inline-block";
                    document.getElementById("save_deaf").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "deaf blind status";
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
                    document.getElementById("gender_new_val_lab").style.display = "None";
                    document.getElementById("cancel_gender").style.display = "inline-block";
                    document.getElementById("save_gender").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "gender";
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
                    document.getElementById("lang_pref_new_val_lab").style.display = "None";
                    document.getElementById("cancel_lang_pref").style.display = "inline-block";
                    document.getElementById("save_lang_pref").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "language preference";
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
                    document.getElementById("media_type_new_val_lab").style.display = "None";
                    document.getElementById("cancel_media_type").style.display = "inline-block";
                    document.getElementById("save_media_type").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Media preference";
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
   header[0].innerText = document.getElementById("member_name").innerText;
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





