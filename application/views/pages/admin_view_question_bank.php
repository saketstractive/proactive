<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Manage Question Bank</li>
		</ol>

	</div>

</div>


<div class="row">

	<div class="col-lg-9">

		<div class="panel panel-default">
				<div class="panel-heading"><span class="text-primary"><i class="fa fa-pencil-square-o"></i> Manage MCQ Questions</span></div>

				<div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover" id="question_bank"></table>
          </div>
		  	</div>

				<div class="panel-footer">
						<a href="<?php echo site_url('admin/question_bank'); ?>">Click here</a> to Upload Question Bank
				</div>
		</div>

	</div>

  <div class="col-md-3">
    <div class="list-group">
        <a href="<?php echo site_url('admin/question_bank'); ?>" class="list-group-item"><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp;Upload Question Bank</a>
        <a href="<?php echo site_url('admin/manage_question_bank'); ?>" class="list-group-item active"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Manage Question Bank</a>
        <a href="<?php echo site_url('admin/mcq_packages'); ?>" class="list-group-item"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;Create MCQ Package</a>
        <a href="<?php echo site_url('admin/manage_mcq_packages'); ?>" class="list-group-item"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Manage MCQ Package</a>
    </div>
  </div>


</div>

<!-- Question Edit Modal -->
<div class="modal fade update-question-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content" style="padding: 20px;">
        <div class="text-center">
          <i class="fa fa-question-circle" style="font-size: 42px;"></i>
          <p class="lead">
            This edit does not reflect to old scores of students.
          </p>
          

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

        
          <button class="btn btn-info" id="updateQuestion">Update</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
</div>

<!-- Question Delete Modal -->
<div class="modal fade delete-question-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteQuestion">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/question_bank_script.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        load_question_bank("#question_bank");
    });
    
    
</script>
