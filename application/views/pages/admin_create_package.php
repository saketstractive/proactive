<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb white-bg">
            <li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="active">Create & Manage Packages</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"><span class="text-primary"><i class="fa fa-plus-circle"></i> Create <strong>Packages</strong></span></div>
        <div class="panel-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Package Name : </label>
                        <input type="text" class="form-control" id="package_name" name="package_name" autofocus>
                    </div>

                    <div class="form-group">
                        <label>Duration (in days) : </label>
                        <input type="text" class="form-control" id="package_duration" name="package_duration">
                    </div>

                    <div class="form-group">
                        <label>Cost (in INR): </label>
                        <input type="text" class="form-control" id="package_cost" name="package_cost">
                    </div>

                    <div class="form-group">
                        <label>Description : </label>
                        <textarea class="form-control" id="package_desc" name="package_desc" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Keywords : </label>
                        <input type="text" class="form-control" id="package_keywords" name="package_keywords">
                    </div>

                    <!-- <div class="form-group">
                        <label>Attach files : </label>
                        <select multiple="multiple" id="doc_list" name="doc_list[]">
                        </select>
                    </div> -->

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

                <div class="col-lg-12">
                    <label>Attach files : </label>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" id="doc_list"></table>
                    </div>
                </div>

            </div>
            <div class="row">
              <div class="col-lg-12">
                <button type="button" id="btnAddPackage" class="btn btn-primary">Add Package</button>
              </div>
            </div>

        </div>
      </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"><span class="text-primary"><i class="fa fa-list"></i> Manage <strong>Packages</strong></span></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped text-center" id="package_list">
                </table>
            </div>
        </div>
      </div>
    </div>
</div>


<!-- Package Delete Modal -->
<div class="modal fade delete-package-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deletePackage">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>


<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var arr_list;
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multi-select.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/tag-it.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/app.js') ?>"></script>

<script type="text/javascript">

    // load_study_material("#doc_list");
    load_stream_droplist("#stream-droplist");
    load_exam_category_droplist("#exam-category-droplist");
    load_sub_category_droplist("#subcategory-droplist");
    load_subject_droplist("#subject-droplist");
    load_subjective_package("#package_list");

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

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/package_script.js') ?>"></script>

<script type="text/javascript">
    load_study_material_admin("#doc_list");
</script>
