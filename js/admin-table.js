(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
                document.getElementById('edit-search-value').style.display = 'none';
                document.getElementById('page_val').style.display = 'none';
                document.getElementById('page_num').style.display = 'none';
                document.getElementsByClassName("form-item js-form-item form-type-textfield js-form-type-textfield form-item-search-value js-form-item-search-value")['0'].style.display = 'none';
                var limiter = document.getElementById('page_val');
                document.getElementById('edit-search-value').value = limiter;
                onload_parser();
                // make sure the limiter matches the previous
            }
            $('#edit-name-filt').once().blur(function ()
            {
                var name = document.getElementById("edit-name-filt").value;
                if(name.indexOf(";") != -1)
                {
                    name = " ";
                    document.getElementById("edit-name-filt").value = name;
                    alert("Invalid Search provided, Semi Colons are not allowed")
                }
                if(name === "")
                {
                    name = " ";
                }
                var page = 1;
                var email = document.getElementById("edit-email-filt").value;
                if(email === "")
                {
                    email = " ";
                }
                var status = document.getElementById("edit-status-filt").value;
                if(status === "")
                {
                    status = " ";
                }
                var sort = document.getElementById("edit-sort-field").value;
                if(sort === "")
                {
                    sort = "rid";
                }
                document.getElementById("edit-search-value").value  = page+"&%"+name+"&%"+email+"&%"+status+"&%"+sort;
                document.getElementById("page_val").innerText = page+"&%"+name+"&%"+email+"&%"+status+"&%"+sort;
            });
            $('#edit-email-filt').once().blur(function ()
            {
                var email = document.getElementById("edit-email-filt").value;
                if(email.indexOf(";") != -1)
                {
                    email = " ";
                    document.getElementById("edit-email-filt").value = email;
                    alert("Invalid Search provided, Semi Colons are not allowed")
                }
                if(email === "")
                {
                    email = " ";
                }
                var page = 1;
                var name = document.getElementById("edit-name-filt").value;
                if(name === "")
                {
                    name = " ";
                }
                var status = document.getElementById("edit-status-filt").value;
                if(status === "")
                {
                    status = " ";
                }
                var sort = document.getElementById("edit-sort-field").value;
                if(sort === "")
                {
                    sort = "rid";
                }
                document.getElementById("edit-search-value").value  = page+"&%"+name+"&%"+email+"&%"+status+"&%"+sort;
                document.getElementById("page_val").innerText = page+"&%"+name+"&%"+email+"&%"+status+"&%"+sort;
            });
            $('#edit-status-filt').once().blur(function ()
            {
                var status = document.getElementById("edit-status-filt").value;
                if(status === "")
                {
                    status = " ";
                }
                var page = 1;
                var email = document.getElementById("edit-email-filt").value;
                if(email === "")
                {
                    email = " ";
                }
                var name = document.getElementById("edit-name-filt").value;
                if(name === "")
                {
                    name = " ";
                }
                var sort = document.getElementById("edit-sort-field").value;
                if(sort === "")
                {
                    sort = "rid";
                }
                document.getElementById("edit-search-value").value  = page+"&%"+name+"&%"+email+"&%"+status+"&%"+sort;
                document.getElementById("page_val").innerText = page+"&%"+name+"&%"+email+"&%"+status+"&%"+sort;
            });
            $('#clear-filter').once().click(function (){
                document.getElementById("edit-name-filt").value = " ";
                document.getElementById("edit-email-filt").value = " ";
                document.getElementById("edit-status-filt").value = "";
                document.getElementById("edit-sort-field").value = "";
                document.getElementById("page_val").innerText = "1&% &% &% &%";
            });
            $('#edit-sort-field').once().blur(function ()
            {
                var sort = document.getElementById("edit-sort-field").value;
                if(sort === "")
                {
                    sort = "rid";
                }
                var status = document.getElementById("edit-status-filt").value;
                if(status === "")
                {
                    status = " ";
                }
                var page = 1;
                var email = document.getElementById("edit-email-filt").value;
                if(email === "")
                {
                    email = " ";
                }
                var name = document.getElementById("edit-name-filt").value;
                if(name === "")
                {
                    name = " ";
                }
                document.getElementById("edit-search-value").value  = page+"&%"+name+"&%"+email+"&%"+status+"&%"+sort;
                document.getElementById("page_val").innerText = page+"&%"+name+"&%"+email+"&%"+status+"&%"+sort;
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
    document.getElementById("edit-sort-field").value = vals[4];
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
    new_end = new_end + 2;
    var  limiter  = new_limiter.substr(new_end, 200);
    var end = limiter.indexOf("%&");
    var sort = limiter.substr(new_end, end);
    var array = [page, name, email, status, sort];
    return array;
}

