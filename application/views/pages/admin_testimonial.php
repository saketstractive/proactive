<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Testimonial</li>
		</ol>

	</div>

</div>

<div class="row">

	<div class="col-lg-7">

		<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Publish Testimonial</h3>
        </div>
		  	<div class="panel-body">

            <div class="form-group">
              <label>Customer Name</label>
              <input type="text" class="form-control" id="customer_name" name="customer_name" autofocus>
            </div>

            <div class="form-group">
              <label>Testimonial</label>
              <textarea id="testimonial_desc" name="testimonial_desc" class="form-control"></textarea>
            </div>

						<div class="form-group">
							<button class="btn btn-primary" id="btnPublishTestimonial">Publish</button>
						</div>
		  	</div>
		</div>

	</div>

	<div class="col-lg-5">
		<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Recently Published Testimonials</h3>
        </div>
		  	<div class="panel-body">
						<div id="published_testimonials"></div>
		  	</div>
		</div>

	</div>

</div>

<!-- Testimonial Delete Modal -->
<div class="modal fade delete-testimonial-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteTestimonial">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
		var site_url = "<?php echo site_url(); ?>";
		var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/testimonial_script.js'); ?>"></script>

<script type="text/javascript">
		load_testimonial("#published_testimonials");
</script>
