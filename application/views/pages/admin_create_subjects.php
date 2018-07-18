<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Create & Manage Subjects</li>
		</ol>

	</div>

</div>


<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">

			<div class="panel-heading"><span class="text-primary"><i class="fa fa-plus-circle"></i> Create & Manage <strong>Subjects</strong></span></div>

		  	<div class="panel-body">

		    	<div class="row">
		        	<div class="col-lg-6">
				    	<div class="form-group">
						    <label>Subject Name : </label>
						    <input type="text" class="form-control" id="subject_name" name="subject_name">
						</div>

						<div class="form-group">
						    <label>Stream : </label>
						    <select class="form-control" id="stream-droplist">
						    	<option selected hidden>Select Appropriate Stream</option>
						    </select>
						</div>

						<div class="form-group">
						    <label>Exam Category : </label>
						    <select class="form-control" id="exam-category-droplist" disabled>
						    	<option selected hidden>Select Appropriate Exam Category</option>
						    </select>
						</div>

						<div class="form-group">
						    <label>Sub Category : </label>
						    <select class="form-control" id="sub-category-droplist" disabled>
						    	<option selected hidden>Select Appropriate Sub Category</option>
						    </select>
						</div>

						<div class="form-group">
						    <button class="btn btn-primary" id="btnSaveSubject">Save</button>
						    <button class="btn btn-default" id="btnCancelSubject">Cancel</button>
						</div>
		        	</div>

		        	<div class="col-lg-6">
		        		<label>Existing Subjects : </label>
		        		<div class="table-responsive">
						  	<table class="table table-hover table-bordered text-center" id="subject-list">
						  	</table>
						</div>
		        	</div>
		        </div>
		  	</div>
		</div>

	</div>

</div>


<!-- Subject Update Modal -->
<div class="modal fade update-subject-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
     		<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Update Subject</h4>
		    </div>
		    
		    <div class="modal-body">
		        
		    	<div class="row">
		        	<div class="col-lg-12">
				    	<div class="form-group">
						    <label>Subject Name : </label>
						    <input type="text" class="form-control" id="updated_subject_name" name="updated_subject_name">
						</div>
					</div>

					<div class="col-lg-12">
				    	<div class="form-group">
						    <label>Stream : </label>
						    <select class="form-control" id="updated-stream-droplist">
						    	<option selected hidden>Select Appropriate Stream</option>
						    </select>
						</div>
					</div>

					<div class="col-lg-12">
				    	<div class="form-group">
						    <label>Category : </label>
						    <select class="form-control" id="updated-category-droplist">
						    	<option selected hidden>Select Appropriate Category</option>
						    </select>
						</div>
					</div>

					<div class="col-lg-12">
				    	<div class="form-group">
						    <label>Sub Category : </label>
						    <select class="form-control" id="updated-subcategory-droplist">
						    	<option selected hidden>Select Appropriate Sub Category</option>
						    </select>
						</div>
					</div>
				</div>

		    </div>
		      
		    <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="updateSubject">Save changes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
    	</div>
  	</div>
</div>

<!-- Subject Delete Modal -->
<div class="modal fade delete-subject-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteSubject">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>


<script type="text/javascript">

	$(document).ready(function() {
		
		load_subject_list("#subject-list");

		load_stream_droplist("#stream-droplist");
		load_stream_droplist("#updated-stream-droplist");

		load_exam_category_droplist("#exam-category-droplist");
		load_exam_category_droplist("#updated-category-droplist");

		load_sub_category_droplist("#sub-category-droplist");
		load_sub_category_droplist("#updated-subcategory-droplist");

	});

</script>

<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>/";
	var base_url = "<?php echo base_url(); ?>/";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/subject_script.js'); ?>"></script>