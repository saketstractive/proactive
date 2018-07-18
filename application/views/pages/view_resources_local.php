<script type="text/javascript">
        $(document).on("ready", function () {
        	$(".btn-delete").on("click", function(){
        		if (confirm("Are you sure you want to delete this resource?")) {
        			var res_id = $(this).attr("data-id");
                $.post(site_url+'user/delete_resource', {"res_id":res_id}, function(response) {
                    if(parseInt(response) > 0)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.success('One Resource Deleted!');
                        $("#row"+res_id).remove();
                    }
                    else{
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No data deleted.'); 
                    }
                 });
        		}
        		return false;
        	});
        });

      </script>