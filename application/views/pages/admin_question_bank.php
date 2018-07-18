<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Question Bank</li>
		</ol>

	</div>

</div>


<div class="row">

	<div class="col-lg-9">

		<div class="panel panel-default">
				<div class="panel-heading"><span class="text-primary"><i class="fa fa-upload"></i> Upload MCQ Questions</span></div>

				<div class="panel-body">

			    	<div class="row">

			    		<div class="col-lg-12">

									<p class="help-block">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat.
									</p>

									<div class="form-group">
										<label>Subject : </label>
									    <select class="form-control" name="subject-droplist" id="subject-droplist">
										  	<option selected hidden>Select Appropriate Subject</option>
										</select>
									</div>

									<div class="form-group">
									    <div class="dropzone" id="upload_csv">
													<div class="dz-message">
															<h3><strong>Drop</strong> file(s) here</h3><h4>or <strong>Click</strong> to upload</h4>
													</div>
											</div>
									</div>

									<button class="btn btn-primary btn-block m-t-b-20" id="btnUploadCSV"><strong>Upload</strong></button>

				    	</div>

			    	</div>

		  	</div>

				<div class="panel-footer">
						<a href="<?php echo site_url('admin/manage_question_bank'); ?>">Click here</a> to Manage Question Bank
				</div>
		</div>

	</div>

  <div class="col-md-3">
    <div class="list-group">
        <a href="<?php echo site_url('admin/question_bank'); ?>" class="list-group-item active"><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;Upload Question Bank</a>
        <a href="<?php echo site_url('admin/manage_question_bank'); ?>" class="list-group-item"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Manage Question Bank</a>
        <a href="<?php echo site_url('admin/mcq_packages'); ?>" class="list-group-item"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create MCQ Package</a>
        <a href="<?php echo site_url('admin/manage_
				mcq_packages'); ?>" class="list-group-item"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Manage MCQ Package</a>
    </div>
  </div>


</div>


<script type="text/javascript">
    $(document).ready(function() {
        load_subject_droplist("#subject-droplist");

        Dropzone.autoDiscover = false;

        var upload_csv = new Dropzone("#upload_csv", {
            url: '<?php echo site_url("admin/upload_csv"); ?>',
            autoProcessQueue: false,
            parallelUploads: 3,
    				maxFiles: 3,
            maxFilesize: 10,
            addRemoveLinks: true,
            acceptedFiles: "text/csv",
            dictInvalidFileType: "File type not allowed",
            dictFileTooBig: "File size must be less than 10MB",
    				dictMaxFilesExceeded: "Maximum 3 files are allowed at a time"
        });

    		var subject_id;

    		$("#btnUploadCSV").click(function() {
    				subject_id = parseInt($("#subject-droplist").val());

    				if (upload_csv.getQueuedFiles().length > 0 && subject_id != 0) {
    						upload_csv.processQueue();
    				} else {
    						toastr.options.timeOut = 5000;
    						toastr.options.positionClass = "toast-bottom-right";
    						toastr.info('Please select subject and file(s).');
    				}
        });

    		upload_csv.on("sending", function(file, xhr, formData) {
    				formData.append("subject_id", subject_id);
    		});

    		upload_csv.on("error", function() {
    				toastr.options.timeOut = 5000;
    				toastr.options.positionClass = "toast-bottom-right";
    				toastr.error('Some error occurred while uploading file(s).');
    		});

    		upload_csv.on("success", function(file, response) {
    				toastr.options.timeOut = 5000;
    				toastr.options.positionClass = "toast-bottom-right";
    				toastr.success('File(s) uploaded successfully.');
    		});

    		upload_csv.on("queuecomplete", function(file) {
    				upload_csv.removeAllFiles();
    				$("#subject-droplist").val(0).change();
    				// load_study_material("#study_material_list");
    		});
    });
</script>
