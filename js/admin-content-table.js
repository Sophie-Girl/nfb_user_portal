(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
                // this is where hiding the filter value will go
            }
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
    var title = document.getElementById("edit-title-filt").value;
    var active = document.getElementById("edit-active-filt").value;
    make_filt_val(type, title, active);
}