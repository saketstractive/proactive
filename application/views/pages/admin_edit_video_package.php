<script type="text/javascript">
    var keyword_str;
</script>

<?php
    foreach ($package_detail as $value) {
?>

<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('admin/video_packages'); ?>" class="no_anchor_decoration">Create & Manage Video Packages</a></li>
        <li class="active">Edit Video Package</li>
		</ol>

	</div>

</div>


<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"><span class="text-primary"><i class="fa fa-edit"></i> Edit <strong>Video Packages</strong></span></div>
        <div class="panel-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Package Name : </label>
                        <input type="text" class="form-control" id="vp_package_name" name="vp_package_name" value="<?php echo $value["vp_name"]; ?>" autofocus>
                    </div>

                    <div class="form-group">
                        <label>Duration (in days) : </label>
                        <input type="text" class="form-control" id="vp_package_duration" name="vp_package_duration" value="<?php echo $value["vp_duration"]; ?>" >
                    </div>

                    <div class="form-group">
                        <label>Cost (in INR): </label>
                        <input type="text" class="form-control" id="vp_package_cost" name="vp_package_cost" value="<?php echo $value["vp_cost"]; ?>" >
                    </div>

                    <div class="form-group">
                        <label>Description : </label>
                        <textarea class="form-control" id="vp_package_desc" name="vp_package_desc" rows="4"><?php echo $value["vp_desc"]; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Keywords : </label>
                        <input type="text" class="form-control" id="vp_package_keywords" name="vp_package_keywords" >
                        <script type="text/javascript">
                            keyword_str = "<?php echo $value['vp_keywords']; ?>";
                        </script>
                    </div>

                </div>

                <div class="col-lg-6">

                    <!-- <div class="form-group">
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
                    </div> -->
                    <input type="hidden" id="vpid"  value="<?php echo $value['vpid'] ?>" />
                    <input type="hidden" id="stream"  value="<?php echo $value['stream'] ?>" />
                    <input type="hidden" id="category"  value="<?php echo $value['category'] ?>" />
                    <input type="hidden" id="subcategory"  value="<?php echo $value['subcategory'] ?>" />
                    <input type="hidden" id="subject"  value="<?php echo $value['subject'] ?>" />
                </div>

            </div>
            <div class="row">
              <div class="col-lg-12">
                <button type="button" id="btnEditVideoPackage" class="btn btn-primary">Edit Video Package</button>
              </div>
            </div>

        </div>
      </div>
    </div>
</div>

<?php } ?>



<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/tag-it.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/vp_package_script.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#vp_package_keywords').tagit({
            caseSensitive : false,
            allowDuplicates : false,
            allowSpaces:true,
            tagLimit:10,
            onTagExists: function(event, ui) {
              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.warning('Duplicate keywords not allowed');
            },
            onTagLimitExceeded: function(event, ui) {
              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.warning('Maximum 10 keywords allow');
            }
          });

          $("#vp_package_keywords").tagit("removeAll");

          keyword_arr = keyword_str.split(",");

          for (var i = 0; i < keyword_arr.length; i++) {
            $("#vp_package_keywords").tagit("createTag", keyword_arr[i]);
          }

    });
</script>
