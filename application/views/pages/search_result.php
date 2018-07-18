<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
            <div class="row m-t-b-10">
                <div class="col-lg-8 col-lg-offset-2">
                    <h4 class="p-t-b-10">
                        Search for course materials, probable question sets, free ebooks and more.
                    </h4>
                    <div class="input-group">
                       <input class="form-control input-lg" type="text" id="q" name="q" placeholder="Search Packages" value="<?php if (isset($s_query)) {
                         echo $s_query;
                       } ?>">
                       <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg" type="button" name="searchbtn" id="searchbtn">Search</button>
                       </span>
                    </div>
                    <p class="p-t-b-10">
                        Most Searched Keywords : CA CPT, CA Final, Financial Accounting
                    </p>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">

      <!-- <div id="searched_packages"></div> -->

        <div class="panel panel-default">
          <div class="panel-body">
            <?php
                if (count($search_data) != 0) {
                  foreach($search_data as $value) {
                    $desc = strlen($value["p_desc"]) > 150 ? substr($value["p_desc"],0,150)."..." : $value["p_desc"];
                    echo '<div class="col-sm-12 col-md-12"><div class="caption"><h3>'.$value["p_name"].'</h3><p>'.$desc.'</p><p><button type="button" data-id='.$value["pid"].' class="btn btn-primary btn-sm btnAddToCart"><strong><i class="fa fa-plus-circle"></i> Add to Cart</strong></button>&nbsp;&nbsp;<a href="'.site_url()."site/package_details/".$value["pid"].'" class="btn btn-default btn-sm"><i class="fa fa-external-link"></i> Details</a></p></div></div>';
                  }
                } else {
                  echo '<div class="text-center text-muted m-t-b-100"><i class="fa fa-exclamation-triangle" style="font-size: 48px;"></i><br />No Search Result Found.</div>';
                }
             ?>
          </div>
          <div class="panel-footer">
              <a href="<?php echo site_url('site/packages'); ?>">Click here to browse all packages</a>
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
          <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" class="img-responsive" />
        </div>

        <div class="text-center m-b-10">
          <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" class="img-responsive" />
        </div>
    </div>
</div>

<?php

$keywords = array();

foreach ($stream_data as $value) {
    array_push($keywords, $value->stream_name);
}

foreach ($category_data as $value) {
    array_push($keywords, $value->cat_name);
}

foreach ($subcategory_data as $value) {
    array_push($keywords, $value->subcat_name);
}

foreach ($subject_data as $value) {
    array_push($keywords, $value->subject_name);
}

?>

<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var val_id = "<?php echo $this->session->userdata('uid'); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/cart.js'); ?>"></script>

<script type="text/javascript">

    var keyword_arr = [];

    <?php
      foreach ($keywords as $value) {
          echo 'keyword_arr.push("'.$value.'");';
      }
    ?>

    $(function() {
        $("#q").keyup(function() {
            var searchTerm = $("#q").val();
            $("#q").autocomplete({
                source: keyword_arr
            });
        });
    });

    var redirect = function(redirectURL, arg, value) {
        var form = $('<form action="'+ redirectURL +'" method="GET">' +
            '<input type="hidden" name="'+ arg +'" value="'+ value +'"></input>' + '</form>');
        $('body').append(form);
        $(form).submit();
    };

    $("#searchbtn").on("click", function(event) {
        event.preventDefault();

        if ($("#q").val() != "") {
          redirect("<?php echo site_url('site/search') ?>", "q", $("#q").val());
        } else {
          toastr.options.timeOut = 5000;
          toastr.options.positionClass = "toast-bottom-right";
          toastr.error('Please enter search keyword first.');
        }
        // search_result($("#q").val(), "");
    });

    $('#q').keypress(function (e) {
       var key = e.which;
       if(key == 13) {
          if ($("#q").val() != "") {
            redirect("<?php echo site_url('site/search') ?>", "q", $("#q").val());
          } else {
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-bottom-right";
            toastr.error('Please enter search keyword first.');
          }
          // search_result($("#q").val(), "");
       }
    });
</script>
