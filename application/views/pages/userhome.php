<div class="row">
    <div class="col-lg-8">

        <div class="panel panel-default">

            <div class="panel-heading">
                Your Recent Transactions
            </div>

            <div class="panel-body">
                <?php

                    if (count($recent_transactions) == 0) {
                      echo '<div class="text-center m-t-20 m-b-30"><p class="lead text-muted">It seems that you didn\'t purchase anything yet!</p></div>';
                    } else {
                      $count = 0;
                      echo '<table class="table table-bordered table-hover table-striped text-center">';
                      echo "<tr><th>#</th><th>Package Name</th><th>Price</th></tr>";
                      foreach ($recent_transactions as $value) {
                          $count = $count + 1;
                          echo "<tr>";
                          echo "<td>".$count."</td><td>".$value['p_name']."</td><td>Rs. ".$value['p_cost']."/-</td>";
                          echo "</tr>";
                      }
                      echo "</table>";
                    }

                 ?>
            </div>

        </div>

        <div class="panel panel-default">

            <div class="panel-heading">
                Recommended Packages
            </div>

            <div class="panel-body">
                <?php

                    foreach ($recommended_packages as $value) {
                        $desc = strlen($value["p_desc"]) > 150 ? substr($value["p_desc"],0,150)."..." : $value["p_desc"];
                        echo '<div class="col-sm-12 col-md-12"><div class="caption"><h3>'.$value["p_name"].'</h3><p>'.$desc.'</p><p><button type="button" data-id='.$value["pid"].' class="btn btn-primary btn-sm btnAddToCart"><strong><i class="fa fa-plus-circle"></i> Add to Cart</strong></button>&nbsp;&nbsp;<a href="'.site_url()."site/package_details/".$value["pid"].'" class="btn btn-default btn-sm"><i class="fa fa-external-link"></i> Details</a></p></div></div>';
                    }

                 ?>
            </div>

        </div>

    </div>

    <div class="col-md-4">
        <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" />
        <div class="m-b-20"></div>
        <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" />
    </div>
</div>


<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var val_id = "<?php echo $this->session->userdata('uid'); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/cart.js'); ?>"></script>
