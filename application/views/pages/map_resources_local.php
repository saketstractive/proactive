      <script type="text/javascript">
        $(document).on("ready", function () {
        $("#btn_save_resource").hide();
        $("#btn_remove_entry").hide();
        $("#table-append").hide();

        $(".del-exist").on("click", function(){
            var dataid = $(this).attr("data-id");
            if (confirm("This is irreversible operation. Are you sure?")) {
              $.post(site_url+'user/delete_mapping', {"prore_id":dataid}, function(response) {
                    if(parseInt(response) == 1)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.success('One Resource deleted from project!');
                          $("#tr"+dataid).remove();
                    }
                    else{
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No data deleted.'); 
                    }
                    // $("#btn-update-timesheet").attr("disabled",false);
                 });
              }
                  return false;
              });
        $("#btn_remove_entry").on("click", function () {
          $(".del-new:last").click();
          return false;
        });

        $("#btn_add_resource").on("click", function () {
        $("#table-append").show();
        $("#btn_save_resource").show();
        $("#btn_remove_entry").show();
        
          var add_id = $("#table-append tr").length; // as heading is 1 and number also start from 1. No adjustment needed
            $("#table-append").append("<tr><td><select name='resource"+add_id+"' class='validate'><?= $resources ?></select></td> <td><input type='number' min='1' class='validate' name='days"+add_id+"' /> </td> <td><select class='validate' name='type"+add_id+"'><option>On-site</option><option>Offshore</option></select></td><td><select name='approve"+add_id+"'><option selected='selected' value='0'>No</option><option value='1'>Yes</option></select></td><td class='hide'><h5><a class='red-text'><i class='fa fa-trash del-new'></i></a></h5></td></tr>");
            
            $(".del-new").on("click", function(){
                $(this).parent().parent().parent().parent().remove();
                if ($("#table-append tr").length == 1) {
                  $("#table-append").hide();
                  $("#btn_save_resource").hide();
                  $("#btn_remove_entry").hide();
                }
                  return false;
              });
            $('select').material_select();
            return false;
          });

        $("#btn_save_resource").on("click", function () {
          $.post(site_url+'user/add_mapping', $("#formAddMap").serialize(), function(response) {
                    if(parseInt(response) > 0)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.success('Resource/s mapped to project!');
                         $("#table-append").hide();
                         $("table").html("<h5 class='red-text'>Refreshing data....</h5>");
                          setInterval(function(){ window.location = site_url+'user/map_resources' }, 1000);
                    }
                    else{
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No data added. Please fill up the details carefully.'); 
                    }
                 });
          return false;
        });

        }); // end of ready

      </script>