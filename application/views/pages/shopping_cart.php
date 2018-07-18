<div class="row">
    <div class="col-lg-8">

        <div class="panel panel-default">

            <div class="panel-heading">
                Checkout your cart
            </div>

            <div class="panel-body">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center" id="cart_data"></table>
                    <div class="m-t-b-20 text-right">
                        <div class="lead" id="total_amount"></div>
                        <form action="<?php echo site_url('user/review'); ?>" method="post">
                            <?php 
                                foreach ($userdata[0] as $key => $value) {
                            ?>  
                                  
                            <input type="hidden" name="<?= $key ?>" id="<?= $key ?>" value="<?= $value ?>">
                            
                            <?php  
                                }
                             ?>
                            <div class="row">
                              
                                <div class="col-lg-6 text-left m-t-b-10">
                                  <div class="form-inline">
                                    <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter your coupon code" />
                                    <a type="button" class="btn btn-default" id="btnCheckCoupon">Apply <i class="fa fa-angle-double-right"></i></a>
                                  </div>
                                </div>
                                <div class="col-lg-6 text-right m-t-b-10">
                                    <input type="hidden" name="amount" id="amount" value="">
                                    <input type="submit" value="Checkout" class="btn btn-primary" />
                                </div>

                            </div>
                        </form>
                        <!-- <button type="button" class="btn btn-primary" id="btnCheckout">Checkout <i class="fa fa-angle-double-right"></i></button> -->
                    </div>
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

<!-- Cart Item Delete Modal -->
<div class="modal fade delete-cart-item-modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-sm" role="document">
    	<div class="modal-content" style="padding: 20px;">
     		<div class="text-center">
     			<i class="fa fa-question-circle" style="font-size: 42px;"></i>
     			<p class="lead">
     				Are you sure you want to delete this item?
     			</p>
     			<button class="btn btn-danger" id="deleteCartItem">Delete</button>&nbsp;&nbsp;<button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
     		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var val_id = "<?php echo $this->session->userdata('uid'); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/cart.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        load_user_cart_item("#cart_data", "<?php echo $this->session->userdata('uid'); ?>");

        $("#btnCheckCoupon").click(function() {
            var code = $("#coupon_code").val();

            if (code != "") {
              $.get(site_url+"user/check_coupon_avail", {"code" : code}, function(response) {
                var obj = jQuery.parseJSON(response);
                var discount = 0;
                var type = 0;
                $.each(obj, function(i, value) {
                    discount = value['coupon_disc'];
                    type = value['coupon_type'];
                });

                ////By SAKET
                var adjustment = 0;
                var compl = 100 - discount; 

                if (discount > 1) {
                  var total = $("#amount").val();
                  var cumdisc = 0;

                  $(".ptype"+type).each(function () {
                var current = parseInt($(this).html());
                
                    cumdisc +=  current * compl / 100;
                    // console.log("substracted "+cumdisc);
                  });  

                  var new_amt = total - cumdisc;

                  $("#total_amount").html('Total : <strike>'+total+'</strike> <strong>Rs. '+new_amt+' /-</strong>');
                  $("#amount").val(new_amt);

                  $("#btnCheckCoupon").hide();

                  toastr.options.timeOut = 5000;
                  toastr.options.positionClass = "toast-bottom-right";
                  if (type==0) {
                  toastr.success('You got discount on online material!');
                    }
                  else {
                  toastr.success('You got discount on USB items!');
                    }  

                } else {
                    toastr.options.timeOut = 5000;
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.error('This coupon is either invalid or expired.');
                }
              });
            } else {
                toastr.options.timeOut = 5000;
                toastr.options.positionClass = "toast-bottom-right";
                toastr.error('Please enter coupon code first.');
            }

        });
    });
</script>
