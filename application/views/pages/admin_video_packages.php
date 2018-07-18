<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb white-bg">
            <li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="active">Create & Manage Video Packages</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"><span class="text-primary"><i class="fa fa-plus-circle"></i> Create <strong>Video Packages</strong></span></div>
        <div class="panel-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Package Name : </label>
                        <input type="text" class="form-control" id="vp_package_name" name="vp_package_name" autofocus>
                    </div>

                    <div class="form-group">
                        <label>Duration (in days) : </label>
                        <input type="text" class="form-control" id="vp_package_duration" name="vp_package_duration">
                    </div>

                    <div class="form-group">
                        <label>Cost (in INR): </label>
                        <input type="text" class="form-control" id="vp_package_cost" name="vp_package_cost">
                    </div>

                    <div class="form-group">
                        <label>Description : </label>
                        <textarea class="form-control" id="vp_package_desc" name="vp_package_desc" rows="4"></textarea>
                        <a class="btn text-primary" id="link" > <i class="fa fa-link" ></i> </a>
                        <a class="btn text-primary" id="set" > <i class="fa fa-check" ></i> </a>
                        <input type="text" class="form-control" id="anchor" name="anchor" placeholder="URL starting http://">
                        <input type="text" class="form-control" id="here" name="here" value="here">
                    </div>

                    <div class="form-group">
                        <label>Keywords : </label>
                        <input type="text" class="form-control" id="vp_package_keywords" name="vp_package_keywords">
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
            <div class="row">
              <div class="col-lg-12">
                <button type="button" id="btnAddVideoPackage" class="btn btn-primary">Add Video Package</button>
              </div>
            </div>

        </div>
      </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading"><span class="text-primary"><i class="fa fa-list"></i> Manage <strong>Video Packages</strong></span></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped text-center" id="vp_package_list">
                </table>
            </div>
        </div>
      </div>
    </div>
</div>


<!-- Package Delete Modal -->
<div class="modal fade delete-vp-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteVideoPackage">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>


<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
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
    load_video_package("#vp_package_list");

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

    $("#anchor").hide();
    $("#here").hide();
    $("#set").hide();

    $("#link").on("click", function () {
        $("#link").hide();
        $("#anchor").show();
        $("#here").show();
        $("#set").show();

    });

    $("#set").on("click", function () {
      var anchor = $("#anchor").val();
      var here = $("#here").val();
      var final = '';
      if (anchor != '' && here != '') {
        final = '<a href="'+anchor+'" target="_blank"> '+here+" </a>";
      }

      $("#vp_package_desc").val($("#vp_package_desc").val()+final);
      $("#link").show();
      $("#anchor").hide();
      $("#here").hide();
      $("#set").hide();
    });


   

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/vp_package_script.js') ?>"></script>
