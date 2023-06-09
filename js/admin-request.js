(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
                document.getElementById('email_val').style.display = 'none';

            }
        }
    }})(jQuery, Drupal);