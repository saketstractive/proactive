<div class="row">
    <div class="col-md-8">

      <div id="searched_packages"></div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Browse Packages</h3>
          </div>
          <div class="panel-body">
              <div id="packages"></div>
          </div>
        </div>

    </div>

    <div class="col-md-4">
        <!-- <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Search Package</h3>
          </div>
          <div class="panel-body">
              <p class="text-muted">Search by Package,Course or Subject</p>

              <div class="form-group">
                  <input type="text" class="form-control m-b-20" placeholder="Search">
                  <button class="btn btn-primary btn-block">Search</button>
              </div>
          </div>

        </div>
        <div class="m-b-20"></div> -->
        <div class="text-center m-b-10">
          <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" />
        </div>

        <div class="text-center m-b-10">
          <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" />
        </div>
    </div>
</div>

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var val_id = "<?php echo $this->session->userdata('uid'); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/cart.js'); ?>"></script>

<script type="text/javascript">

  $(function() {
    $.ajax({
        url: site_url+'site/load_recent_package',
        type: "GET",
        dataType: "text",
        data: {"limit" : 0},
        crossDomain: true,
        success: function(response) {
            var obj = jQuery.parseJSON(response);
              $("#packages").empty();
              $.each(obj, function(i, value) {
                var trimmed_desc = truncate_string(value["p_desc"], 100);

                // var keyword_str = value["p_keywords"];
                // var split_arr = keyword_str.split(",");
                //
                // split_arr.forEach(function(element, index) {
                //     keyword_arr.push(element);
                // });

                // $("#recentpackage").append('<li><div class="col-lg-6"><h4><strong>'+value["p_name"]+'</strong></h4><p>'+value["p_desc"]+'<a href="#">Show more...</a></p><button type="button" name="button" class="btn btn-primary btn-sm"><strong><i class="fa fa-plus-circle"></i> Add to Cart</strong></button></div></li>');
                $("#packages").append('<div class="col-sm-12 col-md-12"><div class="caption"><h3>'+value["p_name"]+'</h3><p>'+trimmed_desc+'</p><p><button type="button" data-id='+value["pid"]+' class="btn btn-primary btn-sm btnAddToCart"><strong><i class="fa fa-plus-circle"></i> Add to Cart</strong></button>&nbsp;&nbsp;<a href="'+site_url+"site/package_details/"+value["pid"]+'" class="btn btn-default btn-sm"><i class="fa fa-external-link"></i> Details</a></p></div></div>');
              });
        },
        complete: function() {
            // alert(keyword_arr);
        },
        error: function(error) {
            console.log(error);
        }
    });
  });

</script>
