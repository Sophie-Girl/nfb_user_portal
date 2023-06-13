(function ($, Drupal) {
    Drupal.behaviors.admin_template = {
        attach: function (context, settings) {
            window.onload = function () {
                document.getElementById("completed").style.display = "none";
                document.getElementById("u_name").style.display = "none";
                document.getElementById("pass").style.display = "none";
                document.getElementById("edit-completed-temp").value = document.getElementById("completed").innerText;
                document.getElementById("edit-user-name").value = document.getElementById("u_name").innerText;
                document.getElementById("edit-password-change").value = document.getElementById("pass").innerText;
            }
        }
    }})(jQuery, Drupal);