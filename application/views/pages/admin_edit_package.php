<script type="text/javascript">
    var keyword_str;
</script>

<?php
foreach ($package_detail as $value) {
    $doc_list = $value["p_smlist"];
 ?>
<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('admin/packages'); ?>" class="no_anchor_decoration">Create & Manage Packages</a></li>
        <li class="active">Edit Package</li>
		</ol>

	</div>

</div>


<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"><span class="text-primary"><i class="fa fa-edit"></i> Edit <strong>Packages</strong></span></div>
        <div class="panel-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Package Name : </label>
                        <input type="text" class="form-control" id="package_name" name="package_name" value="<?php echo $value["p_name"]; ?>" autofocus>
                    </div>

                    <div class="form-group">
                        <label>Duration (in days) : </label>
                        <input type="text" class="form-control" id="package_duration" name="package_duration" value="<?php echo $value["p_duration"]; ?>" >
                    </div>

                    <div class="form-group">
                        <label>Cost (in INR): </label>
                        <input type="text" class="form-control" id="package_cost" name="package_cost" value="<?php echo $value["p_cost"]; ?>" >
                    </div>

                    <div class="form-group">
                        <label>Description : </label>
                        <textarea class="form-control" id="package_desc" name="package_desc" rows="4"><?php echo $value["p_desc"]; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Keywords : </label>
                        <input type="text" class="form-control" id="package_keywords" name="package_keywords" >
                        <script type="text/javascript">
                            keyword_str = "<?php echo $value['p_keywords']; ?>";
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
                    <input type="hidden" id="pid"  value="<?php echo $value['pid'] ?>" />
                    <input type="hidden" id="stream"  value="<?php echo $value['stream'] ?>" />
                    <input type="hidden" id="category"  value="<?php echo $value['category'] ?>" />
                    <input type="hidden" id="subcategory"  value="<?php echo $value['subcategory'] ?>" />
                    <input type="hidden" id="subject"  value="<?php echo $value['subject'] ?>" />
                </div>

                <div class="col-lg-12">
                  <input type="hidden" id="material_string" value="<?php echo $doc_list ?>" />

                    <button type="button" name="showStudyMaterial" id="showStudyMaterial" class="btn btn-default m-b-30">Add/Remove attached files</button>
                    <div id="study_material">
                      <label>Attach files : </label>
                      <div class="table-responsive">
                          <table class="table table-hover table-bordered table-striped" id="doc_list"></table>
                      </div>
                    </div>
                </div>

            </div>
            <div class="row">
              <div class="col-lg-12">
                <button type="button" id="btnEditPackage" class="btn btn-primary">Edit Package</button>
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
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/package_script.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        load_stream_droplist("#stream-droplist");
        load_exam_category_droplist("#exam-category-droplist");
        load_sub_category_droplist("#subcategory-droplist");
        load_subject_droplist("#subject-droplist");
        load_study_material_admin("#doc_list");

        $("#study_material").hide();

        // var doc_list_str = "<?php echo $doc_list; ?>";
        // var doc_list_arr = doc_list_str.split(",");
        //
        // doc_list_arr.forEach(function(element, index) {
        //     get_doc_info(element, "#doc_list");
        // });

        $('#package_keywords').tagit({
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

          $("#package_keywords").tagit("removeAll");

          keyword_arr = keyword_str.split(",");

          for (var i = 0; i < keyword_arr.length; i++) {
            $("#package_keywords").tagit("createTag", keyword_arr[i]);
          }

          $("#showStudyMaterial").on("click", function() {
              $("#study_material").show();

              var material_list = "<?php echo $doc_list; ?>";
              var material_arr = material_list.split(",");

              $(".selected_sm").each(function() {
                for (var i = 0; i < material_arr.length; i++) {
                 if ( $(this).attr("data-id") == material_arr[i]) {
                     $(this).prop("checked", true);
                 }
               }
             });
          });


          $(document).on("change",".selected_sm",function() {
              material_list = [];
              $(".selected_sm").each( function(i, value) {
                if ($(this).is(":checked")) {
                    material_list.push($(this).attr("data-id"));
                }
              });
              $("#material_string").val(material_list);

          });
    });
</script>
