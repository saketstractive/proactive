<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">Forgot Password?</h3>
            </div>

            <div class="panel-body">
                  <p class="help-block">
                      Please provide your email address, so that we can send reset password link on your email address.
                  </p>

                  <div class="form-group">
                      <label>Your Email Address</label>
                      <input type="email" class="form-control" name="user_email" id="user_email" autofocus required autocomplete="off">
                  </div>

                  <button id="btnSendPasswordLink" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send Reset Password Link</button>
            </div>

            <div class="panel-footer">
                <a class="btn btn-default" href="<?php echo site_url("site/"); ?>" role="button"><i class="fa fa-reply"></i> Go to Home Page</a>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#btnSendPasswordLink").click(function() {

            var email = $("#user_email").val();

            if (email != "") {
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url("site/sendPasswordLink"); ?>',
                    dataType: "text",
                    data: {"email": email},
                    crossDomain: true,
                    cache: false,
                    success: function(response) {
                      if (response == 1) {

                        toastr.options.timeOut = 5000;
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.success("Password reset link is sent to your email address.");

                      } else if(response == 0) {

                        toastr.options.timeOut = 5000;
                        toastr.options.positionClass = "toast-bottom-right";
                        toastr.error("Error Occurred. Please try again later.");

                      }

                    },
                    complete: function() {
                        $("#user_email").val("");
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else {
              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.error('Please provide your email address.');
            }

        });
    });
</script>
