<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo site_url('user/'); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="<?php echo site_url('site/editorials'); ?>"><i class="fa fa-pencil-square"></i> Editorials</a></li>
        <li><a href="<?php echo site_url('user/bagpack'); ?>"><i class="fa fa-book"></i> Bag Pack</a></li>
        <li><a href="<?php echo site_url('site/packages'); ?>"><i class="fa fa-pencil-square-o"></i> Packages</a></li>
        <li><a href="<?php echo site_url('user/result'); ?>"><i class="fa fa-pencil-square-o"></i> Result</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-play-circle"></i> Video Lectures <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('site/videos'); ?>">Free Video Lectures</a></li>
            <li><a href="<?php echo site_url('site/premium_videos'); ?>">Premium Video Lectures</a></li>
          </ul>
        </li>
        <li><a href="<?php echo site_url('user/cart'); ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge" id="cart_item">0</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $this->session->userdata('fullname'); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('user/profile'); ?>">User Profile</a></li>
            <!-- <li role="separator" class="divider"></li> -->
            <li><a href="<?php echo site_url('user/sign_out'); ?>">Sign out</a></li>
          </ul>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->


<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

<script type="text/javascript">
    count_user_cart("#cart_item", "<?php echo $this->session->userdata('uid'); ?>");
</script>
