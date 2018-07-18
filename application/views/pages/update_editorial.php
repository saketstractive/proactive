<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('admin/editorial'); ?>"> Editorial</a></li>
		  	<li class="active">Update Editorial</li>
		</ol>

	</div>

</div>

<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Edit Editorial</h3>
		  	</div>
		  	<div class="panel-body">
          <input type="hidden" name="ed_id" id="ed_id" value="<?php echo $ed_data[0]['ed_id']; ?>">
		  		<div class="form-group">
  				    <label>Title</label>
  				    <input type="text" class="form-control" id="ed_title" name="ed_title" value="<?php echo $ed_data[0]['ed_title'] ?>" autofocus>
  				</div>

  				<div class="form-group">
  				    <label>Description</label>
  				    <textarea id="ed_desc" name="ed_desc" class="form-control"></textarea>
  				</div>

  				<div class="form-group">
  				    <button class="btn btn-primary" id="btnUpdateEditorial">Update</button>
  				</div>
		  	</div>
        <div class="panel-footer">
            <a href="<?php echo site_url('admin/editorial'); ?>" class="no_anchor_decoration"><i class="fa fa-reply"></i> Go to previous page</a>
        </div>
		</div>

	</div>

</div>

<script type="text/javascript">

	$(document).ready(function() {
		var ed_desc = "<?php echo $ed_data[0]['ed_desc']; ?>";
		$('#ed_desc').summernote('code', ed_desc);
	});

	var site_url = "<?php echo site_url(); ?>";
	var base_url = "<?php echo base_url(); ?>";

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/editorial_script.js'); ?>"></script>
