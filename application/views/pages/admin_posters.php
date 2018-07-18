<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<!-- <li><a href="#">Home</a></li>
		  	<li><a href="#">Library</a></li> -->
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Free E-Books</li>
		</ol>

	</div>

</div>


<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">
				<div class="panel-heading lead"><span class="text-primary"><i class="fa fa-upload"></i> Upload Free E-Books</span></div>

				<div class="panel-body">

			    	<div class="row">

			    		<div class="col-lg-8 col-lg-offset-2">

									<p class="help-block">
											Upload USB posters to use it in package creation process. The posters are only for premium video USB drives.
									</p>


                

           

									<div class="form-group">
                      <label>Upload free E-Book(s) : </label>
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
				<div class="panel-heading lead"><span class="text-primary"><i class="fa fa-cog"></i> Manage Uploaded E-Books</span></div>
		  	<div class="panel-body">
					<div class="table-responsive">
							<table class="table table-hover table-striped text-center" id="ebooks_list">
							</table>
					</div>
				</div>
		</div>

	</div>

</div>


<!-- Ebook Update Modal -->
<div class="modal fade update-ebook-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
     		<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Update Ebook</h4>
		    </div>

		    <div class="modal-body">
		    	<div class="row">
		        	<div class="col-lg-12">
				    	<div class="form-group">
						    <label>Title : </label>
						    <input type="text" class="form-control" id="updated_title" name="updated_title">
						</div>
					</div>

			
				</div>

		    </div>

		    <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="updateEbook">Save changes</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
    	</div>
  	</div>
</div>


<!-- Ebook Delete Modal -->
<div class="modal fade delete-ebook-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteEbook">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets/js/app.js') ?>"></script>
<script type="text/javascript">

	$(document).ready(function() {
		
    load_ebooks("#ebooks_list");


	});



	 Dropzone.autoDiscover = false;

    var upload_documents = new Dropzone("#upload_documents", {
        url: '<?php echo site_url("admin/upload_ebooks"); ?>',
        autoProcessQueue: false,
        parallelUploads: 6,
				maxFiles: 6,
        maxFilesize: 1,
        addRemoveLinks: true,
        ////acceptedFiles: "",
        dictInvalidFileType: "File type not allowed",
        dictFileTooBig: "File size must be less than 1MB",
				dictMaxFilesExceeded: "Maximum 6 files are allowed at a time"
    });

		var stream_id, cat_id, subcat_id, subject_id;

		$("#btnUploadDocument").click(function() {
       

				if (upload_documents.getQueuedFiles().length > 0 ) {
						upload_documents.processQueue();
				} else {
						toastr.options.timeOut = 5000;
						toastr.options.positionClass = "toast-bottom-right";
						toastr.info('Please select file(s) first.');
				}
    });

		// upload_documents.on("sending", function(file, xhr, formData) {
       		
        
		// });

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
        $("#stream-droplist").val(0).change();
        $("#exam-category-droplist").val(0).change();
        $("#subcategory-droplist").val(0).change();
        $("#subject-droplist").val(0).change();
				load_ebooks("#ebooks_list");
		});


		//
		// Deletion
		// Category
		//
		var bid;

		$(document).on("click", "#btnDeleteEbook", function() {
		    $(".delete-ebook-modal").modal("show");
		    bid = $(this).attr("data-id");
		});

		$("#deleteEbook").click(function() {
		    $.ajax({
		        url: site_url+'admin/delete_ebook',
		        type: "POST",
		        dataType: "text",
		        data: {"bid" : bid},
		        crossDomain: true,
		        cache: false,
		        success: function(response) {
		            $(".delete-ebook-modal").modal("hide");
		            if (response == 1) {
		                toastr.options.timeOut = 5000;
		                toastr.options.positionClass = "toast-bottom-right";
		                toastr.success('Ebook deleted successfully.');
		            } else if(response == 0) {
		                toastr.options.timeOut = 5000;
		                toastr.options.positionClass = "toast-bottom-right";
		                toastr.error('Some error occurred. Please try again.');
		            }
		        },
		        complete: function() {
		            $(".delete-ebook-modal").modal("hide");
		            load_ebooks("#ebooks_list");
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
		$(document).on("click", "#btnUpdateEbook", function() {
		    $(".update-ebook-modal").modal("show");
		    bid = $(this).attr("data-id");

		    $.get(site_url+"admin/load_ebook_by_id", {"bid" : bid}, function(response) {
		        var obj = jQuery.parseJSON(response);
		        $.each(obj, function(i, value) {
		            $("#updated_title").val(value['book_title']);
		            // $("#updated-subject-droplist").val(value['subject_id']).change();
		        });
		    });

		    // $("#updated_exam_category").focus();
		});


		$("#updateEbook").click(function() {
		    var title = $("#updated_title").val();

		    if (title != "") {
		        $.ajax({
		            type: "POST",
		            url: site_url+'admin/update_ebook',
		            dataType: "text",
		            data: {"bid" : bid, "book_title" : title},
		            crossDomain: true,
		            cache: false,
		            success: function(response) {
		                $(".update-ebook-modal").modal("hide");
		                if (response == 1) {
		                    toastr.options.timeOut = 5000;
		                    toastr.options.positionClass = "toast-bottom-right";
		                    toastr.success('Ebook updated successfully.');
		                } else if(response == 0) {
		                    toastr.options.timeOut = 5000;
		                    toastr.options.positionClass = "toast-bottom-right";
		                    toastr.error('Some error occurred. Please try again.');
		                }
		            },
		            complete: function() {
		                $(".update-ebook-modal").modal("hide");
		                load_ebooks("#ebooks_list");
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
