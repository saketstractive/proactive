<div class="row">

  <div class="col-lg-12">

    <ol class="breadcrumb white-bg">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="<?php echo site_url('admin/subscribers'); ?>" class="no_anchor_decoration">Subscribers</a></li>
        <li class="active">Compose and Send Emails</li>
    </ol>

  </div>

</div>

<div class="row">

  <div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Compose an email</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                      <label>From : </label>
                      <input type="text" class="form-control" id="from" placeholder="noreply@prathampass.com" value="noreply@prathampass.com" readonly="readonly" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                      <label>Subject : </label>
                      <input type="text" class="form-control" id="subject" placeholder="give some appropriate subject" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                      <label>Send to : </label>
                      <input type="text" class="form-control" id="sendto" value="<?php echo $email_list; ?>" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                      <label>Message : </label>
                      <textarea name="message" id="message" class="form-control" rows="8" cols="80" placeholder="write your message here..." required></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-primary btn-lg" id="btn_send">Send</button>
                    <a href="<?php echo site_url('admin/subscribers'); ?>" class="btn btn-primary btn-lg">Cancel</a>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <a href="<?php echo site_url('admin/subscribers'); ?>" class="no_anchor_decoration"><i class="fa fa-reply"></i> Back to previous page</a>
        </div>
    </div>
  </div>

</div>

<script type="text/javascript">

    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";

</script>

<script src="<?php echo base_url('assets/js/app.js') ?>"></script>

<script type="text/javascript">

    $(document).ready(function() {
      $('#message').summernote({
          height: 200
        });
    });

    $("#btn_send").on("click", function() {
        var subject = $("#subject").val();
        var sendto = $("#sendto").val();
        var message = $("#message").val();

        if (subject !== "" && sendto !== "" && message !== "") {
          $.ajax({
              url: site_url+'admin/send_email',
              type: "POST",
              dataType: "text",
              data: {"subject" : subject, "sendto" : sendto, "message" : message},
              beforeSend: function() {
                $("#btn_send").text('Sending...');
                $("#btn_send").prop('disabled', true);
              },
              success: function(response) {
                  if (response == 1) {

                      toastr.options.timeOut = 5000;
                      toastr.options.positionClass = "toast-bottom-right";
                      toastr.success('Email sent successfully.');

                  } else if (response == 0) {

                      toastr.options.timeOut = 5000;
                      toastr.options.positionClass = "toast-bottom-right";
                      toastr.error('Some error occurred. Please try again.');

                  }
              },
              complete: function() {
                $("#btn_send").prop('disabled', false);
                $("#btn_send").text('Send');
              },
              error: function(error) {
                  console.log(error);
              }
          });
        } else {
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-bottom-right";
            toastr.error('All fields are mandatory.');
        }
    });
</script>
