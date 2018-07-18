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
            <li><a href="<?php echo site_url('admin/mcq_packages'); ?>" class="no_anchor_decoration">Create & Manage Objective Packages</a></li>
            <li class="active">Edit Objective Packages</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-9">
      <div class="panel panel-default">
        <div class="panel-heading"><span class="text-primary"><i class="fa fa-edit"></i> Edit <strong>Objective Packages</strong></span></div>
        <div class="panel-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Package Name : </label>
                        <input type="text" class="form-control" id="package_name" name="package_name" value="<?php echo $value["p_name"]; ?>" autofocus>
                    </div>

                    <div class="form-group">
                        <label>Duration (in days) : </label>
                        <input type="text" class="form-control" id="package_duration" name="package_duration" value="<?php echo $value["p_duration"]; ?>">
                    </div>

                    <div class="form-group">
                        <label>Cost (in INR): </label>
                        <input type="text" class="form-control" id="package_cost" name="package_cost" value="<?php echo $value["p_cost"]; ?>">
                    </div>

                    <div class="form-group">
                        <label>Description : </label>
                        <textarea class="form-control" id="package_desc" name="package_desc" rows="4"><?php echo $value["p_desc"]; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Keywords : </label>
                        <input type="text" class="form-control" id="package_keywords" name="package_keywords">
                        <script type="text/javascript">
                            keyword_str = "<?php echo $value['p_keywords']; ?>";
                        </script>
                    </div>

                    <input type="hidden" id="pid"  value="<?php echo $value['pid'] ?>" />
                    <input type="hidden" id="stream"  value="<?php echo $value['stream'] ?>" />
                    <input type="hidden" id="category"  value="<?php echo $value['category'] ?>" />
                    <input type="hidden" id="subcategory"  value="<?php echo $value['subcategory'] ?>" />
                    <input type="hidden" id="subject"  value="<?php echo $value['subject'] ?>" />
                    <input type="hidden" id="questions_string" value="<?php echo $doc_list ?>" />

                </div>
                </div>
            <div class="row">
              <div class="col-lg-12">
                <button type="button" id="btnEditMCQPackage" class="btn btn-primary">Edit Package</button>
              </div>
            </div>
            <div class="row">
                <?php if ($value["p_type"]==1) { ?>
                  <div class="col-lg-12">
                    <button class="btn btn-link" id="editAttachedQue">Edit questions attached</button>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" id="question_list">
                        </table>
                    </div>
                </div>  
                <?php } else { ?>
                <div class="col-lg-12 text-danger">NOTE: Combo contents(questions) cannot be edited.</div>
                <?php } ?> 

            </div>

        </div>
      </div>
    </div>

    <div class="col-lg-3">
        <div class="list-group">
            <a href="<?php echo site_url('admin/question_bank'); ?>" class="list-group-item"><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;Upload Question Bank</a>
            <a href="<?php echo site_url('admin/manage_question_bank'); ?>" class="list-group-item"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Manage Question Bank</a>
            <a href="<?php echo site_url('admin/mcq_packages'); ?>" class="list-group-item"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create MCQ Package</a>
            <a href="<?php echo site_url('admin/manage_mcq_packages'); ?>" class="list-group-item active"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Manage MCQ Package</a>
        </div>
    </div>
</div>

<?php } ?>

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
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multi-select.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/tag-it.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/app.js') ?>"></script>

<script type="text/javascript">

    load_stream_droplist("#stream-droplist");

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

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/objective_package_script.js') ?>"></script>
