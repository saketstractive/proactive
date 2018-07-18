<?php $keywords = array(); ?>

<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body search-bg">
            <div class="row m-t-b-30">
                <div class="col-lg-8 col-lg-offset-2">
                    <h4 class="p-t-b-10">
                        Search for course materials, probable question sets, free ebooks and more.
                    </h4>
                    <div class="input-group">
                       <input class="form-control input-lg" type="text" id="q" name="q" placeholder="Search Packages">
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body text-center">
              <p class="text-primary lead">Pass it in first attempt with <strong>Pratham Professional Academy!</strong></p>
              <!-- <p class="text-danger"> Get a FREE USB drive on every purchase of probable question paper package.</p> -->
              <a href="<?php echo site_url('site/signup'); ?>" class="btn btn-primary">Create your account now <i class="fa fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-center">Recent Packages</h3>
                <p class="text-center">
                    <a href="<?php echo site_url('site/packages'); ?>" class="no_anchor_decoration">Browse all packages</a>
                </p>
                <hr />
                <div class="row text-center" id="recentpackage">
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-8">

        <div class="m-b-20">
            <img src="<?php echo base_url('assets/images/750x170_cspl.jpg'); ?>" class="img-responsive" />
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-center">Testimonials</h3>
                <hr />
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1 text-center">
                        <ul id="testimonials">
                          <?php
                              if (count($testimonial_data) > 0) {
                                  foreach ($testimonial_data as $value) {
                                        echo "<li><h4>".$value['testimonial_desc']."</h4><br /><p> - ".$value['customer_name']." - </p></li>";
                                  }
                              } else {
                                  echo "<p class='text-muted'>No testimonial(s) found.</p>";
                              }
                           ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-magic"></i> Quick Search</h3>
          </div>
          <div class="panel-body">

              <div class="row m-t-b-20">
                  <div class="col-lg-12">
                        <h4><strong>STREAM</strong></h4><hr />
                        <!-- <h4><strong><i class="fa fa-minus-square-o" aria-hidden="true"></i>&nbsp;STREAM</strong></h4> -->
                        <div id="stream_list">
                          <div class="row">

                          </div>
                          <?php
                              foreach ($stream_data as $value) {
                                  echo '<div class="col-xs-6 col-md-3 text-center">';
                                  echo '<b><a href="'.site_url()."site/search?q=".urlencode($value->stream_name).'" class="tiles no_anchor_decoration p-t-b-30">'.$value->stream_name.'</a></b>';
                                  echo '</div>';
                                  array_push($keywords, $value->stream_name);
                              }
                           ?>
                        </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                      <h4><strong>EXAM CATEGORY</strong></h4><hr />
                      <!-- <h4><strong><i class="fa fa-sort-amount-asc" aria-hidden="true"></i>&nbsp;EXAM CATEGORY</strong></h4> -->
                      <div id="category_list">
                        <div class="row">
                        <?php
                            foreach ($category_data as $value) {
                                echo '<div class="col-lg-3 text-center"><a href="'.site_url()."site/search?q=".urlencode($value->cat_name).'" class="tiles no_anchor_decoration p-t-b-30">'.$value->cat_name.'</a></div>';
                                array_push($keywords, $value->cat_name);
                            }
                         ?>
                       </div>
                      </div>
                </div>
              </div>

             <div class="row m-t-b-20">
                 <?php
                 /*
                  <div class="col-lg-6">
                        <h4><strong>GROUP</strong></h4><hr />
                        <!-- <h4><strong><i class="fa fa-object-group" aria-hidden="true"></i>&nbsp;GROUP</strong></h4> -->
                        <div id="group_list">
                          <?php
                              foreach ($subcategory_data as $value) {
                                  echo '<a href="'.site_url()."site/search?q=".$value->subcat_name.'" class="dark-link">'.$value->subcat_name.'</a><br />';
                                  array_push($keywords, $value->subcat_name);

                              }
                           ?>
                        </div>
                  </div>


                   <div class="col-lg-6">
                        <h4><strong>SUBJECT</strong></h4><hr />
                        <!-- <h4><strong><i class="fa fa-book" aria-hidden="true"></i>&nbsp;SUBJECT</strong></h4> -->
                        <div id="subject_list">
                          <?php
                              foreach ($subject_data as $value) {
                                  echo '<a href="'.site_url()."site/search?q=".$value->subject_name.'" class="dark-link">'.$value->subject_name.'</a><br />';
                                  array_push($keywords, $value->subject_name);
                              }
                           ?>
                        </div>
                  </div>



                 */
                  ?>


              </div>
          </div>
        </div>

    </div>

    <div class="col-md-4">

 	<div class="panel panel-default">
          <div class="panel-body">
              <h3 class="text-center">Offers</h3><hr />
              <p><strong>Buy pilot papers </strong> of any subject at <span class="text-primary">Rs.99</span>. Offer valid till 30th Nov 2017.</p>
              <p><strong>Buy more, pay less!</strong> Buy a combo or a group and save upto <span class="text-primary">Rs. 1,600 /-</span></p>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-body">
              <h3 class="text-center">News</h3><hr />

                <div class="col-lg-12">
                    <ul id="news">
                      <?php
                          if (count($news_data) > 0) {
                              foreach ($news_data as $value) {
                                    echo '<li class="news-item">';
                                    echo '<table cellpadding="4">';
                                    echo '<tr>';
                                    echo '<td>';
                                    echo "<h4>".$value['news_title']."</h4>";
                                    echo "<p>".$value['news_desc']."</p>";
                                    echo '</td>';
                                    echo '</tr>';
                                    echo '</table>';
                                    echo "</li>";
                              }
                          } else {
                              echo "<p class='text-muted'>No news found.</p>";
                          }
                       ?>
                    </ul>
                </div>

          </div>
        </div>



        <div class="m-t-b-10">
            <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" class="img-responsive" />
        </div>

        <div class="m-t-b-10">
            <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" class="img-responsive" />
        </div>

    </div>
</div>

<!-- BXSLIDER JS -->
<script type="text/javascript" src="<?php  echo base_url("assets/js/jquery.bxslider.min.js")?>"></script>

<!-- News Box JS -->
<script type="text/javascript" src="<?php  echo base_url("assets/js/jquery.bootstrap.newsbox.min.js")?>"></script>

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

  $(document).ready(function(){

    $.ajax({
        url: site_url+'site/load_recent_package',
        type: "GET",
        dataType: "text",
        data: {"limit" : 2},
        crossDomain: true,
        success: function(response) {
            var obj = jQuery.parseJSON(response);
              $("#recentpackage").empty();
              $.each(obj, function(i, value) {
                var trimmed_desc = truncate_string(value["p_desc"], 100);

                var keyword_str = value["p_keywords"];
                var split_arr = keyword_str.split(",");

                split_arr.forEach(function(element, index) {
                    keyword_arr.push(element);
                });

                // $("#recentpackage").append('<li><div class="col-lg-6"><h4><strong>'+value["p_name"]+'</strong></h4><p>'+value["p_desc"]+'<a href="#">Show more...</a></p><button type="button" name="button" class="btn btn-primary btn-sm"><strong><i class="fa fa-plus-circle"></i> Add to Cart</strong></button></div></li>');
                $("#recentpackage").append('<div class="col-sm-6 col-md-6"><div class="caption"><h3>'+value["p_name"]+'</h3><p>'+trimmed_desc+'</p><p><button type="button" class="btn btn-primary btn-sm btnAddToCart" data-id='+value["pid"]+'><strong><i class="fa fa-plus-circle"></i> Add to Cart</strong></button>&nbsp;&nbsp;<a href="'+site_url+"site/package_details/"+value["pid"]+'" class="btn btn-default btn-sm"><i class="fa fa-external-link"></i> Details</a></p></div></div>');
              });
        },
        complete: function() {

        },
        error: function(error) {
            console.log(error);
        }
    });

    $('#testimonials').bxSlider({
      adaptiveHeight: true,
      infiniteLoop: true,
      auto: true,
      autoHover: true,
      pager: false,
      responsive: true,
      touchEnabled: true
    });

    $(function () {
      $("#news").bootstrapNews({
          newsPerPage: 2,
          autoplay: true,
          direction:'up',
          animationSpeed: 'normal',
          newsTickerInterval: 5000,
          pauseOnHover: true
      });
    });

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

  });
</script>
