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
                    if(document.getElementById('mk_type').innerText == "member_benefit")
                    {
                        document.getElementById('edit-start-date').value = document.getElementById('start_val').innerText;
                        document.getElementById('edit-end-date').value = document.getElementById('end_val').innerText;
                    }
                    document.getElementById('edit-active').value = document.getElementById('act_val').innerText;
                    document.getElementById('edit-weight').value = document.getElementById('weight_val').innerText;
                    document.getElementById('edit-permanent').value = document.getElementById("perm_val").innerText;
                }

            }
        }
    }})(jQuery, Drupal);