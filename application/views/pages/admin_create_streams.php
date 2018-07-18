<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Create & Manage Streams</li>
		</ol>

	</div>

</div>


<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">

			<div class="panel-heading"><span class="text-primary"><i class="fa fa-plus-circle"></i> Create & Manage <strong>Streams</strong></span></div>

		  	<div class="panel-body">
		    	<!-- <p class="text-muted">
		    		Create new categories and exams by filling following forms.<br />
		    		Explore below tabs to create different categories and exams.
		    	</p> -->

		    	<div class="row">
		        	<div class="col-lg-6">
				    	<div class="form-group">
						    <label>Stream Name : </label>
						    <input type="text" class="form-control" id="stream_name" name="stream_name">
						</div>

						<div class="form-group">
						    <button class="btn btn-primary" id="btnSaveStream">Save</button>
						    <button class="btn btn-default" id="btnCancelStream">Cancel</button>
						</div>
		        	</div>

		        	<div class="col-lg-6">
		        		<label>Existing Streams : </label>
		        		<div class="table-responsive">
						  	<table class="table table-hover table-bordered text-center" id="stream-list">
						  	</table>
						</div>
		        	</div>
		        </div>

		  	</div>
		</div>

	</div>

</div>


<!-- Stream Update Modal -->
<div class="modal fade update-stream-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
     		<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Update Stream</h4>
		    </div>
		    
		    <div class="modal-body">
		        
		    	<div class="row">
		        	<div class="col-lg-12">
				    	<div class="form-group">
						    <label>Stream Name : </label>
						    <input type="text" class="form-control" id="updated_stream_name" name="updated_stream_name">
						</div>
					</div>
				</div>

		    </div>
		      
		    <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="updateStream">Save changes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
    	</div>
  	</div>
</div>

<!-- Stream Delete Modal -->
<div class="modal fade delete-stream-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteStream">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>


<script type="text/javascript">

	$(document).ready(function() {
		load_stream_list("#stream-list");
		// load_stream_droplist("#stream-droplist");
		// load_stream_droplist("#updated-stream-droplist");
		// load_stream_droplist("#sub-cat-stream-droplist");

		// load_exam_category_list("#category-list");
		// load_exam_category_droplist("#exam-category-droplist");

		// load_sub_category_list("#subcategory-list");
	});

</script>

<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>/";
	var base_url = "<?php echo base_url(); ?>/";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/stream_script.js'); ?>"></script>