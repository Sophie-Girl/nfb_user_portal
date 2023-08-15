(function ($, Drupal) {
    Drupal.behaviors.up_other = {
        attach: function (context, settings) {
            window.onload = function () {
                document.getElementById('edit-content-value').style.display = "none";
                if(document.getElementById('edit-content-value').value != "new"){
                    document.getElementById('edit-markup-type').value = document.getElementById('mk_type').innerText;
                    document.getElementById('edit-markup-title').value = document.getElementById('title_val').innerText;
                    document.getElementById('edit-limited-by').value = document.getElementById('limit_val').innerText;
                    if(document.getElementById('limit_val').innerText == "Event"  ||
                        document.getElementById('limit_val').innerText == "Contact Type" ||
                        document.getElementById('limit_val').innerText == "Group" ||
                        document.getElementById('limit_val').innerText == "MembershipType" )
                    {
                        document.getElementById('edit-limited-by').value = "civi_entity";
                        document.getElementById('edit-civi-entity').value = document.getElementById('civi_ent').innerText;
                        document.getElementById('edit-civi-entity-value').value = document.getElementById('civi_value').innerText;
                    }
                    else {
                        document.getElementById('edit-limited-by').value = document.getElementById('limit_val').innerText;
                        document.getElementById('edit-civi-entity').value = "";
                        document.getElementById('edit-civi-entity-value').value = "";
                    }
                    document.getElementById('edit-tab').value = document.getElementById('tab_val').innerText;
                    if(document.getElementById('mk_type').innerText === "member_benefit")
                    {
                        var  start = document.getElementById('start_val').innerText;
                        var start_year = start.substr(0,4);
                        var start_month = start.substr(5,2);
                        if(start_month == "01")
                        {
                            start_month = "1";
                        }
                        else if(start_month == "02")
                        {
                            start_month = "2";
                        }
                        else if(start_month == "03")
                        {
                            start_month = "3";
                        }
                        else if(start_month == "04")
                        {
                            start_month = "4";
                        }
                        else if(start_month == "05")
                        {
                            start_month = "5";
                        }
                        else if(start_month == "06")
                        {
                            start_month = "6";
                        }
                        else if(start_month == "07")
                        {
                            start_month = "7";
                        }
                        else if(start_month == "08")
                        {
                            start_month = "8";
                        }
                        else if(start_month == "09")
                        {
                            start_month = "9";
                        }
                        console.log(start_month);
                        var start_day = start.substr(8, 2);
                        if(start_day == "01")
                        {
                            start_day = "1";
                        }
                        else if(start_day == "02")
                        {
                            start_day = "2";
                        }
                        else if(start_day == "03")
                        {
                            start_day = "3";
                        }
                        else if(start_day == "04")
                        {
                            start_day = "4";
                        }
                        else if(start_day == "05")
                        {
                            start_day = "5";
                        }
                        else if(start_day == "06")
                        {
                            start_day = "6";
                        }
                        else if(start_day == "07")
                        {
                            start_day = "7";
                        }
                        else if(start_day == "08")
                        {
                            start_day = "8";
                        }
                        else if(start_day == "09")
                        {
                            start_day = "9";
                        }
                        document.getElementById('edit-start-date-year').value = start_year;
                        document.getElementById('edit-start-date-month').value = start_month;
                        document.getElementById('edit-start-date-day').value = start_day;
                        document.getElementById('edit-end-date').value = document.getElementById('end_val').innerText;
                    }
                    if(document.getElementById('mk_type').innerText == "faq")
                    {
                        document.getElementById("edit-faq-grouping").value = document.getElementById('gpf_val').innerText
                    }
                    if(document.getElementById('mk_type').innerText == "member_benefit")
                    {
                        document.getElementById("edit-benefit-group").value = document.getElementById('bgp_val').innerText
                    }
                    document.getElementById('edit-active').value = document.getElementById('act_val').innerText;
                    document.getElementById('edit-weight').value = document.getElementById('weight_val').innerText;
                    document.getElementById('edit-permanent').value = document.getElementById("perm_val").innerText;
                }

            }
        }
    }})(jQuery, Drupal);