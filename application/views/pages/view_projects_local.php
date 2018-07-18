      <script type="text/javascript">
        $(document).on("ready", function () {

        	$("#close-info").hide();
        	$("#extra-table").hide();
        	$("#close-info").on("click", function () {
        		$("#list-projects").show();
        		$("#close-info").hide();
        		$("#extra-table").hide();
        		$(".project-info").hide();
        		$("#page_head").text("List");
        	});

        	$(".eye").on("click", function () { //additional class implemented after close chip and seperate info table
        		$("#list-projects").hide();
        		$("#close-info").show();
        		$("#extra-table").show();
        		$("#page_head").text("Description");
        	})

        	$(".btn-delete").on("click", function(){
        		if (confirm("Are you sure you want to delete this project?")) {
        			var pro_id = $(this).attr("data-id");
                $.post(site_url+'user/delete_project', {"pro_id":pro_id}, function(response) {
                    if(parseInt(response) > 0)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.success('One Project Deleted!');
                        $("#row"+pro_id).remove();
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