<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">Recruitment</li>
		</ol>

	</div>

</div>

<div class="row">

	<div class="col-lg-8">

		<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Publish Recruitment News</h3>
        </div>
		  	<div class="panel-body">
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" id="title" name="title" autofocus>
						</div>

						<div class="form-group">
							<label>Description</label>
							<textarea id="desc" name="desc" class="form-control"></textarea>
						</div>

						<div class="form-group">
							<button class="btn btn-primary" id="btnPublishRecruitmentNews">Publish</button>
						</div>
		  	</div>
		</div>

	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Recently Published Recruitment News</h3>
        </div>
		  	<div class="panel-body">
						<div id="published_news"></div>
		  	</div>
				<div class="panel-footer">
						<a href="<?php echo site_url('admin/view_recruitment_news'); ?>">Click here to view all...</a>
				</div>
		</div>

	</div>

</div>

<script type="text/javascript">
		var site_url = "<?php echo site_url(); ?>";
		var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/recruitment_news_script.js'); ?>"></script>

<script type="text/javascript">
		load_recruitment_news("#published_news");
</script>
