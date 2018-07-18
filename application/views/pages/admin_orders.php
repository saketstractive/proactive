<div class="row">

  <div class="col-lg-12">

    <ol class="breadcrumb white-bg">
        <li><a href="<?php echo site_url('admin/dashboard'); ?>" class="no_anchor_decoration"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">orders</li>
    </ol>

  </div>

</div>

<div class="row">

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Filter orders by</h3>
        </div>
        <div class="panel-body">
      
              
                        <!-- <input type="radio" name="filter" id="filter_all" value="all" checked>&nbsp;&nbsp;All &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      -->
                        <input type="radio" name="filter" id="filter_material" value="material" checked>&nbsp;&nbsp;Study Material
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="filter" id="filter_usb" value="usb">&nbsp;&nbsp;USB
                     
        </div>
    </div>

    <div class="m-t-b-10"></div>

    <!-- <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Actions</h3>
        </div>
        <div class="panel-body">
            <button type="button" class="btn btn-primary btn-block" id="btn_select_all"><i class="fa fa-check-square-o"></i> Select All</button>
            <button type="button" class="btn btn-primary btn-block" id="btn_deselect_all"><i class="fa fa-square-o"></i> Deselect All</button>
            <button type="button" class="btn btn-primary btn-block" id="btn_send_email">Send Email</button>
        </div>
    </div> -->
  </div>

  <div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Orders</h3>
        </div>
        <div class="panel-body">
          <table class="table table-hover table-bordered" id="orders"></table>
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
        get_orders("#orders", "material");
    });

    $(document).on("change", "input[name='filter']", function() {
        get_orders("#orders", $(this).val());
    });

</script>
