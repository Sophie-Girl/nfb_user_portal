(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
                document.getElementById('edit-search-value').style.display = 'none';
                document.getElementsByClassName("webform-readonly form-item js-form-item form-type-textfield js-form-type-textfield form-item-search-value js-form-item-search-value")['0'].style.display = 'none';
                var limiter = document.getElementById('page_val');
                document.getElementById('edit-search-value').value = limiter;
                onload_parser();
                // make sure the limiter matches the previous
            }
            $('#edit-name-filt').once().blur(function ()
            {
                var name = document.getElementById("edit-name-filt").value;
                var page = 1;
                var email = document.getElementById("edit-email-filt").value;
                var status = document.getElementById("edit-status-filt").value;
                document.getElementById("edit-search-value").value  = page+"&%"+name+"&%"+"&%"+email+"&%"+status;
            });
            $('#edit-email-filt').once().blur(function ()
            {
                var email = document.getElementById("edit-email-filt").value;
                var page = 1;
                var name = document.getElementById("edit-name-filt").value;
                var status = document.getElementById("edit-status-filt").value;
                document.getElementById("edit-search-value").value  = page+"&%"+name+"&%"+"&%"+email+"&%"+status;
            });
            $('#edit-status-filt').once().blur(function ()
            {
                var status = document.getElementById("edit-status-filt").value;
                var page = 1;
                var email = document.getElementById("edit-email-filt").value;
                var name = document.getElementById("edit-name-filt").value;
                document.getElementById("edit-search-value").value  = page+"&%"+name+"&%"+"&%"+email+"&%"+status;
            });
        }
    }
})(jQuery, Drupal);
function onload_parser()
{
    var limiter = document.getElementById("page_val").innerText;
    var vals =  parse_limiter_form_fields(limiter);
    document.getElementById("edit-name-filt").value = vals[1];
    document.getElementById("page_num").value = vals[0];
    document.getElementById("edit-email-filt").value = vals[2];
    document.getElementById("edit-status-filt").value = vals[3];
}
function compile_string()
{
    var page = 1;
    var name = document.getElementById("edit-name-filt").value;
    var email = document.getElementById("edit-email-filt").value;
    var status = document.getElementById("edit-status-filt").value;
    var filter_text = page+"&%"+name+"&%"+email+"&%"+status;
    document.getElementById("edit-search-value").value = filter_text;
}
function parse_string_for_link(limiter)
{

   limiter =  limiter.replace(" ", "%20");
    limiter =  limiter.replace( "&", "%26");
    limiter =  limiter.replace( "%", "%25");
    limiter =  limiter.replace( "#", "%23");
    limiter =  limiter.replace( "@", "%40");
    limiter =  limiter.replace( ".", "%2E");
    limiter =  limiter.replace( "/", "%2F");
    return limiter;
}
function parse_limiter_form_fields(limiter)
{
  var  end = limiter.indexOf("%&");
   var page = limiter.substr(0, end);
   end = end  + 2;
    var new_limiter  = limiter.substr(end, 200);
   var new_end   = new_limiter.indexOf("%&");
   var name =  limiter.substr(end, new_end);
   new_end = new_end + 2;
    var limiter  = new_limiter.substr(new_end, 200);
     end   = limiter.indexOf("%&");
    var email = limiter.substr(new_end, end);
    end = end + 2;
    var new_limiter = limiter.substr(end, 200);
    var new_end = new_limiter.indexOf("%&");
    var status = new_limiter.substr(end, new_end);
    var array = [page, name, email, status];
    return array;
}

