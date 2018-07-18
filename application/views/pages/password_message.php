
<div class="row">

	<div class="col s12">

		<div class="card">

		  		<div class="row">

		  			<div class="col s10 offset-s1">

			    		<?php

			    			if ($error_status == 0) {

			    		?>

			    			<h1>Login Failed!</h1>

                <p class="text-muted">
				    			Invalid User/Password.<br /><br />
				    			Please try again.<br />
				    		</p>

	 			    		<p class="text-muted">
	 			    			<a href="<?php echo base_url('/'); ?>" >Click here</a> to sign in to your account.
	 			    		</p>


			    		<?php

            } ?>

		  			</div>

		  		</div>

		  	
		</div>

	</div>

</div>
