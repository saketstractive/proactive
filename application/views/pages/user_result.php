<div class="row">
    <div class="col-lg-8">

        <div class="panel panel-default">

            <div class="panel-heading">
                Your Results
            </div>

            <div class="panel-body">
                <?php

                    if (count($result_list) == 0) {
                      echo '<div class="text-center m-t-20 m-b-30"><p class="lead text-muted">It seems that you didn\'t attempted anything yet!</p></div>';
                    } else {
                      $count = 0;
                      echo '<table class="table table-bordered table-hover table-striped text-center">';
                      echo "<tr><th>#</th><th>Package Name</th><th>Score</th><th>Time</th></tr>";
                      foreach ($result_list as $value) {
                          $count = $count + 1;
                    $url = site_url('user/view_solution/')."/".$value['rid'];
                          echo "<tr>";
                          echo "<td>".$count."</td><td>".strtoupper($value['p_name'])."</td><td>".$value['score']."<BR /><a href='$url'>Explain</a></td><td>".$value['created_on']."</td>";
                          echo "</tr>";
                      }
                      echo "</table>";
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
