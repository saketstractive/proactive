<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Editorial</li>
		</ol>

	</div>

</div>

<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Publish Editorial</h3>
		  	</div>
		  	<div class="panel-body">
		  		<div class="form-group">
				    <label>Title</label>
				    <input type="text" class="form-control" id="ed_title" name="ed_title" autofocus>
				</div>

				<div class="form-group">
				    <label>Description</label>
				    <textarea id="ed_desc" name="ed_desc" class="form-control"></textarea>
				</div>

				<div class="form-group">
				    <button class="btn btn-primary" id="btnPublishEditorial">Publish</button>
				</div>
		  	</div>
		</div>

	</div>

</div>


<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Browse All Editorial Articles</h3>
        </div>
        <div class="panel-body">
		    	<div class="row" id="editorial_list"></div>
		  	</div>
		</div>

	</div>

</div>

<!-- Stream Delete Modal -->
<div class="modal fade delete-editorial-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteEditorial">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/editorial_script.js'); ?>"></script>

<script type="text/javascript">
	$(document).ready(function() {
		load_editorials("#editorial_list");
	});
</script>
