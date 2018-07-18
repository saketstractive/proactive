<div class="row">
    <div class="col-md-8">

        <div class="panel panel-default">
          <div class="panel-body">
              <?php

                  if (!empty($package_data)) {
                      foreach ($package_data as $value) {

                  ?>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                      <h1><?php echo $value["p_name"]; ?></h1>
                                      <span class="text-muted"><?php echo $value["stream"]." <i class='fa fa-angle-double-right'></i> ".$value["category"]." <i class='fa fa-angle-double-right'></i> ".$value["subcategory"]." <i class='fa fa-angle-double-right'></i> ".$value["subject"]; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <p>
                                            <?php echo $value["p_desc"];?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                  <button class="btn btn-default" type="button">Rs. <?php echo $value["p_cost"]; ?> /-&nbsp;<span class="badge">INR</span></button>
                                    <button class="btn btn-primary btnAddToCart" data-id="<?php echo $value["pid"]; ?>" type="button"><i class="fa fa-plus-circle"></i> Add to cart</button>
                                </div>
                            </div>

                  <?php

                      }
                  } else {
                      echo '<h4 class="text-muted text-center p-t-b-30">Package not found.<br /><a href="'.site_url("site/packages").'">Click here</a> to browse all packages.</h4>';
                  }


               ?>
          </div>
          <div class="panel-footer">
              <a href="<?php echo site_url('site/packages'); ?>" class="no_anchor_decoration">Click here to browse all packages</a>
          </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="text-center m-b-10">
          <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" class="img-responsive" />
        </div>

        <div class="text-center m-b-10">
          <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" class="img-responsive" />
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
