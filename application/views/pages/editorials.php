<div class="row">
    <div class="col-md-8">

        <div class="panel panel-default">
          <div class="panel-body">

            <?php

                if(count($ed_data) > 0) {

                    foreach ($ed_data as $value) {

            ?>

                          <div class="row">
                            <div class="col-lg-12">
                              <p class="lead">
                                <strong><?php echo $value['ed_title']; ?></strong>
                              </p>

                              <p><?php echo $value['ed_desc']; ?></p>
                              <p class="text-muted">
                                <i class="fa fa-clock-o"></i> Published on <?php echo $value['published_on']; ?>
                              </p>
                            </div>
                          </div>
                          <hr>

            <?php

                    }

                } else {
                    echo '<p class="lead text-center text-muted m-t-b-100"><i class="fa fa-frown-o"></i> No articles available at this moment</p>';
                }

             ?>

          </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="text-center m-b-10">
          <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" />
        </div>

        <div class="text-center m-b-10">
          <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" />
        </div>
    </div>
</div>
