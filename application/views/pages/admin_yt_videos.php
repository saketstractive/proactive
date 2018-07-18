<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Publish & Manage YouTube Videos</li>
		</ol>

	</div>

</div>

<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">

			<div class="panel-heading"><span class="text-primary"><i class="fa fa-plus-circle"></i> Publish & Manage <strong>YouTube Videos</strong></span></div>

		  	<div class="panel-body">

		  		<div class="row">
		        	<div class="col-lg-6">
    				    	<div class="form-group">
    						    <label>Video Title : </label>
    						    <input type="text" class="form-control" id="video_title" name="video_title" autofocus>
    						  </div>

                  <div class="form-group">
    						    <label>Description (optional) : </label>
    						    <textarea name="video_desc" id="video_desc" class="form-control" rows="4" cols="10"></textarea>
    						  </div>

                  <div class="form-group">
    						    <label>Video URL : </label>
    						    <input type="text" class="form-control" id="video_url" name="video_url">
    						  </div>

      						<div class="form-group">
      						    <button class="btn btn-primary" id="btnSaveVideo">Save</button>
      						    <button class="btn btn-default" id="btnCancelVideo">Cancel</button>
      						</div>
		        	</div>

							<div class="col-lg-6">
								<div class="form-group">
										<label>Stream : </label>
										<select class="form-control" id="stream-droplist">
											<option selected hidden value="0">Select Appropriate Stream</option>
										</select>
								</div>

								<div class="form-group">
										<label>Exam Category : </label>
										<select class="form-control" id="exam-category-droplist" disabled>
											<option selected hidden value="0">Select Appropriate Exam Category</option>
										</select>
								</div>

								<div class="form-group">
										<label>Subcategory : </label>
										<select class="form-control" id="subcategory-droplist" disabled>
											<option selected hidden value="0">Select Appropriate Subcategory</option>
										</select>
								</div>

								<div class="form-group">
										<label>Subject : </label>
										<select class="form-control" id="subject-droplist" disabled>
											<option selected hidden value="0">Select Appropriate Subject</option>
										</select>
								</div>
							</div>
		      </div>

		  	</div>
		</div>

	</div>

</div>

<div class="row">
  <div class="col-lg-12">

    <div class="panel panel-default">

      <div class="panel-heading"><span class="text-primary"><i class="fa fa-plus-circle"></i> Published Videos</span></div>

        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="published_videos">
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Category Delete Modal -->
<div class="modal fade delete-video-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteVideo">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">

	$(document).ready(function() {
		load_published_videos("#published_videos");

		load_stream_droplist("#stream-droplist");
    load_exam_category_droplist("#exam-category-droplist");
    load_sub_category_droplist("#subcategory-droplist");
    load_subject_droplist("#subject-droplist");
	});

</script>

<script type="text/javascript">
	var site_url = "<?php echo site_url(); ?>/";
	var base_url = "<?php echo base_url(); ?>/";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/yt_videos_script.js') ?>"></script>
