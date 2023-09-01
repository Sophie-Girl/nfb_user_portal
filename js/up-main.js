(function ($, Drupal) {
    // Connell, Sophi: Bind and which are used here because we are using an older version of jQuery. It will need to be updated
    Drupal.behaviors.up_main = {
        attach: function (context, settings) {
            window.onload = function () {
                hide_user_id();
                replace_title();
                more_logout_fun();
            }
            $('#save_brialle').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                }});
            $('#save_dog').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
            }});
            $('#save_prim_zip').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                var vfeildarray;
                var feild_data = document.getElementById('prim_zip_new_val').value;
                if (feild_data == "") {
                    vfeildarray = "not_run";
                } else {
                    vfeildarray = [];
                    vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                    vfeildarray[1] = "zip";
                    vfeildarray[2] = document.getElementById('prim_zip_new_val').value;
                    vfeildarray[3] = document.getElementById('prim_street_new_val').value;
                    vfeildarray[4] = document.getElementById('prim_address_2_new_val').value;
                    vfeildarray[5] = document.getElementById('prim_city_new_val').value;
                    vfeildarray[6] = document.getElementById('prim_state_new_val').value;
                    vfeildarray[7] = document.getElementById('prim_country_new_val').value;
                }
                ajax_change_call(vfeildarray);
                document.getElementById("state_val").innerText =  document.getElementById('prim_state_new_val').value;
                document.getElementById("country_val").innerText = document.getElementById('prim_country_new_val').value;
                document.getElementById("edit_prim_street").focus();
                document.getElementById("postal_repalce").innerText = document.getElementById('prim_zip_new_val').value;
                document.getElementById("prim_zip_edit_div").style.display = "None";
                document.getElementById("prim_zip_new_val").style.display = "None";
                document.getElementById("city_replace").innerText = "City: "+document.getElementById('prim_city_new_val').value;
                document.getElementById("prim_city_edit_div").style.display = "None";
                document.getElementById("prim_city_new_val").style.display = "None";
                document.getElementById("cancel_prim_zip").style.display = "None";
                document.getElementById("save_prim_zip").style.display = "None";
                document.getElementById("line_2_replace").innerText = "Street Address Line 2: "+document.getElementById('prim_address_2_new_val').value;
                document.getElementById("prim_address_2_edit_div").style.display = "None";
                document.getElementById("prim_address_2_new_val").style.display = "None";
                document.getElementById("street_replace").innerText = "Street Address Line 1: "+document.getElementById('prim_street_new_val').value;
                document.getElementById("prim_street_edit_div").style.display = "None";
                document.getElementById("prim_street_new_val").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                alert("Changes made successfully");
            }});
            $('#save_pronouns').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                document.getElementById("edit_pronouns").focus();
                document.getElementById("pronouns_replace").innerText = "Pronouns: "+document.getElementById('pronouns_new_val').value;
                document.getElementById("pronouns_edit_div").style.display = "None";
                document.getElementById("pronouns_new_val").style.display = "None";
                document.getElementById("cancel_pronouns").style.display = "None";
                document.getElementById("save_pronouns").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                alert("Changes made successfully");
            }});
            $('#save_dob').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                document.getElementById("edit_dob").focus();
                var dob = document.getElementById('dob_new_val').value;
                var year = dob.substr(0,4);
                var month = dob.substr(5,2);
                var day = dob.substr(8,2);
                document.getElementById("dob_replace").innerText = "Date of Birth: "+month+"-"+day+"-"+year;
                document.getElementById("dob_edit_div").style.display = "None";
                document.getElementById("dob_new_val").style.display = "None";
                document.getElementById("cancel_dob").style.display = "None";
                document.getElementById("save_dob").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

                alert("Changes made successfully");
            }});
            $('#save_disability').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                document.getElementById("edit_disability").focus();
                document.getElementById("disability_replace").innerText = "Other Disability: "+document.getElementById('disability_new_val').value;
                document.getElementById("disability_edit_div").style.display = "None";
                document.getElementById("disability_new_val").style.display = "None";
                document.getElementById("cancel_disability").style.display = "None";
                document.getElementById("save_disability").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

                alert("Changes made successfully");
            }});

            $('#save_lang_pref').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                    var vfeildarray;
                    var feild_data = document.getElementById('lang_pref_new_val').value;
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
                }});
            $('#save_gender').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                }});
            $('#save_blind').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                }});
            $('#save_braille').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                    var vfeildarray;
                    var feild_data = document.getElementById('braille_new_val').value;
                    if (feild_data == "") {
                        vfeildarray = "not_run";
                    } else {
                        vfeildarray = [];
                        vfeildarray[0] = document.getElementById('civi_id_val').innerText;
                        vfeildarray[1] = "braille";
                        vfeildarray[2] = document.getElementById('braille_new_val').value;
                    }
                    ajax_change_call(vfeildarray);
                    alert("Changes made successfully");
                }});
            $('#save_deaf').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
            }});
            $('#save_media_type').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
            }});
            $('#save_prim_phone').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                    document.getElementById("edit_prim_phone").focus();
                    document.getElementById("phone_replace").innerText = "Phone: " + document.getElementById('prim_phone_new_val').value;
                    document.getElementById("prim_phone_edit_div").style.display = "None";
                    document.getElementById("prim_phone_new_val").style.display = "None";
                    document.getElementById("cancel_prim_phone").style.display = "None";
                    document.getElementById("save_prim_phone").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    alert("Changes made successfully");
                }});
            $('#save_prim_email').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                    document.getElementById("edit_prim_email").focus();
                    document.getElementById("email_repalce").innerText = "Email: " + document.getElementById('prim_email_new_val').value;
                    document.getElementById("prim_email_edit_div").style.display = "None";
                    document.getElementById("prim_email_new_val").style.display = "None";
                    document.getElementById("cancel_prim_email").style.display = "None";
                    document.getElementById("save_prim_email").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                    alert("Changes made successfully");

                }});
            $('#save_f_name').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                    document.getElementById("edit_f_name").focus();
                    document.getElementById("first_name_repalce").innerText = "First Name: " + document.getElementById('f_name_new_val').value;
                    document.getElementById("first_name_edit_div").style.display = "None";
                    document.getElementById("f_name_new_val").style.display = "None";
                    document.getElementById("cancel_f_name").style.display = "None";
                    document.getElementById("save_f_name").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                    document.getElementById("first_name_repalce").focus();
                    alert("Changes made successfully");


                }});
            $('#save_l_name').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                document.getElementById("edit_l_name").focus();
                document.getElementById("last_name_repalce").innerText = "Last Name: "+document.getElementById('l_name_new_val').value;
                document.getElementById("last_name_edit_div").style.display = "None";
                document.getElementById("l_name_new_val").style.display = "None";
                document.getElementById("cancel_l_name").style.display = "None";
                document.getElementById("save_l_name").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

                alert("Changes made successfully");
            }});
            $('#edit_f_name').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                    var editstatus = document.getElementById("edit_open").innerText;
                    var openfeild = document.getElementById("open_field").innerText;
                    if (editstatus == "Not Open") {
                        document.getElementById("first_name_edit_div").style.display = "Block";
                        document.getElementById("f_name_new_val").style.display = "Block";
                        document.getElementById("cancel_f_name").style.display = "inline-block";
                        document.getElementById("save_f_name").style.display = "inline-block";
                        document.getElementById("edit_open").innerText = "Open";
                        document.getElementById("open_field").innerText = "First Name";
                        var text = document.getElementById("first_name_repalce").innerText;
                        document.getElementById("f_name_new_val").value = text.replace("First Name: ", "");
                        document.getElementById("f_name_new_val").focus();
                    } else if (editstatus == "Open" && openfeild == "First Name") {
                        document.getElementById("edit_f_name").focus();
                        document.getElementById("first_name_edit_div").style.display = "None";
                        document.getElementById("f_name_new_val").style.display = "None";
                        document.getElementById("cancel_f_name").style.display = "None";
                        document.getElementById("save_f_name").style.display = "None";
                        document.getElementById("f_name_new_val").value = "";
                        document.getElementById("edit_open").innerText = "Not Open";
                        document.getElementById("open_field").innerText = "None";

                    } else {
                        alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                    }
                } });
            $('#edit_l_name').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                    var editstatus = document.getElementById("edit_open").innerText;
                    var openfeild = document.getElementById("open_field").innerText;
                    if (editstatus == "Not Open") {
                        document.getElementById("last_name_edit_div").style.display = "Block";
                        document.getElementById("l_name_new_val").style.display = "Block";
                        document.getElementById("cancel_l_name").style.display = "inline-block";
                        document.getElementById("save_l_name").style.display = "inline-block";
                        document.getElementById("edit_open").innerText = "Open";
                        document.getElementById("open_field").innerText = "Last Name";
                        var text = document.getElementById("last_name_repalce").innerText;
                        document.getElementById("l_name_new_val").value = text.replace("Last Name: ", "");
                        document.getElementById("l_name_new_val").focus();
                    } else if (editstatus == "Open" && openfeild == "Last Name") {
                        document.getElementById("edit_l_name").focus();
                        document.getElementById("last_name_edit_div").style.display = "None";
                        document.getElementById("l_name_new_val").style.display = "None";
                        document.getElementById("l_name_new_val").value = "";
                        document.getElementById("cancel_l_name").style.display = "None";
                        document.getElementById("save_l_name").style.display = "None";
                        document.getElementById("edit_open").innerText = "Not Open";
                        document.getElementById("open_field").innerText = "None";

                    } else {
                        alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                    }
                }});
            $('#edit_braille').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                    document.getElementById("edit_braille").focus();
                    document.getElementById("braille_edit_div").style.display = "None";
                    document.getElementById("braille_new_val").style.display = "None";
                    document.getElementById("cancel_braille").style.display = "None";
                    document.getElementById("save_braille").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            }});
            $('#edit_dog').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                    document.getElementById("edit_dog").focus();
                    document.getElementById("dog_edit_div").style.display = "None";
                    document.getElementById("dog_new_val").style.display = "None";
                    document.getElementById("cancel_dog").style.display = "None";
                    document.getElementById("save_dog").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            }});
            $('#edit_prim_email').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_email_edit_div").style.display = "Block";
                    document.getElementById("prim_email_new_val").style.display = "Block";
                    document.getElementById("cancel_prim_email").style.display = "inline-block";
                    document.getElementById("save_prim_email").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Email";
                    var text = document.getElementById("email_repalce").innerText;
                    document.getElementById("prim_email_new_val").value = text.replace("Email: ", "");
                    document.getElementById("prim_email_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Email") {
                    document.getElementById("edit_prim_email").focus();
                    document.getElementById("prim_email_edit_div").style.display = "None";
                    document.getElementById("prim_email_new_val").style.display = "None";
                    document.getElementById("prim_email_new_val").value = "";
                    document.getElementById("cancel_prim_email").style.display = "None";
                    document.getElementById("save_prim_email").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            }});
            $('#edit_prim_phone').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                    var editstatus = document.getElementById("edit_open").innerText;
                    var openfeild = document.getElementById("open_field").innerText;
                    if (editstatus == "Not Open") {
                        document.getElementById("prim_phone_edit_div").style.display = "Block";
                        document.getElementById("prim_phone_new_val").style.display = "Block";
                        document.getElementById("cancel_prim_phone").style.display = "inline-block";
                        document.getElementById("save_prim_phone").style.display = "inline-block";
                        document.getElementById("edit_open").innerText = "Open";
                        document.getElementById("open_field").innerText = "Phone";
                        var text = document.getElementById("phone_replace").innerText;
                        document.getElementById("prim_phone_new_val").value = text.replace("Phone: ", "");
                        document.getElementById("prim_phone_new_val").focus();
                    } else if (editstatus == "Open" && openfeild == "Phone") {
                        document.getElementById("edit_prim_phone").focus();
                        document.getElementById("prim_phone_edit_div").style.display = "None";
                        document.getElementById("prim_phone_new_val").style.display = "None";
                        document.getElementById("cancel_prim_phone").style.display = "None";
                        document.getElementById("save_prim_phone").style.display = "None";
                        document.getElementById("prim_phone_new_val").value = ""
                        document.getElementById("edit_open").innerText = "Not Open";
                        document.getElementById("open_field").innerText = "None";

                    } else {
                        alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                    }
                }});
            $('#edit_prim_street').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("prim_street_edit_div").style.display = "Block";
                    document.getElementById("prim_street_new_val").style.display = "Block";
                    document.getElementById("prim_street_new_val_lab").style.display = "inline-block";
                    var text = document.getElementById("street_replace").innerText;
                    var text_check = text.replace("Street Address Line 1: ", "");
                    document.getElementById("prim_street_new_val").value = text_check.replace("Street Address: ", "");
                    document.getElementById("prim_address_2_edit_div").style.display = "Block";
                    document.getElementById("prim_address_2_new_val").style.display = "Block";
                    document.getElementById("prim_address_2_new_val_lab").style.display = "inline-block";
                    var text = document.getElementById("line_2_replace").innerText;
                    document.getElementById("prim_address_2_new_val").value = text.replace("Street Address Line 2: ", "");
                    document.getElementById("prim_city_edit_div").style.display = "Block";
                    document.getElementById("prim_city_new_val").style.display = "Block";
                    document.getElementById("prim_city_new_val_lab").style.display = "inline-block";
                    var text = document.getElementById("city_replace").innerText;
                    document.getElementById("prim_city_new_val").value = text.replace("City: ", "");
                    document.getElementById("prim_country_new_val").value = document.getElementById("country_val").innerText;
                    document.getElementById("prim_state_edit_div").style.display = "Block";
                    document.getElementById("prim_state_new_val").style.display = "Block";
                    var vcountry = document.getElementById("prim_country_new_val").value;
                    ajax_change_state_call(vcountry);

                    document.getElementById("prim_state_new_val_lab").style.display = "inline-block";
                    document.getElementById("prim_country_new_val_lab").style.display = "inline-block";
                    document.getElementById("prim_country_new_val").style.display = "Block";
                    document.getElementById("prim_zip_edit_div").style.display = "Block";
                    document.getElementById("prim_zip_new_val").style.display = "Block";
                    document.getElementById("prim_zip_new_val_lab").style.display = "inline-lock";
                    var text = document.getElementById("postal_repalce").innerText;
                    document.getElementById("prim_zip_new_val").value = text;
                    document.getElementById("cancel_prim_zip").style.display = "inline-block";
                    document.getElementById("save_prim_zip").style.display = "inline-block";
                    document.getElementById("prim_zip_new_val_lab").style.display = "block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Street Address";
                    document.getElementById("prim_state_new_val").value = document.getElementById("state_val").innerText;
                    document.getElementById("prim_street_new_val").focus();
                    console.log("inner state: "+ document.getElementById("state_val").innerText);
                } else if (editstatus == "Open" && openfeild == "Street Address") {
                    document.getElementById("edit_prim_street").focus();
                    document.getElementById("prim_street_edit_div").style.display = "None";
                    document.getElementById("prim_street_new_val").style.display = "None";
                    document.getElementById("prim_street_new_val").value = "";
                    document.getElementById("prim_street_new_val_lab").style.display = "None";
                    document.getElementById("prim_city_edit_div").style.display = "None";
                    document.getElementById("prim_city_new_val").style.display = "None";
                    document.getElementById("prim_city_new_val").value = "";
                    document.getElementById("prim_city_new_val_lab").style.display = "None";
                    document.getElementById("prim_address_2_edit_div").style.display = "None";
                    document.getElementById("prim_address_2_new_val").style.display = "None";
                    document.getElementById("prim_address_2_new_val").value = "";
                    document.getElementById("prim_address_2_new_val_lab").style.display = "None";
                    document.getElementById("prim_state_edit_div").style.display = "None";
                    document.getElementById("prim_state_new_val").style.display = "None";
                    document.getElementById("prim_state_new_val_lab").style.display = "None";
                    document.getElementById("prim_country_new_val_lab").style.display = "None";
                    document.getElementById("prim_zip_edit_div").style.display = "None";
                    document.getElementById("prim_zip_new_val").style.display = "None";
                    document.getElementById("prim_zip_new_val_lab").style.display = "None";
                    document.getElementById("prim_state_new_val").value = "";
                    document.getElementById("prim_zip_new_val").style.display = "None";
                    document.getElementById("cancel_prim_zip").style.display = "None";
                    document.getElementById("save_prim_zip").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";


                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            }});
            $('#prim_street_new_val').once().blur(function ()
                {
                    document.getElementById("prim_state_new_val").value = document.getElementById("state_val").innerText;
                }
            );
            $('#edit_pronouns').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("pronouns_edit_div").style.display = "Block";
                    document.getElementById("pronouns_new_val").style.display = "Block";
                    document.getElementById("cancel_pronouns").style.display = "inline-block";
                    document.getElementById("save_pronouns").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Pronouns";
                    var text = document.getElementById("pronouns_replace").innerText;
                    document.getElementById("pronouns_new_val").value = text.replace("Pronouns: ", "");
                    document.getElementById("pronouns_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Pronouns") {
                    document.getElementById("edit_pronouns").focus();
                    document.getElementById("pronouns_edit_div").style.display = "None";
                    document.getElementById("pronouns_new_val").style.display = "None";
                    document.getElementById("pronouns_new_val").value = "";
                    document.getElementById("cancel_pronouns").style.display = "None";
                    document.getElementById("save_pronouns").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            }});
            $('#edit_dob').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                    document.getElementById("edit_dob").focus();
                    document.getElementById("dob_edit_div").style.display = "None";
                    document.getElementById("dob_new_val").style.display = "None";
                    document.getElementById("cancel_dob").style.display = "None";
                    document.getElementById("save_dob").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            }});
            $('#edit_disability').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("disability_edit_div").style.display = "Block";
                    document.getElementById("disability_new_val").style.display = "Block";
                    document.getElementById("cancel_disability").style.display = "inline-block";
                    document.getElementById("save_disability").style.display = "inline-block";
                    var text = document.getElementById("disability_replace").innerText;
                    document.getElementById("disability_new_val").value = text.replace("Other Disability: ", "");
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "disability";
                    document.getElementById("disability_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "disability") {
                    document.getElementById("edit_disability").focus();
                    document.getElementById("disability_edit_div").style.display = "None";
                    document.getElementById("disability_new_val").style.display = "None";
                    document.getElementById("disability_new_val").value = "";
                    document.getElementById("cancel_disability").style.display = "None";
                    document.getElementById("save_disability").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";


                } else {
                    alert("Cannot edit more than one field at a time. Please close the " + openfeild + " edit field and try again.")
                }
            }});
            $('#edit_blind').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                    document.getElementById("edit_blind").focus()
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
            }});
            $('#edit_deaf').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if (editstatus == "Not Open") {
                    document.getElementById("deaf_edit_div").style.display = "Block";
                    document.getElementById("deaf_new_val").style.display = "Block";
                    document.getElementById("deaf_new_val_lab").style.display = "Block";
                    document.getElementById("cancel_deaf").style.display = "inline-block";
                    document.getElementById("save_deaf").style.display = "inline-block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Deafblind";
                    document.getElementById("deaf_new_val").focus();
                } else if (editstatus == "Open" && openfeild == "Deafblind") {
                    document.getElementById("edit_deaf").focus()
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
            }});
            $('#edit_gender').once().bind('click keyup', function(event) {

                    if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                            document.getElementById("edit_gender").focus();
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
                    }
                });
            $('#edit_lang_pref').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                        document.getElementById("edit_lang_pref").focus();
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
                }});
            $('#edit_media_pref').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
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
                    document.getElementById("edit_media_pref").focus();
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
            }});
            $('#cancel_media_type').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_media_pref").focus();
                document.getElementById("media_type_edit_div").style.display = "None";
                document.getElementById("media_type_new_val").style.display = "None";
                document.getElementById("cancel_media_type").style.display = "None";
                document.getElementById("save_media_type").style.display = "None";
                document.getElementById("media_type_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            }});
            $('#cancel_dog').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_dog").focus();
                document.getElementById("dog_edit_div").style.display = "None";
                document.getElementById("dog_new_val").style.display = "None";
                document.getElementById("cancel_dog").style.display = "None";
                document.getElementById("save_dog").style.display = "None";
                document.getElementById("dog_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            }});
            $('#cancel_braille').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_braille").focus();
                document.getElementById("braille_edit_div").style.display = "None";
                document.getElementById("braille_new_val").style.display = "None";
                document.getElementById("cancel_braille").style.display = "None";
                document.getElementById("save_braille").style.display = "None";
                document.getElementById("braille_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            }});
            $('#cancel_blind').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_blind").focus();
                document.getElementById("blind_edit_div").style.display = "None";
                document.getElementById("blind_new_val").style.display = "None";
                document.getElementById("cancel_blind").style.display = "None";
                document.getElementById("save_blind").style.display = "None";
                document.getElementById("blind_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            }});
            $('#cancel_deaf').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_deaf").focus();
                document.getElementById("deaf_edit_div").style.display = "None";
                document.getElementById("deaf_new_val").style.display = "None";
                document.getElementById("cancel_deaf").style.display = "None";
                document.getElementById("save_deaf").style.display = "None";
                document.getElementById("deaf_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            }});
            $('#cancel_gender').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_gender").focus();
                document.getElementById("gender_edit_div").style.display = "None";
                document.getElementById("gender_new_val").style.display = "None";
                document.getElementById("cancel_gender").style.display = "None";
                document.getElementById("save_gender").style.display = "None";
                document.getElementById("gender_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            }});
            $('#cancel_lang_pref').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("lang_pref_edit_div").style.display = "None";
                document.getElementById("lang_pref_new_val").style.display = "None";
                document.getElementById("cancel_lang_pref").style.display = "None";
                document.getElementById("save_lang_pref").style.display = "None";
                document.getElementById("lang_pref_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            }});
            $('#cancel_disability').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_disability").focus();
                document.getElementById("disability_edit_div").style.display = "None";
                document.getElementById("disability_new_val").style.display = "None";
                document.getElementById("cancel_disability").style.display = "None";
                document.getElementById("save_disability").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
                document.getElementById("edit_disability").focus();
            }});
            $('#cancel_pronouns').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_pronouns").focus();
                document.getElementById("pronouns_edit_div").style.display = "None";
                document.getElementById("pronouns_new_val").style.display = "None";
                document.getElementById("cancel_pronouns").style.display = "None";
                document.getElementById("save_pronouns").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

            }});
            $('#cancel_dob').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById('edit_dob').focus();
                document.getElementById("dob_edit_div").style.display = "None";
                document.getElementById("dob_new_val").style.display = "None";
                document.getElementById("cancel_dob").style.display = "None";
                document.getElementById("save_dob").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

            }});
            $('#cancel_prim_zip').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById('edit_prim_street').focus();
                document.getElementById("prim_zip_edit_div").style.display = "None";
                document.getElementById("prim_zip_new_val").style.display = "None";
                document.getElementById("prim_zip_new_val_lab").style.display = "None";
                document.getElementById("cancel_prim_zip").style.display = "None";
                document.getElementById("save_prim_zip").style.display = "None";
                document.getElementById("prim_address_2_edit_div").style.display = "None";
                document.getElementById("prim_address_2_new_val").style.display = "None";
                document.getElementById("prim_address_2_new_val_lab").style.display = "None";
                document.getElementById("prim_street_edit_div").style.display = "None";
                document.getElementById("prim_street_new_val").style.display = "None";
                document.getElementById("prim_street_new_val_lab").style.display = "None";
                document.getElementById("prim_city_edit_div").style.display = "None";
                document.getElementById("prim_city_new_val").style.display = "None";
                document.getElementById("prim_city_new_val_lab").style.display = "None";
                document.getElementById("prim_state_edit_div").style.display = "None";
                document.getElementById("prim_state_new_val").style.display = "None";
                document.getElementById("prim_state_new_val_lab").style.display = "None";
                document.getElementById("prim_country_new_val_lab").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

            }});

            $('#cancel_prim_phone').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_prim_phone").focus();
                document.getElementById("prim_phone_edit_div").style.display = "None";
                document.getElementById("prim_phone_new_val").style.display = "None";
                document.getElementById("cancel_prim_phone").style.display = "None";
                document.getElementById("save_prim_phone").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

            }});
            $('#cancel_prim_email').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_prim_email").focus();
                document.getElementById("prim_email_edit_div").style.display = "None";
                document.getElementById("prim_email_new_val").style.display = "None";
                document.getElementById("cancel_prim_email").style.display = "None";
                document.getElementById("save_prim_email").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

            }});
            $('#cancel_l_name').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                document.getElementById("edit_l_name").focus();
                document.getElementById("last_name_edit_div").style.display = "None";
                document.getElementById("l_name_new_val").style.display = "None";
                document.getElementById("cancel_l_name").style.display = "None";
                document.getElementById("save_l_name").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";

            }});
            $('#cancel_f_name').once().bind('click keyup', function(event) {
                if (event.type  == 'click' || (event.type = "keyup" && event.which == 13)) {
                    document.getElementById("edit_f_name").focus();
                    document.getElementById("first_name_edit_div").style.display = "None";
                    document.getElementById("f_name_new_val").style.display = "None";
                    document.getElementById("cancel_f_name").style.display = "None";
                    document.getElementById("save_f_name").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                }
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
                console.log("data "+info);
                if(vfeildarray[1] == "zip")
                {
                    document.getElementById("state_repalce").innerText = "State, Country: "+info[0]+", "+info[1];
                    document.getElementById("prim_state_edit_div").style.display = "None";
                    document.getElementById("prim_state_new_val").style.display = "None";
                    document.getElementById("prim_state_new_val_lab").style.display = "None";
                    document.getElementById("prim_country_new_val_lab").style.display = "None";
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
                    document.getElementById("edit_lang_pref").focus();
                }
                else if(vfeildarray[1] == "gender")
                {
                    document.getElementById("edit_gender").focus();
                    if(info == "Other")
                    {
                        info = "Not Listed";
                    }
                    document.getElementById("gender_change").innerText = "Gender: "+info;
                    document.getElementById("gender_edit_div").style.display = "None";
                    document.getElementById("gender_new_val").style.display = "None";
                    document.getElementById("gender_new_val_lab").style.display = "None";
                    document.getElementById("cancel_gender").style.display = "None";
                    document.getElementById("save_gender").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                }
                else if(vfeildarray[1] == "blind")
                {
                    document.getElementById("edit_blind").focus();
                    document.getElementById("blind_replace").innerText = "Blindness Status: "+info[0];
                    document.getElementById("blind_edit_div").style.display = "None";
                    document.getElementById("blind_new_val").style.display = "None";
                    document.getElementById("blind_new_val_lab").style.display = "None";
                    document.getElementById("cancel_blind").style.display = "None";
                    document.getElementById("save_blind").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";


                }
                else if(vfeildarray[1] == "deaf")
                {
                    document.getElementById("edit_deaf").focus();
                    document.getElementById("deaf_replace").innerText = "Deafblind Status: "+info[0];
                    document.getElementById("deaf_edit_div").style.display = "None";
                    document.getElementById("deaf_new_val").style.display = "None";
                    document.getElementById("deaf_new_val_lab").style.display = "None";
                    document.getElementById("cancel_deaf").style.display = "None";
                    document.getElementById("save_deaf").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                }
                else if(vfeildarray[1]  == "media")
                {
                    document.getElementById("edit_media_pref").focus();
                    document.getElementById("media_replace").innerText = "Media Preference: "+info[0];
                    document.getElementById("media_type_edit_div").style.display = "None";
                    document.getElementById("media_type_new_val").style.display = "None";
                    document.getElementById("media_type_new_val_lab").style.display = "None";
                    document.getElementById("cancel_media_type").style.display = "None";
                    document.getElementById("save_media_type").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                }
                else if(vfeildarray[1]  == "braille")
                {
                    document.getElementById("edit_braille").focus();
                    document.getElementById("braille_replace").innerText = "Braille Reader? "+info[0];
                    document.getElementById("braille_edit_div").style.display = "None";
                    document.getElementById("braille_new_val").style.display = "None";
                    document.getElementById("cancel_braille").style.display = "None";
                    document.getElementById("save_braille").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                }
                else if(vfeildarray[1]  == "dog")
                {
                    document.getElementById("edit_dog").focus();
                    document.getElementById("dog_replace").innerText = "Guide Dog Handler? "+info[0];
                    document.getElementById("dog_edit_div").style.display = "None";
                    document.getElementById("dog_new_val").style.display = "None";
                    document.getElementById("cancel_dog").style.display = "None";
                    document.getElementById("save_dog").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

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
    document.title = "Member: "+document.getElementById("member_name").innerText;
    var header = document.getElementsByClassName("js-quickedit-page-title page-title");
    if(header[0]){
        header[0].innerText = "Member: "+document.getElementById("member_name").innerText;}
    else {   header = document.getElementsByClassName("page-title");
        header[0].innerText ="Member: "+document.getElementById("member_name").innerText;}
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
function replace_old_value(lab_id, new_val)
{
    document.getElementById(lab_id).innerText = new_val;
}
function more_logout_fun()
{
    let get = document.querySelectorAll('[href="/user/logout"]');
    get.forEach(element => add_inner_html(element))
}
function add_inner_html(element)
{
    element.setAttribute("onclick", "return confirm('Are you sure?')");
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
    document.getElementById("prim_address_2_edit_div").style.display = "None";
    document.getElementById("prim_address_2_new_val").style.display = "None";
    document.getElementById("prim_city_edit_div").style.display = "None";
    document.getElementById("prim_city_new_val").style.display = "None";
    document.getElementById("prim_state_edit_div").style.display = "None";
    document.getElementById("prim_state_new_val").style.display = "None";
    document.getElementById("prim_country_new_val").style.display = "None";
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


