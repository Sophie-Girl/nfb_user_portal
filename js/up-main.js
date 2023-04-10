(function ($, Drupal) {
    Drupal.behaviors.up_main = {
        attach: function (context, settings) {
            window.onload = function () {
                hide_user_id();
            }
            $('#save-prim-phone').once().onclick(function ()
            {
                var vfeildarray;
                var feild_data = document.getElementById('prim_phone_new_val').value;
                if(feild_data == "")
                {
                    vfeildarray = "not_run";
                }
                else {
                    vfeildarray[0] = "phone";
                    vfeildarray[1] =  document.getElementById('civi_id_val').innerText;
                    vfeildarray[2] = document.getElementById('prim_phone_new_val').value
                    ajax_change_call(vfeildarray);
                }
            });
            $('#save-prim-email').once().onclick(function ()
            {
                var vfeildarray;
                var feild_data = document.getElementById('prim_phone_new_val').value;
                if(feild_data == "")
                {
                    vfeildarray = "not_run";
                }
                else {
                    vfeildarray[0] = "email";
                    vfeildarray[1] =  document.getElementById('civi_id_val').innerText;
                    vfeildarray[2] = document.getElementById('prim_email_new_val').value
                    ajax_change_call(vfeildarray);
                }
            });
            $('#save-f_name').once().onclick(function ()
            {
                var vfeildarray;
                var feild_data = document.getElementById('f_name_new_val').value;
                if(feild_data == "")
                {
                    vfeildarray = "not_run";
                }
                else {
                    vfeildarray[0] = "f_name";
                    vfeildarray[1] =  document.getElementById('civi_id_val').innerText;
                    vfeildarray[2] = document.getElementById('f_name_new_val').value
                    ajax_change_call(vfeildarray);
                }
            });
            $('#save-l-name').once().onclick(function ()
            {
                var vfeildarray;
                var feild_data = document.getElementById('l_name_new_val').value;
                if(feild_data == "")
                {
                    vfeildarray = "not_run";
                }
                else {
                    vfeildarray[0] = "l_name";
                    vfeildarray[1] =  document.getElementById('civi_id_val').innerText;
                    vfeildarray[2] = document.getElementById('l_name_new_val').value
                    ajax_change_call(vfeildarray);
                }
            });
            $('#edit_f_name').once().onclick(function ()
            {
              var editstatus = document.getElementById("edit_open").innerText;
              var openfeild = document.getElementById("open_field").innerText;
              if(editstatus == "Not Open")
              {
                  document.getElementById("first_name_edit_div").style.display = "Block";
                  document.getElementById("edit_open").innerText = "Open";
                  document.getElementById("open_field").innerText = "First Name";
              }
              else if( editstatus == "Open" && openfeild == "First Name")
              {
                  document.getElementById("first_name_edit_div").style.display = "None";
                  document.getElementById("edit_open").innerText = "Not Open";
                  document.getElementById("open_field").innerText = "None";
              }
              else{
                  alert("Cannot edit more than one field at a time. Please close the "+ openfeild +" edit field and try again.")
              }
            });
            $('#edit_l_name').once().onclick(function ()
            {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if(editstatus == "Not Open")
                {
                    document.getElementById("last_name_edit_div").style.display = "Block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Last Name";
                }
                else if( editstatus == "Open" && openfeild == "Last Name")
                {
                    document.getElementById("last_name_edit_div").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                }
                else{
                    alert("Cannot edit more than one field at a time. Please close the "+ openfeild +" edit field and try again.")
                }
            });
            $('#edit_prim_email').once().onclick(function ()
            {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if(editstatus == "Not Open")
                {
                    document.getElementById("prim_email_edit_div").style.display = "Block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Prime Email";
                }
                else if( editstatus == "Open" && openfeild == "Prime Email")
                {
                    document.getElementById("prim_email_edit_div").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";
                }
                else{
                    alert("Cannot edit more than one field at a time. Please close the "+ openfeild +" edit field and try again.")
                }
            });
            $('#edit_prim_phone').once().onclick(function ()
            {
                var editstatus = document.getElementById("edit_open").innerText;
                var openfeild = document.getElementById("open_field").innerText;
                if(editstatus == "Not Open")
                {
                    document.getElementById("prim_phone_edit_div").style.display = "Block";
                    document.getElementById("edit_open").innerText = "Open";
                    document.getElementById("open_field").innerText = "Prime Phone";
                }
                else if( editstatus == "Open" && openfeild == "Prime Phone")
                {
                    document.getElementById("prim_phone_edit_div").style.display = "None";
                    document.getElementById("edit_open").innerText = "Not Open";
                    document.getElementById("open_field").innerText = "None";

                }
                else{
                    alert("Cannot edit more than one field at a time. Please close the "+ openfeild +" edit field and try again.")
                }                    document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_phone').once().onclick(function () {
                document.getElementById("prim_phone_edit_div").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_prim_email').once().onclick(function () {
                document.getElementById("prim_email_edit_div").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_last_name').once().onclick(function () {
                document.getElementById("last_name_edit_div").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
            $('#cancel_first_name').once().onclick(function () {
                document.getElementById("first_name_edit_div").style.display = "None";
                document.getElementById("edit_open").innerText = "Not Open";
                document.getElementById("open_field").innerText = "None";
            });
        }

    }
    function ajax_change_call(vfeildarray)
    {
        if(vefeildarray == "no-run"){
        $.ajax({
            type: 'POST',
            url: '/nfb_member_portal/ajax/change',
            data: { feildarray:vfeildarray },
        }).done(function (data) {});
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
function replace_title(f_name, l_name)
{
    document.title = f_name+ " " + l_name;
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
    document.getElementById("last_name_edit_div").style.display = "None";
    document.getElementById("prim_email_edit_div").style.display = "None";
    document.getElementById("prim_phone_edit_div").style.display = "None";
}





