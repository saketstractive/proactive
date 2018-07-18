<div class="row">

  <div class="col-lg-12">

    <ol class="breadcrumb white-bg">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Subscribers</li>
    </ol>

  </div>

</div>

<div class="row">

  <div class="col-lg-8">
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Subscriber`s List</h3>
        </div>
        <div class="panel-body">
          <table class="table table-hover table-bordered" id="subscribers"></table>
        </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Filter subscribers by</h3>
        </div>
        <div class="panel-body">
          <ul>
              <li>
                  <div class="radio">
                    <label>
                      <p>
                        <input type="radio" name="filter" id="filter_all" value="all" checked>&nbsp;&nbsp;All
                      </p>
                    </label>
                  </div>
              </li>
              <li>
                  <div class="radio">
                    <label>
                      <p>
                        <input type="radio" name="filter" id="filter_non_premium" value="non_premium">&nbsp;&nbsp;Non-Premium
                      </p>
                    </label>
                  </div>
              </li>
              <li>
                  <div class="radio">
                    <label>
                      <p>
                        <input type="radio" name="filter" id="filter_premium" value="premium">&nbsp;&nbsp;Premium
                      </p>
                    </label>
                  </div>
              </li>
              <li>
                  <div class="radio">
                    <label>
                      <p>
                        <input type="radio" name="filter" id="filter_non_verified" value="non_verified">&nbsp;&nbsp;Non-Verified
                      </p>
                    </label>
                  </div>
              </li>
              <li>
                  <div class="radio">
                    <label>
                      <p>
                        <input type="radio" name="filter" id="filter_verified" value="verified">&nbsp;&nbsp;Verified
                      </p>
                    </label>
                  </div>
              </li>
          </ul>
        </div>
    </div>

    <div class="m-t-b-10"></div>

    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Actions</h3>
        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-primary btn-block" id="btn_select_all"><i class="fa fa-check-square-o"></i> Select All</button>
            <button type="button" class="btn btn-primary btn-block" id="btn_deselect_all"><i class="fa fa-square-o"></i> Deselect All</button>
            <button type="button" class="btn btn-primary btn-block" id="btn_send_email">Send Email</button>
        </div>
    </div>
  </div>

</div>

<form name="email_users" id="email_users" action="<?php echo site_url("admin/compose_email"); ?>" method="post">
    <input type="hidden" name="users_list" id="users_list" value="">
</form>


<script type="text/javascript">

    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";

</script>

<script src="<?php echo base_url('assets/js/app.js') ?>"></script>

<script type="text/javascript">
    var users = "";

    $(document).ready(function() {
        get_subscribers("#subscribers", $("input[name='filter']").val());
    });

    $(document).on("change", "input[name='filter']", function() {
        get_subscribers("#subscribers", $(this).val());
    });

    $(document).on("change",".subscriber_chkbox",function() {
        users = "";
        $(".subscriber_chkbox").each(function() {
          if ($(this).is(":checked")) {
              users = users + $(this).attr("data-id") + ",";
          }
        });
    });

    $(document).on("click", "#btn_select_all", function() {
        // $("input[name='subscriber_chkbox']").prop("checked", this.checked);
        $(".subscriber_chkbox").each(function(){
          this.checked=true;
        });

        users = "";
        $(".subscriber_chkbox").each(function() {
          if ($(this).is(":checked")) {
              users = users + $(this).attr("data-id") + ",";
          }
        });
    });

    $(document).on("click", "#btn_deselect_all", function() {
        // $("input[name='subscriber_chkbox']").not(this).prop("checked", this.checked);
        $(".subscriber_chkbox").each(function(){
          this.checked=false;
        });

        users = "";
        $(".subscriber_chkbox").each(function() {
          if ($(this).is(":checked")) {
              users = users + $(this).attr("data-id") + ",";
          }
        });
    });

    $("#btn_send_email").on("click", function() {
        if (users != "") {
            $("#users_list").val(users);
            $("#email_users").submit();
        } else {
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-bottom-right";
            toastr.warning('Please select subscriber(s) to whom you want to send email.');
        }
    });

</script>
