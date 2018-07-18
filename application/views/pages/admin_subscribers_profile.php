<div class="row">

  <div class="col-lg-12">

    <ol class="breadcrumb white-bg">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('admin/subscribers'); ?>" class="no_anchor_decoration"> Subscribers</a></li>
        <li class="active">Subscribers Profile</li>
    </ol>

  </div>

</div>

<?php

    foreach ($user_data as $value) {
      $fullname = $value["fullname"];
      $email = $value["email"];
      $contact = $value["contact"];
      $city = $value["city"];
      $state = $value["state"];
      $user_stream = $value["stream_name"];
      $is_verified = $value["is_verified"];
      $created_on = $value["created_on"];
    }

?>

<div class="row">

	<div class="col-lg-8">

		<div class="panel panel-default">
				<div class="panel-heading">
						Subscribers Profile
				</div>
		  	<div class="panel-body">

						<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label>Full Name</label>
										<div id="fullname"><?php echo $fullname; ?></div>
									</div>

									<div class="form-group">
										<label>Email</label>
										<div id="email"><?php echo $email; ?></div>
									</div>

									<div class="form-group">
										<label>Contact</label>
										<div id="contact"><?php echo $contact; ?></div>
									</div>

                  <div class="form-group">
										<label>City</label>
										<div id="city"><?php echo $city == "" ? "<span class='text-muted'>not available</span>" : $city; ?></div>
									</div>

                  <div class="form-group">
										<label>State</label>
										<div id="state"><?php echo $state == "" ? "<span class='text-muted'>not available</span>" : $state; ?></div>
									</div>

									<div class="form-group">
										<label>Stream</label>
										<div id="user_stream"><?php echo $user_stream; ?></div>
									</div>

                  <div class="form-group">
										<label>Is Verified?</label>
										<div id="verification_status"><?php echo $is_verified == 0 ? "Not Verified" : "Verified"; ?></div>
									</div>

                  <div class="form-group">
										<label>Account created on</label>
										<div id="created_on"><?php echo $created_on; ?></div>
									</div>

								</div>
						</div>

		  	</div>
		</div>

	</div>

	<div class="col-lg-4">
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
</script>

<script type="text/javascript" src="<?php echo base_url("assets/js/app.js"); ?>"></script>
<script type="text/javascript">
    // var stream_id = "<?php echo $user_stream; ?>";
    // load_stream_by_id("#stream", stream_id);
</script>
