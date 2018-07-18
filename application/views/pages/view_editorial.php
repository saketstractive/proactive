<?php // echo $ed_data[0]["ed_desc"]; ?>

<div class="row">

	<div class="col-lg-12">

		<ol class="breadcrumb white-bg">
		  	<li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		  	<li><a href="<?php echo site_url('admin/editorial'); ?>">Editorial</a></li>
        <li class="active">View Editorial</li>
		</ol>

	</div>

</div>

<div class="row">

	<div class="col-lg-12">

		<div class="panel panel-default">
		  	<div class="panel-body">
            <p class="lead">
                <strong>
                  <?php echo $ed_data[0]["ed_title"]; ?>
                </strong>
            </p>

            <p>
                <?php echo $ed_data[0]["ed_desc"]; ?>
            </p>

            <span>
                Status : <strong><?php echo $ed_data[0]["status"] = 1 ? "<div class='text-success'>Published</div>" : "<div class='text-danger'>Not Published</div>" ; ?></strong>
            </span>
            <br />
            <span>
                Published on : <strong><?php echo $ed_data[0]["published_on"]; ?></strong>
            </span>
            <br />
            <span>
                Last updated on : <strong><?php echo $ed_data[0]["updated_on"]; ?></strong>
            </span>
		  	</div>

        <div class="panel-footer">
            <a href="<?php echo site_url('admin/editorial'); ?>" class="no_anchor_decoration"><i class="fa fa-reply"></i> Go to previous page</a>
        </div>
		</div>

	</div>

</div>
