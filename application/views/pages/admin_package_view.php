<?php
foreach ($package_detail as $value) {

    $doc_list = $value["p_smlist"];

 ?>
<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('admin/packages'); ?>" class="no_anchor_decoration">Create & Manage Packages</a></li>
        <li class="active">View Package</li>
		</ol>

	</div>

</div>
<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">

			<div class="panel-heading"><span class="text-primary"><i class="fa fa-plus-circle"></i> Package <strong>details</strong></span></div>

		  	<div class="panel-body">

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
                  <button class="btn btn-default btn-lg" type="button"><?php echo $value["p_duration"];?>&nbsp;<span class="badge">days</span>
                  </button>
                  <button class="btn btn-default btn-lg" type="button">Rs. <?php echo $value["p_cost"];?> /-&nbsp;<span class="badge">INR</span>
                  </button>
              </div>
          </div>
          <?php

              if ($value['p_type'] == 0) {

          ?>
					<div class="row m-t-20">
						<div class="col-lg-12">
							<p class="lead">
									Document(s) attached with this package
							</p>
              <div id="doc_list"></div>
							<!-- <a href="#" class="btn btn-default">CMA Part 1 Notes</a>
							<a href="#" class="btn btn-default">File Name</a>
							<a href="#" class="btn btn-default">File Name</a> -->
						</div>

					</div>

          <?php 
              }
           ?>

		  	</div>
        <div class="panel-footer">
          <a href="<?php echo site_url('admin/packages'); ?>" class="no_anchor_decoration"><i class="fa fa-mail-reply"></i> Back</a>
        </div>
		</div>

	</div>

</div>
<?php } ?>

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/package_script.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var doc_list_str = "<?php echo $doc_list; ?>";
        var doc_list_arr = doc_list_str.split(",");
        doc_list_arr.forEach(function(element, index) {
            get_doc_info(element, "#doc_list");
        });
    });
</script>
