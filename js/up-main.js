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


        }

    }
    function ajax_change_call(vfeildarray)
    {
        if(vefeildarray == "no-run"){
        $.ajax({
            type: 'POST',
            url: '/nfb_washington/admin/ajax/committee',
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





