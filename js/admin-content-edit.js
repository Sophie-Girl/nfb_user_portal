(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
                document.getElementById('edit-pass-along').style.display = "none";
                document.getElementById('edit-content-value').style.display = "none";

            }
        }
    }})(jQuery, Drupal);