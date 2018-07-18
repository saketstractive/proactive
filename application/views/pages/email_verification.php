<div class="row">
		
	<div class="col-lg-12">

		<div class="jumbotron">
			  <?php 

			  		if (isset($msg) && !empty($msg)) {
			  			echo $msg;
			  		} else {
			  			redirect("site/");
			  		}
			  		

			   ?>
		</div>

	</div>

</div>