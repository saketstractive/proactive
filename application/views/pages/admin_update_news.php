<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<!-- <li><a href="#">Home</a></li>
		  	<li><a href="#">Library</a></li> -->
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li><a href="<?php echo site_url('admin/news'); ?>">News</a></li>
		  	<li class="active">Update News</li>
		</ol>

	</div>

</div>


<?php

	if (isset($news_data) && !empty($news_data)) {
		foreach ($news_data as $item) {
			$news_id = $item["news_id"];
			$news_title = $item["news_title"];
			$news_desc = $item["news_desc"];
		}
	}


 ?>


<div class="row">

	<div class="col-md-12">

		<div class="panel panel-default">
		  	<div class="panel-heading">
		    	<h3 class="panel-title">Update News</h3>
		  	</div>
		  	<div class="panel-body">

		  		<div class="form-group">
				    <label>News Title</label>
				    <input type="text" class="form-control" id="update_news_title" name="update_news_title" value="<?php echo $news_title; ?>" autofocus>
				</div>

				<div class="form-group">
				    <label>Description</label>
				    <textarea id="update_news_desc" name="update_news_desc" class="form-control"></textarea>
				</div>

				<input type="hidden" name="news_id" id="news_id" value="<?php echo $news_id; ?>">

				<div class="form-group">
				    <button class="btn btn-primary" id="btnUpdateNews">Update</button>
				</div>
		  	</div>
		</div>

	</div>

</div>


<script type="text/javascript">

	$(document).ready(function() {
		var news_desc = "<?php echo $news_desc; ?>";
		$('#update_news_desc').summernote('code', news_desc);
	});

	var site_url = "<?php echo site_url(); ?>";
	var base_url = "<?php echo base_url(); ?>";

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/news_script.js'); ?>"></script>
