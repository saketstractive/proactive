<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default p-t-b-20">
		  	<div class="panel-body">

		  		<div class="row">

		  			<div class="col-lg-10 col-lg-offset-1">

			    		<?php

			    			if ($error_status == 0) {

			    		?>

			    			<h1 style="font-size: 50px; color: #777;" class="m-b-20">Registration Successful</h1>

	 			    		<p class="text-muted" style="font-size: 20px;">
	 			    			Thank you for registering with us.<br />
	 			    			You will receive an email on your registered email address.<br /><br />
	 			    			Please check your email to verify your account.<br />
	 			    			Please check your <em>Spam/Junk</em> folder for the verification email, if you didn't find it in your <em>Inbox</em>.
	 			    		</p>

	 			    		<p class="text-muted" style="font-size: 20px;">
	 			    			<a data-toggle="modal" data-target="#SignInModal" style="cursor: pointer;">Click here</a> to sign in to your account.
	 			    		</p>


			    		<?php

			    			} else if ($error_status == 1) {

			    		?>

			    			<h1 style="font-size: 50px; color: #777;" class="m-b-20">Registration Failed</h1>

				    		<p class="text-muted" style="font-size: 20px;">
				    			An error occurred during your registration.<br /><br />
				    			Please try again after sometime.<br />
				    		</p>

				    		<p class="text-muted" style="font-size: 20px;">
				    			<a href="<?php echo site_url('site/signup'); ?>">Back</a> to sign up form.
				    		</p>

			    		<?php

			    			}

			    		 ?>

		  			</div>

		  		</div>

		  	</div>
		</div>

	</div>

</div>
