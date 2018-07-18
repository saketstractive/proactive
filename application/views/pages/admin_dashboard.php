<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<!-- <li><a href="#">Home</a></li>
		  	<li><a href="#">Library</a></li> -->
		  	<li class="active"><i class="fa fa-home"></i> Dashboard</li>
		</ol>

	</div>

</div>

<!-- <div class="row">

	<div class="col-md-12">

		<div class="panel panel-default">

		</div>

	</div>

</div> -->

<div class="row">

	<div class="col-lg-8">

		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Publish News</h3>
		  	</div>
		  	<div class="panel-body">
		  		<div class="form-group">
				    <label>News Title</label>
				    <input type="text" class="form-control" id="news_title" name="news_title" autofocus>
				</div>

				<div class="form-group">
				    <label>Description</label>
				    <textarea id="news_desc" name="news_desc" class="form-control"></textarea>
				</div>

				<div class="form-group">
				    <button class="btn btn-primary" id="btnPublishNews">Publish</button>
				</div>
		  	</div>
		</div>

	</div>

	<div class="col-lg-4">

		<div class="panel panel-default">
			<div class="panel-body">
		  		<p class="text-center">
		  			Want to change your password?
		  		</p>
		  		<div class="text-center">
		  			<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatePasswordModal">
					  	Change
					</button>
		  		</div>
		  	</div>
		</div>

		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Recently Published News</h3>
		  	</div>
		  	<div class="panel-body">
		  		<div id="published_news"></div>
		  	</div>
		  	<div class="panel-footer">
		  		<a href="<?php echo site_url('admin/news'); ?>">Click here to view all news...</a>
		  	</div>
		</div>

	</div>

</div>


<!-- Modal -->
<div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="updatePasswordLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="updatePasswordLabel">Change your password</h4>
      		</div>

	      	<div class="modal-body">

	      		<!-- <div class="form-group">
                  	<label>Old Password</label>
                  	<input type="password" class="form-control" name="old_password" id="old_password" placeholder="Your Current Password" required>
              	</div> -->

	      		<div class="form-group">
                  	<label>New Password</label>
                  	<input type="password" class="form-control" name="password" id="password" placeholder="Your New Password" required>
              	</div>

              	<div class="form-group">
                  	<label>Confirm Password</label>
                  	<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Rewrite Your New Password" required>
              	</div>

              	<div class="row" style="margin-top:15px;">
                  	<div class="col-md-12" id="message"></div>
              	</div>

	      	</div>

	      	<div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="btnChangePassword">Change Password</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
  	</div>
</div>


<script type="text/javascript">

		var site_url = "<?php echo site_url(); ?>";
		var base_url = "<?php echo base_url(); ?>";

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/news_script.js'); ?>"></script>

<script type="text/javascript">


	$(document).ready(function() {
		load_news("#published_news");
	});

	$("#btnChangePassword").click(function() {

		// var old_password = $("#old_password").val();
		var id = "<?php echo $this->session->userdata('id'); ?>";
		var password = $("#password").val();
		var confirm_password = $("#confirm_password").val();

		if (password != "" && confirm_password != "") {

			if (password == confirm_password) {

				$.ajax({
		            url: "<?php echo site_url('admin/change_password'); ?>",
		            type: "POST",
		            dataType: "text",
		            data: {"id": id, "password": password},
		            beforeSend: function() {
		            	// $("#message").empty();
		            },
		            success: function(response) {
		            	// console.log(response);
		             //    $("#message").html(response);
		             	if (response == 1) {

		             		toastr.options.timeOut = 5000;
										toastr.options.positionClass = "toast-bottom-right";
										toastr.success("Password changed.");

		             	} else if (response == 0) {

		             		toastr.options.timeOut = 5000;
										toastr.options.positionClass = "toast-bottom-right";
										toastr.error("Error Occurred. Please try again later.");

		             	}

		            },
		            error: function(error) {
		                console.log(error);
		            }
		        });

			} else {
				toastr.options.timeOut = 5000;
				toastr.options.positionClass = "toast-bottom-right";
				toastr.warning("Both new password and confirm password must be same.");
				// $("#message").html('<div class="alert alert-warning" role="alert"><i class="fa fa-exclamation-circle"></i> </div>');
			}

		} else {
			toastr.options.timeOut = 5000;
			toastr.options.positionClass = "toast-bottom-right";
			toastr.warning("All fields are mandatory.");
			// $("#message").html('<div class="alert alert-warning" role="alert"><i class="fa fa-exclamation-circle"></i> All fields are mandatory.</div>');
		}


	});


	$('#updatePasswordModal').on('hidden.bs.modal', function (e) {
	  	$("#password").val("");
	  	$("#confirm_password").val("");
	  	// $("#message").empty();
	});

</script>
