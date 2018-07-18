<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<!-- <li><a href="#">Home</a></li>
		  	<li><a href="#">Library</a></li> -->
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Study Material</li>
		</ol>

	</div>

</div>


<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">
				<div class="panel-heading lead"><span class="text-primary"><i class="fa fa-upload"></i> Upload Study Material</span></div>

				<div class="panel-body">

			    	<div class="row">

			    		<div class="col-lg-8 col-lg-offset-2">

									<p class="help-block">
											Drop multiple files in the space below. Select respective subject find it in package creation process. 
									</p>

									<div class="form-group">
										<label>Subject : </label>
									    <select class="form-control" name="subject-droplist" id="subject-droplist">
										  	<option selected hidden>Select Appropriate Subject</option>
										</select>
									</div>

									<div class="form-group">
									    <div class="dropzone" id="upload_documents">
													<div class="dz-message">
															<h3><strong>Drop</strong> file(s) here</h3><h4>or <strong>Click</strong> to upload</h4>
													</div>
											</div>
									</div>

									<button class="btn btn-primary btn-block m-t-b-20" id="btnUploadDocument"><strong>Upload</strong></button>

				    	</div>

			    	</div>

		  	</div>
		</div>

	</div>

</div>


<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">
				<div class="panel-heading lead"><span class="text-primary"><i class="fa fa-cog"></i> Manage Uploaded Study Material</span></div>
		  	<div class="panel-body">
					<div class="table-responsive">
							<table class="table table-hover table-striped text-center" id="study_material_list">
							</table>
					</div>
				</div>
		</div>

	</div>

</div>


<!-- Study Material Update Modal -->
<div class="modal fade update-material-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
     		<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Update Study Material</h4>
		    </div>

		    <div class="modal-body">
		    	<div class="row">
		        	<div class="col-lg-12">
				    	<div class="form-group">
						    <label>Title : </label>
						    <input type="text" class="form-control" id="updated_title" name="updated_title">
						</div>
					</div>

					<div class="col-lg-12">
				    	<div class="form-group">
						    <label>Subject : </label>
						    <select class="form-control" id="updated-subject-droplist">
						    	<option selected hidden>Select Appropriate Stream</option>
						    </select>
						</div>
					</div>
				</div>

		    </div>

		    <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="updateMaterial">Save changes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
    	</div>
  	</div>
</div>


<!-- Study Material Delete Modal -->
<div class="modal fade delete-material-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteMaterial">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>


<script type="text/javascript">

	$(document).ready(function() {
		load_subject_droplist("#subject-droplist");
		load_subject_droplist("#updated-subject-droplist");
		load_study_material("#study_material_list");
	});


	Dropzone.autoDiscover = false;

    var upload_documents = new Dropzone("#upload_documents", {
        url: '<?php echo site_url("admin/upload_documents"); ?>',
        autoProcessQueue: false,
        parallelUploads: 6,
				maxFiles: 6,
        maxFilesize: 100,
        addRemoveLinks: true,
        acceptedFiles: "application/pdf",
        dictInvalidFileType: "File type not allowed",
        dictFileTooBig: "File size must be less than 100MB",
				dictMaxFilesExceeded: "Maximum 6 files are allowed at a time"
    });

		var subject_id;

		$("#btnUploadDocument").click(function() {
				subject_id = parseInt($("#subject-droplist").val());

				if (upload_documents.getQueuedFiles().length > 0 && subject_id != 0) {
						upload_documents.processQueue();
				} else {
						toastr.options.timeOut = 5000;
						toastr.options.positionClass = "toast-bottom-right";
						toastr.info('Please select file(s) first.');
				}
    });

		upload_documents.on("sending", function(file, xhr, formData) {
				formData.append("subject_id", subject_id);
		});

		upload_documents.on("error", function() {
				toastr.options.timeOut = 5000;
				toastr.options.positionClass = "toast-bottom-right";
				toastr.error('Some error occurred while uploading file(s).');
		});

		upload_documents.on("success", function(file, response) {
				toastr.options.timeOut = 5000;
				toastr.options.positionClass = "toast-bottom-right";
				toastr.success('File(s) uploaded successfully.');
		});

		upload_documents.on("queuecomplete", function(file) {
				upload_documents.removeAllFiles();
				$("#subject-droplist").val(0).change();
				load_study_material("#study_material_list");
		});


		//
		// Deletion
		// Category
		//
		var sm_id;

		$(document).on("click", "#btnDeleteStudyMaterial", function() {
		    $(".delete-material-modal").modal("show");
		    sm_id = $(this).attr("data-id");
		});

		$("#deleteMaterial").click(function() {
		    $.ajax({
		        url: site_url+'admin/delete_study_material',
		        type: "POST",
		        dataType: "text",
		        data: {"sm_id" : sm_id},
		        crossDomain: true,
		        cache: false,
		        success: function(response) {
		            $(".delete-material-modal").modal("hide");
		            if (response == 1) {
		                toastr.options.timeOut = 5000;
		                toastr.options.positionClass = "toast-bottom-right";
		                toastr.success('Study material deleted successfully.');
		            } else if(response == 0) {
		                toastr.options.timeOut = 5000;
		                toastr.options.positionClass = "toast-bottom-right";
		                toastr.error('Some error occurred. Please try again.');
		            }
		        },
		        complete: function() {
		            $(".delete-category-modal").modal("hide");
		            load_study_material("#study_material_list");
		        },
		        error: function(error) {
		            console.log(error);
		        }
		    });
		});


		//
		// Updation
		// Study Material
		//
		$(document).on("click", "#btnUpdateStudyMaterial", function() {
		    $(".update-material-modal").modal("show");
		    sm_id = $(this).attr("data-id");

		    $.get(site_url+"admin/load_material_by_id", {"sm_id" : sm_id}, function(response) {
		        var obj = jQuery.parseJSON(response);
		        $.each(obj, function(i, value) {
		            $("#updated_title").val(value['sm_title']);
		            $("#updated-subject-droplist").val(value['subject_id']).change();
		        });
		    });

		    // $("#updated_exam_category").focus();
		});


		$("#updateMaterial").click(function() {
		    var title = $("#updated_title").val();
		    var subject_id = $("#updated-subject-droplist").val();

		    if (title != "" && subject_id != 0) {
		        $.ajax({
		            type: "POST",
		            url: site_url+'admin/update_study_material',
		            dataType: "text",
		            data: {"sm_id" : sm_id, "sm_title" : title, "subject_id" : subject_id},
		            crossDomain: true,
		            cache: false,
		            success: function(response) {
		                $(".update-material-modal").modal("hide");
		                if (response == 1) {
		                    toastr.options.timeOut = 5000;
		                    toastr.options.positionClass = "toast-bottom-right";
		                    toastr.success('Study material updated successfully.');
		                } else if(response == 0) {
		                    toastr.options.timeOut = 5000;
		                    toastr.options.positionClass = "toast-bottom-right";
		                    toastr.error('Some error occurred. Please try again.');
		                }
		            },
		            complete: function() {
		                $(".update-material-modal").modal("hide");
		                load_study_material("#study_material_list");
		            },
		            error: function(error) {
		                console.log(error);
		            }
		        });
		    } else {
		        toastr.options.timeOut = 5000;
		        toastr.options.positionClass = "toast-bottom-right";
		        toastr.info('All fields are mandatory.');
		    }

		});

</script>
