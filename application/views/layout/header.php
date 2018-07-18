 <div id="modalPass" class="modal">
        <div class="modal-content white center">
        <form action="<?php echo site_url('user/change_password'); ?>" method="POST" id="formChange">
          <h4>Change Password</h4>
          <div class="container">
            <div class="row">
              <div class="col s6 offset-s3 m6 offset-m3 l6 offset-l3 input-field">
                <input type="password" name="newPass" id="newPass" placeholder="New Password" /> 
                <i class="fa fa-eye prefix" id="newEye"></i>
              </div>
              <div class="col s6 offset-s3 m6 offset-m3 l6 offset-l3 input-field">
                <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" />
                <p id="error" class="red-text"><i class="fa fa-close" ></i> Confirm Password do not match</p>
              </div>
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <a class="left modal-action modal-close waves-effect waves-green btn">Close</a>
          <a href="#" id="btnChange" class="modal-action waves-effect waves-green btn">Change</a>
        </div>
      </div>

 <?php if ($this->session->has_userdata('user_type') && $this->session->userdata('user_type')==0 ) { ?>
 <nav class="blue lighten-2">
        <div class="nav-wrapper">
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a onclick="show_menu('#project')"><i class="fa fa-th-large"></i> Project</a></li>
            <li><a onclick="show_menu('#resource')"> <i class="fa fa-user"></i> Resources</a></li>
            <li><a onclick="show_menu('#accounts')"><i class="fa fa-rupee"></i> Accounts</a></li>
            <li><a onclick="show_menu('#work')"><i class="fa fa-clock-o"></i> Timesheet</a></li>
            <li><a id="btnChangePass" href="#"><i class="fa fa-lock"></i> Password</a></li>
            <li><a href="<?php echo site_url('site/sign_out'); ?>"><span class="chip">Logout</span></a></li>
          </ul>
          
          <div class="navbar-brand" >
            <h4 style="padding-left: 5px;" class="left black-text">Pro<span class="red-text text-darken-2">a</span>ctive</h4>
            <!-- <img class="responsive-img" src="<?php echo base_url('assets/images/logo.png'); ?>" height="64px !important"/> -->
        </div>
        </div>
      </nav>
    <!-- </div> -->

   <nav class="transparent white-text extra-nav" id="blank" style="-webkit-box-shadow:none !important; box-shadow:none !important; ">
        <div class="nav-wrapper">
          <ul id="nav-mobile0" class="hide-on-med-and-down">
            <li class="right white-text"><a ></a></li>
            <li class="right white-text"><a ></a></li>
          </ul>
        </div>
      </nav>

    <nav class="blue lighten-2 extra-nav" id="project">
        <div class="nav-wrapper">
          <ul id="nav-mobile1" class="hide-on-med-and-down">
            <li class="right"><a href="<?php echo site_url('user/view_projects'); ?>"> <i class="fa fa-list"></i> List Projects</a></li>
            <li class="right"><a href="<?php echo site_url('user/add_project'); ?>"><i class="fa fa-plus"></i> Add Project</a></li>
          </ul>
        </div>
      </nav>
    
      <nav class="blue lighten-2 extra-nav" id="resource">
        <div class="nav-wrapper">
          <ul id="nav-mobile2" class="hide-on-med-and-down">
            <li class="right"><a href="<?php echo site_url('user/view_resources'); ?>"> <i class="fa fa-list"></i> List Resources</a></li>
            <li class="right"><a href="<?php echo site_url('user/add_resource'); ?>"><i class="fa fa-plus"></i> Add Resource</a></li>
          </ul>
        </div>
      </nav>
    
      <nav class="blue lighten-2 extra-nav" id="accounts">
        <div class="nav-wrapper">
          <ul id="nav-mobile3" class="hide-on-med-and-down">
            <li class="right"><a href="<?php echo site_url('user/reports'); ?>"> <i class="fa fa-list"></i> Reports</a></li>
            <li class="right"><a href="<?php echo site_url('user/add_invoices'); ?>"> <i class="fa fa-sticky-note"></i> Invoices</a></li>
            <li class="right"><a href="<?php echo site_url('user/view_expenses'); ?>"> <i class="fa fa-money"></i> Expenses</a></li>
            <!-- <li class="right"><a href="<?php echo site_url('user/add_expenses'); ?>"><i class="fa fa-plus"></i> My Expenses</a></li> -->
          </ul>
        </div>
      </nav>

      <nav class="blue lighten-2 extra-nav" id="work">
        <div class="nav-wrapper">
          <ul id="nav-mobile4" class="hide-on-med-and-down">
            <li class="right"><a href="<?php echo site_url('user/view_timesheet'); ?>"><i class="fa fa-th-large"></i> Project History</a></li>
            <li class="right"><a href="<?php echo site_url('user/approve_timesheet'); ?>"><i class="fa fa-check"></i>Approvals</a></li>
            <li class="right"><a href="<?php echo site_url('user/update_timesheet'); ?>"> <i class="fa fa-calendar"></i>  Update Timesheet</a></li>
          </ul>
        </div>
      </nav>
      <?php } 
      else if ($this->session->userdata('uid')) { ?>
 <nav class="blue lighten-2">
        <div class="nav-wrapper">
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <!-- <li><a onclick="show_menu('#project')"><i class="fa fa-th-large"></i> Project</a></li>
            <li><a onclick="show_menu('#resource')"> <i class="fa fa-user"></i> Resources</a></li> -->
            <li><a onclick="show_menu('#accounts')"><i class="fa fa-rupee"></i> Accounts</a></li>
            <li><a onclick="show_menu('#work')"><i class="fa fa-clock-o"></i> Timesheet</a></li>
            <li><a href="<?php echo site_url('site/sign_out'); ?>"><span class="chip">Logout</span></a></li>
          </ul>
          
          <div class="navbar-brand" >
            <h4 style="padding-left: 5px;" class="left black-text">Pro<span class="red-text text-darken-2">a</span>ctive</h4>
            <!-- <img class="responsive-img" src="<?php echo base_url('assets/images/logo.png'); ?>" height="64px !important"/> -->
        </div>
        </div>
      </nav>
    <!-- </div> -->

   <nav class="transparent white-text extra-nav" id="blank" style="-webkit-box-shadow:none !important; box-shadow:none !important; ">
        <div class="nav-wrapper">
          <ul id="nav-mobile0" class="hide-on-med-and-down">
            <li class="right white-text"><a ></a></li>
            <li class="right white-text"><a ></a></li>
          </ul>
        </div>
      </nav>

    <nav class="blue lighten-2 extra-nav" id="project">
        <div class="nav-wrapper">
          <ul id="nav-mobile1" class="hide-on-med-and-down">
            <li class="right"><a href="<?php echo site_url('user/view_projects'); ?>"> <i class="fa fa-list"></i> List Projects</a></li>
          </ul>
        </div>
      </nav>
    
      <nav class="blue lighten-2 extra-nav" id="resource">
        <div class="nav-wrapper">
          <ul id="nav-mobile2" class="hide-on-med-and-down">
            <li class="right"><a href="<?php echo site_url('user/view_resources'); ?>"> <i class="fa fa-list"></i> List Resources</a></li>
          </ul>
        </div>
      </nav>
    
      <nav class="blue lighten-2 extra-nav" id="accounts">
        <div class="nav-wrapper">
          <ul id="nav-mobile3" class="hide-on-med-and-down">
            <li class="right"><a href="<?php echo site_url('user/add_expenses'); ?>"><i class="fa fa-plus"></i> Add Expenses</a></li>
          </ul>
        </div>
      </nav>

      <nav class="blue lighten-2 extra-nav" id="work">
        <div class="nav-wrapper">
          <ul id="nav-mobile4" class="hide-on-med-and-down">
            <li class="right"><a href="<?php echo site_url('user/view_timesheet'); ?>"><i class="fa fa-list"></i> Project History</a></li>
            <li class="right"><a href="<?php echo site_url('user/approve_timesheet'); ?>"><i class="fa fa-check"></i>Approvals</a></li>
            <li class="right"><a href="<?php echo site_url('user/update_timesheet'); ?>"> <i class="fa fa-calendar"></i> Update Timesheet</a></li>
          </ul>
        </div>
      </nav>
      <?php } ?>