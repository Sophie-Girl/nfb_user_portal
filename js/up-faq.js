(function ($, Drupal) {
    Drupal.behaviors.up_faq = {
        attach: function (context, settings) {
            window.onload = function () {
                replace_title();
                more_logout_fun();
            }
        }
    }
})(jQuery, Drupal);
function more_logout_fun()
{
    let get = document.querySelectorAll('[href="/user/logout"]');
    get.forEach(element => add_inner_html(element))
}
function add_inner_html(element)
{
    element.setAttribute("onclick", "return confirm('Are you sure?')");
}
function replace_title()
{
    document.title = "Member: "+document.getElementById("member_name").innerText;
    var header = document.getElementsByClassName("js-quickedit-page-title page-title");
    if(header[0]){
        header[0].innerText = "Member: "+document.getElementById("member_name").innerText;}
    else {   header = document.getElementsByClassName("page-title");
        header[0].innerText = "Member: "+document.getElementById("member_name").innerText;}
}