<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo site_url('site/packages'); ?>"><i class="fa fa-cogs"></i> Packages</a></li>
        <li><a href="<?php echo site_url('site/editorials'); ?>"><i class="fa fa-pencil-square"></i> Editorials</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-play-circle"></i> Video Lectures <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('site/videos'); ?>">Free Video Lectures</a></li>
            <li><a href="<?php echo site_url('site/premium_videos'); ?>">Premium Video Lectures</a></li>
          </ul>
        </li>
       <?php
       /*
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-tasks"></i> Facilities <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <!-- <li><a href="#">Students</a></li> -->
            <li><a href="<?php echo site_url('site/content_writer'); ?>">Content Writer</a></li>
            <li><a href="<?php echo site_url('site/recruitment'); ?>">Recruitment</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('site/certification'); ?>">Certification</a></li>
          </ul>
        </li>
       */
       ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i> Books <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('site/ebooks'); ?>">Free E-books</a></li>
            <li><a href="<?php echo site_url('site/reviews'); ?>">Book Reviews</a></li>
          </ul>
        </li>
        <li><a href="<?php echo site_url('site/contact'); ?>"><i class="fa fa-comments"></i> Contact</a></li>
        <!-- <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge" id="cart_item">0</span></a></li> -->
        <li style="padding-left: 10px;"><a class="btn btn-default" role="button" type="button" data-toggle="modal" data-target="#SignInModal"><i class="fa fa-sign-in"></i> Sign in</a></li>
        <li style="padding-left: 10px;"><a href="<?php echo site_url("site/signup"); ?>" class="btn btn-default" role="button"><i class="fa fa-user-plus"></i> Sign up</a></li>
        <!-- <li><a href="#"><i class="fa fa-shopping-cart"></i> Cart <span class="badge">3</span></a></li> -->
    </ul>
</div>
<!-- /.navbar-collapse -->
