<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<!-- <li><a href="#">Home</a></li>
		  	<li><a href="#">Library</a></li> -->
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li><a href="<?php echo site_url('admin/testimonial'); ?>">Testimonial</a></li>
		  	<li class="active">Update Testimonial</li>
		</ol>

	</div>

</div>


<?php

	if (isset($data) && !empty($data)) {
		foreach ($data as $item) {
			$tid = $item["tid"];
			$customer_name = $item["customer_name"];
			$testimonial_desc = $item["testimonial_desc"];
		}
	}


 ?>


<div class="row">

	<div class="col-md-12">

		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Update Testimonial</h3>
		  	</div>
		  	<div class="panel-body">

		  		<div class="form-group">
				    <label>Customer Name</label>
				    <input type="text" class="form-control" id="update_customer_name" name="update_customer_name" value="<?php echo $customer_name; ?>" autofocus>
				</div>

				<div class="form-group">
				    <label>Testimonial</label>
				    <textarea id="update_testimonial_desc" name="update_testimonial_desc" class="form-control"></textarea>
				</div>

				<input type="hidden" name="tid" id="tid" value="<?php echo $tid; ?>">

				<div class="form-group">
				    <button class="btn btn-primary" id="btnUpdateTestimonial">Update</button>
				</div>
		  	</div>
		</div>

	</div>

</div>


<script type="text/javascript">

	$(document).ready(function() {
		var testimonial_desc = "<?php echo $testimonial_desc; ?>";
		$('#update_testimonial_desc').summernote('code', testimonial_desc);
	});

	var site_url = "<?php echo site_url(); ?>";
	var base_url = "<?php echo base_url(); ?>";

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/testimonial_script.js'); ?>"></script>
