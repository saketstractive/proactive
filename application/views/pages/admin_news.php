<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<!-- <li><a href="#">Home</a></li>
		  	<li><a href="#">Library</a></li> -->
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li class="active">News</li>
		</ol>

	</div>

</div>


<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">
		  	<div class="panel-body">
		    	<div id="news_list"></div>
		  	</div>
		</div>

	</div>

</div>

<!-- Stream Delete Modal -->
<div class="modal fade delete-news-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteNews">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/news_script.js'); ?>"></script>

<script type="text/javascript">

	$(document).ready(function() {
		load_news_list("#news_list");
	});

</script>
