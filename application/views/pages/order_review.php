<div class="row">
    <div class="col-lg-8">

        <div class="panel panel-default">

            <div class="panel-heading">
                Review your order
            </div>

            <div class="panel-body">
                
                <div class="table-responsive">
                	<form action="<?php echo $action; ?>" method="POST" name="payuForm">
                		<table class="table table-bordered table-hover text-center">
	                    	<tr>                    		
	                    		<td>Full Name</td>
	                    		<td><?= $posted['firstname'] ?></td>
	                    	</tr>
	                    	<tr>                    		
	                    		<td>Email</td>
	                    		<td><?= $posted['email'] ?></td>
	                    	</tr>
	                    	<tr>                    		
	                    		<td>Contact</td>
	                    		<td><?= $posted['phone'] ?></td>
	                    	</tr>
	                    	<tr>                    		
	                    		<td>Amount</td>
	                    		<td><?= $posted['amount'] ?></td>
	                    	</tr>
	                    	<tr>                    		
	                    		<td>Industry Type</td>
	                    		<td><?= $posted['productinfo'] ?></td>
	                    	</tr>
                            <tr>
                                <td>Address</td>
                                <td><?= $address?> <BR/> <a href="profile" class="badge">Edit Profile</a></td>
                            </tr>
	                    </table>

	                    <?php 
                                foreach ($posted as $key => $value) {
                        ?>  
                              
                        			<input type="hidden" name="<?= $key ?>" id="<?= $key ?>" value="<?= $value ?>">
                        
                        <?php  
                            }
                         ?>
                         <div class="pull-right">
			            	<a href="<?php echo site_url('user/cart'); ?>" class="btn btn-default">Back to Cart</a>
                         	<input type="submit" value="Pay Now" class="btn btn-primary" />
                         </div>

                         <div class="clearfix"></div>

                	</form>
                </div>
            </div>

        </div>

    </div>

    <div class="col-md-4">
        <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" />
        <div class="m-b-20"></div>
        <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" />
    </div>
</div>