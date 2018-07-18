<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Manage MCQ Packages</li>
		</ol>

	</div>

</div>


<div class="row">

	<div class="col-lg-9">

		<div class="panel panel-default">
				<div class="panel-heading">
          <button id="btnMakeCombo" class="btn btn-primary pull-right"><b>Combo</b> <span class="badge">NEW</span></button>
          <span class="text-primary"><i class="fa fa-pencil-square-o"></i> Manage MCQ Packages</span>
        </div>

				<div class="panel-body">
          <div id="comboForm" class="p-t-b-20">
            <form class="form-inline">
              <div class="form-group p-t-b-10">
                <input type="text" class="form-control" id="package_name" placeholder="Title">
              </div>
              <div class="form-group p-t-b-10">
                <input type="text" class="form-control" id="package_duration" placeholder="Duration">
              </div>
              <div class="form-group p-t-b-10">
                <input type="text" class="form-control" id="package_cost" placeholder="Cost">
              </div>
              <div class="form-group p-t-b-10">
                <input type="hidden" name="pack_list" id="pack_list" />
                <textarea class="form-control" id="package_desc" placeholder="Description" rows="2" cols="50"></textarea>
              </div>
              <div class="form-group p-t-b-10">
                <label>Keywords: </label>
                <input type="text" class="form-control" style="display: none!important;" id="package_keywords" name="package_keywords">
              </div>
              <br />
              <button id="btnCreateCombo" class="btn btn-primary">Create</button>
            </form>
            
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover" id="mcq_packages"></table>
          </div>
		  	</div>

				<div class="panel-footer">
						<a href="<?php echo site_url('admin/mcq_packages'); ?>">Click here</a> to Create MCQ Packages
				</div>
		</div>

	</div>

  <div class="col-md-3">
    <div class="list-group">
        <a href="<?php echo site_url('admin/question_bank'); ?>" class="list-group-item"><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;Upload Question Bank</a>
        <a href="<?php echo site_url('admin/manage_question_bank'); ?>" class="list-group-item"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Manage Question Bank</a>
        <a href="<?php echo site_url('admin/mcq_packages'); ?>" class="list-group-item"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create MCQ Package</a>
        <a href="<?php echo site_url('admin/manage_mcq_packages'); ?>" class="list-group-item active"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Manage MCQ Package</a>
    </div>
  </div>


</div>

<!-- Question Delete Modal -->
<div class="modal fade delete-mcq-package-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteMCQPackage">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
</script>


<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/objective_package_script.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multi-select.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/tag-it.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript">
   $("#btnMakeCombo").on("click",function () {
     $("#comboForm").toggle();
     $(".addCheck").toggle();
   });

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

    $(document).ready(function() {
      $("#comboForm").hide();
        load_objective_package("#mcq_packages");
      $("#btnCreateCombo").on("click", function () {
        
      });  
    });
</script>
