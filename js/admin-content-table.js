(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
               document.getElementById("edit-filter-val").style.display = "none";
               document.getElementsByClassName("form-item js-form-item form-type-textfield js-form-type-textfield form-item-filter-val js-form-item-filter-val")['0'].style.display = "none";
            }
            $('#edit-ajax-button').once().click(function ()
            {
               alert("Changes made to results table");
                document.getElementById("edit-title-filt").value;
            });
            $('#clear-filter').once().click(function ()
            {
                document.getElementById("edit-title-filt").value = "";
                document.getElementById("edit-type-filt").value = "";
                document.getElementById("edit-active-filt").value = "";
                set_vals();
            });
            $('#edit-type-filt').once().blur(function () {
                set_vals();
            });
            $('#edit-title-filt').once().blur(function () {
                set_vals();
            });
            $('#edit-active-filt').once().blur(function () {
                set_vals();
            });


        }
    }
})(jQuery, Drupal);
function make_filt_val (type, title, active){
    var string = type+"&%"+title+"&%"+active;
    document.getElementById("edit-filter-val").value = string;
}
function set_vals()
{
    var type = document.getElementById("edit-type-filt").value;
    if(type == "")
    {type = " ";}
    var title = document.getElementById("edit-title-filt").value;
    if(title == "")
    {title = " ";}
    var active = document.getElementById("edit-active-filt").value;
    if(active == "")
    {active = " ";}
    make_filt_val(type, title, active);
}