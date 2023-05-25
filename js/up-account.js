(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
           var uname = document.getElementById("yoshi").innerText;
           document.getElementById("edit-change-username").value = uname;
                replace_title()
            }
        }
    }
})(jQuery, Drupal);
function replace_title()
{
    document.title = "Member: "+document.getElementById("member_name").innerText;
    var header = document.getElementsByClassName("js-quickedit-page-title page-title");
    if(header[0]){
        header[0].innerText = "Member: "+document.getElementById("member_name").innerText;}
    else {   header = document.getElementsByClassName("page-title");
        header[0].innerText = "Member: "+document.getElementById("member_name").innerText;}
}