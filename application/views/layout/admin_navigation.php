<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users"></i> Customer<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('admin/subscribers'); ?>">Subscribers</a></li>
            <li><a href="<?php echo site_url('admin/orders'); ?>">Orders</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sitemap"></i> Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('admin/stream'); ?>">Manage Streams</a></li>
            <li><a href="<?php echo site_url('admin/category'); ?>">Manage Categories</a></li>
            <li><a href="<?php echo site_url('admin/subcategory'); ?>">Manage Sub-categories</a></li>
            <li><a href="<?php echo site_url('admin/subject'); ?>">Manage Subjects</a></li>
            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> Packages <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('admin/packages'); ?>">Subjective</a></li>
            <li><a href="<?php echo site_url('admin/mcq_packages'); ?>">Objective (MCQ)</a></li>
            <li><a href="<?php echo site_url('admin/video_packages'); ?>">Premium Videos</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-upload"></i> Upload <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('admin/study_material'); ?>">Study Material</a></li>
            <li><a href="<?php echo site_url('admin/upload_posters'); ?>">Upload Posters</a></li>
            <li><a href="<?php echo site_url('admin/question_bank'); ?>">Question Bank</a></li>
            <li><a href="<?php echo site_url('admin/ebooks'); ?>">Free E-Books</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt"></i> More <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('admin/news'); ?>">News</a></li>
            <li><a href="<?php echo site_url('admin/editorial'); ?>">Editorial</a></li>
            <li><a href="<?php echo site_url('admin/recruitment'); ?>">Recruitment</a></li>
            <li><a href="<?php echo site_url('admin/testimonial'); ?>">Testimonial</a></li>
            <li><a href="<?php echo site_url('admin/coupons'); ?>">Coupons</a></li>
            <li><a href="<?php echo site_url('admin/videos'); ?>">Videos</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username'); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('admin/sign_out'); ?>">Sign out</a></li>
          </ul>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->
