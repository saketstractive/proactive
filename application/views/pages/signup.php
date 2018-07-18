<div class="row">
    <div class="col-md-8">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Not a registered user? Register Now!</h3>
          </div>
          <div class="panel-body">
            <form role="form" name="register_user" id="register_user" action="<?php echo site_url('site/registration'); ?>" method="POST">

                <p class="text-muted help-block">
                    Following form is all about your profile details.<br />Please fill it properly.<br />
                    All fields are mandatory.
                </p>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Full Name</label>
                          <input type="text" class="form-control" name="fullname" id="fullname" placeholder="firstname surname" autofocus>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Stream</label>
                          <select name="stream" id="stream" class="form-control">
                              <option selected hidden value="">Select Appropriate Stream</option>
                          </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" class="form-control" name="email" id="email" placeholder="example@domain.com">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Mobile Number</label>
                          <input type="text" class="form-control" name="contact" id="contact" placeholder="98xxx xx210">
                          <!-- <p class="help-block">No need to enter country code (+91).</p> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>

                </div>

                <!-- <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-success" role="alert">
                          <i class="fa fa-check-circle"></i> Registered Successfully.
                      </div>

                      <div class="alert alert-danger" role="alert">
                          <i class="fa fa-times-circle"></i> Error Occurred.
                      </div>
                  </div>
                </div> -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <input type="submit" id="signup" value="Sign Up" class="btn btn-primary" />
                        </div>
                    </div>
                </div>

            </form>
          </div>

          <div class="panel-footer">
            <a role="button" data-toggle="modal" data-target="#SignInModal">Already a registered user? Login to your account.</a>
          </div>

        </div>

    </div>

    <div class="col-md-4">
        <img src="<?php echo base_url('assets/images/300x250.jpg'); ?>" class="img-responsive" />
        <div class="m-b-20"></div>
        <img src="<?php echo base_url('assets/images/300x250.jpg'); ?>" class="img-responsive" />
    </div>
</div>

<script type="text/javascript">

  var site_url = "<?php echo site_url(); ?>";
  var base_url = "<?php echo base_url(); ?>";

</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/validation_script.js'); ?>"></script>
