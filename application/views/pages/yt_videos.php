<div class="row">


    <div class="col-md-4">

      <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-search"></i> Search videos by</div>
        <div class="panel-body">
          <div class="form-group">
              <label>Stream : </label>
              <select class="form-control" id="stream-droplist">
                <option selected hidden value="0">Select Appropriate Stream</option>
              </select>
          </div>

          <div class="form-group">
              <label>Exam Category : </label>
              <select class="form-control" id="exam-category-droplist">
                <option selected hidden value="0">Select Appropriate Exam Category</option>
              </select>
          </div>

          <div class="form-group">
              <label>Subcategory : </label>
              <select class="form-control" id="subcategory-droplist">
                <option selected hidden value="0">Select Appropriate Subcategory</option>
              </select>
          </div>

          <div class="form-group">
              <label>Subject : </label>
              <select class="form-control" id="subject-droplist">
                <option selected hidden value="0">Select Appropriate Subject</option>
              </select>
          </div>
        </div>
      </div>

        <div class="text-center m-b-10 hidden-sm hidden-md">
          <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" />
        </div>

        <div class="text-center m-b-10 hidden-sm hidden-md">
          <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" />
        </div>
    </div>

        <div class="col-md-8">

        <div class="panel panel-default">
          <div class="panel-body">
              <div id="err_msg"><p class="text-muted m-b-20"><i class="fa fa-exclamation-triangle"></i> You need to logged in to view these videos.</p></div>

              <div id="published_videos"></div>
          </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var val_id = "<?php echo $this->session->userdata('uid'); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/yt_videos_script.js'); ?>"></script>
<script type="text/javascript">
    load_published_videos("#published_videos");
    load_stream_droplist("#stream-droplist");
    load_exam_category_droplist("#exam-category-droplist");
    load_sub_category_droplist("#subcategory-droplist");
    load_subject_droplist("#subject-droplist");
</script>
