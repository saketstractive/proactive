<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<!-- <li><a href="#">Home</a></li>
		  	<li><a href="#">Library</a></li> -->
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li><a href="<?php echo site_url('admin/recruitment'); ?>">Recruitment</a></li>
		  	<li class="active">Update Recruitment</li>
		</ol>

	</div>

</div>


<?php

	if (isset($news_data) && !empty($news_data)) {
		foreach ($news_data as $item) {
			$recruit_id = $item["recruit_id"];
			$recruit_title = $item["recruit_title"];
			$recruit_desc = $item["recruit_desc"];
		}
	}


 ?>


<div class="row">

	<div class="col-md-12">

		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Update Recruitment News</h3>
		  	</div>
		  	<div class="panel-body">

		  		<div class="form-group">
				    <label>Title</label>
				    <input type="text" class="form-control" id="update_recruit_title" name="update_recruit_title" value="<?php echo $recruit_title; ?>" autofocus>
				</div>

				<div class="form-group">
				    <label>Description</label>
				    <textarea id="update_recruit_desc" name="update_recruit_desc" class="form-control"></textarea>
				</div>

				<input type="hidden" name="recruit_id" id="recruit_id" value="<?php echo $recruit_id; ?>">

				<div class="form-group">
				    <button class="btn btn-primary" id="btnUpdateRecruitmentNews">Update</button>
				</div>
		  	</div>
		</div>

	</div>

</div>


<script type="text/javascript">

	$(document).ready(function() {
		var recruit_desc = "<?php echo $recruit_desc; ?>";
		$('#update_recruit_desc').summernote('code', recruit_desc);
	});

	var site_url = "<?php echo site_url(); ?>";
	var base_url = "<?php echo base_url(); ?>";

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/recruitment_news_script.js'); ?>"></script>
