(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
                document.getElementById('edit-email').value = document.getElementById('default_email').innerText;
                document.getElementById('edit-pass-along').style.display = "none";
                document.getElementById('edit-rid').style.display = "none";

            }
        }
    }
})(jQuery, Drupal);