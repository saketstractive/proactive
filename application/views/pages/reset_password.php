<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">Reset Password</h3>
            </div>

            <div class="panel-body">
                  <p class="help-block">
                      Please provide your new password and confirm your new password
                  </p>

                  <div class="form-group">
                      <label>New Password</label>
                      <input type="password" class="form-control" name="new_password" id="new_password" autofocus required autocomplete="off">
                  </div>

                  <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" name="confirm_password" id="confirm_password" required autocomplete="off">
                  </div>

                  <button id="btnResetPassword" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset Password</button>
            </div>

            <div class="panel-footer">
                <a class="btn btn-default" href="<?php echo site_url("site/"); ?>" role="button"><i class="fa fa-reply"></i> Go to Home Page</a>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#btnResetPassword").click(function() {

            var new_password = $("#new_password").val();
            var confirm_password = $("#confirm_password").val();
            var k = "<?php echo $this->input->get("token"); ?>";

            if (new_password != "" && confirm_password != "" && k != "") {
                if (new_password == confirm_password) {

                  $.ajax({
                      type: "POST",
                      url: '<?php echo site_url("site/reset_user_password"); ?>',
                      dataType: "text",
                      data: {"k": k, "new_password" : new_password},
                      crossDomain: true,
                      cache: false,
                      success: function(response) {
                        if (response == 1) {

                          toastr.options.timeOut = 5000;
                          toastr.options.positionClass = "toast-bottom-right";
                          toastr.success("Password changed successfully.");

                        } else if(response == 0) {

                          toastr.options.timeOut = 5000;
                          toastr.options.positionClass = "toast-bottom-right";
                          toastr.error("Error Occurred. Please try again later.");

                        }

                      },
                      complete: function() {
                          $("#new_password").val("");
                          $("#confirm_password").val("");
                      },
                      error: function(error) {
                          console.log(error);
                      }
                  });

                } else {

                  toastr.options.timeOut = 5000;
                  toastr.options.positionClass = "toast-bottom-right";
                  toastr.error("Both password and confirm password must be same.");

                }

            } else {

              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.error('All fields are mandatory. Please try again.');

            }

        });
    });
</script>
