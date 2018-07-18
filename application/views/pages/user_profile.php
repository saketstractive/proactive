<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<!-- <li><a href="#">Home</a></li>
		  	<li><a href="#">Library</a></li> -->
		  	<li><a href="<?php echo site_url('user/'); ?>"><i class="fa fa-home"></i> User Home</a></li>
		  	<li class="active">Profile</li>
		</ol>

	</div>

</div>

<div class="row">

	<div class="col-lg-8">

		<div class="panel panel-default">
				<div class="panel-heading">
						Edit Profile
				</div>
		  	<div class="panel-body">

						<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label>Full Name</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-fullname"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="fullname"></div>
									</div>

									<div class="form-group">
										<label>Email</label>
										<div id="email"></div>
										<!-- <p class="lead">mukesh@gmail.com <span class="edit-link text-muted"><i>you cannot edit your email address</i></span></p> -->
									</div>

									<div class="form-group">
										<label>Contact</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-contact"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="contact"></div>
										<!-- <p class="lead">9876543210 <a href="#" class="no_anchor_decoration edit-link">edit</a></p> -->
									</div>

									<div class="form-group">
										<label>Address</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-address"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="address"></div>
									</div>

									<div class="form-group">
										<label>Stream</label>&nbsp;<!--<button type="button" class="btn btn-primary btn-xs" id="edit-stream"><i class="fa fa-pencil-square"></i> Edit</button>-->
										<div id="user_stream"></div>
										<!-- <p class="lead">CMA <a href="#" class="no_anchor_decoration edit-link">edit</a></p> -->
									</div>

									<!-- <div class="form-group">
										<label>Qualification</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-qualification"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="qualification"></div>
									</div>

									<div class="form-group">
										<label>Address</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-address"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="address"></div>
									</div>

									<div class="form-group">
										<label>City</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-city"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="city"></div>
									</div>

									<div class="form-group">
										<label>District</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-district"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="district"></div>
									</div>

									<div class="form-group">
										<label>State</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-state"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="state"></div>
									</div>

									<div class="form-group">
										<label>Date of Birth</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-dob"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="dob"></div>
									</div>

									<div class="form-group">
										<label>Gender</label>&nbsp;<button type="button" class="btn btn-primary btn-xs" id="edit-gender"><i class="fa fa-pencil-square"></i> Edit</button>
										<div id="gender"></div>
									</div> -->
								</div>
						</div>

		  	</div>
		</div>

	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
				<div class="panel-heading">
						Change Password
				</div>
		  	<div class="panel-body">
						<div class="form-group">
							<div id="password_container">
								<label>Password</label>
								<p class="lead">********** <button class="btn btn-primary btn-sm" id="change_password_link"><i class="fa fa-pencil-square"></i> Edit</button></p>
							</div>
						</div>

						<div class="form-group">
							<div id="new_password_container">
								<div class="m-b-10">
									<label>New Password</label>
									<input type="password" class="form-control" name="new_password" id="new_password" />
								</div>

								<div class="m-b-10">
									<label>Confirm Password</label>
									<input type="password" class="form-control" name="confirm_password" id="confirm_password" />
								</div>

								<button type="button" id="btnChangePassword" class="btn btn-primary"><i class="fa fa-refresh"></i> Change Password</button>
								<button type="button" id="change_password_cancel_link" class="btn btn-default"><i class="fa fa-close"></i> Cancel</button>
							</div>
						</div>
				</div>
		</div>

		<div class="m-b-10"></div>
		<div class="text-center m-b-10">
			<img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" />
		</div>

		<div class="text-center m-b-10">
			<img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" />
		</div>
	</div>

</div>

<script type="text/javascript">
		var site_url = "<?php echo site_url(); ?>";
		var base_url = "<?php echo base_url(); ?>";
		var val_id = "<?php echo $this->session->userdata('uid'); ?>";

		<?php
		if ($this->session->userdata('message')) 
		{
			?>
			var message = "<?= $this->session->userdata('message')?>"
			 toastr.options.timeOut = 5000;
             toastr.options.positionClass = "toast-top-center";
             toastr.error(message);
		<?php 
			$this->session->unset_userdata('message'); //clear session
			}	?>
</script>



<script type="text/javascript" src="<?php echo base_url("assets/js/app.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/scripts/profile.js"); ?>"></script>
