(function ($, Drupal) {
    Drupal.behaviors.up_main = {
        attach: function (context, settings) {
            window.onload = function () {
            }
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

