<div class="row">
    <div class="col-md-8">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Browse Free E-Books</h3>
          </div>
          <div class="panel-body">
              <div class="row" id="streams">
               <?php
                $all = json_decode(json_encode($streams), true);
                  foreach ($all as $key => $value) {
                    echo '
                  <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3 text-center">
                    <b>
                    <a id="'.$value['stream_id'].'" class="tiles no_anchor_decoration p-t-b-30">
                    '.$value['stream_name'].'</a>
                    </b>
                  </div>';
                   
                  }
                ?>
                </div>
                <div class="row" id="books" >
                <div id="ebooks">

<!-- onclick="load_ebooks('.$value['stream_id'].')" -->

               <!--    <p class="lead text-muted text-center m-t-b-100">
                      <i class="fa fa-frown-o fa-2x"></i><br />No ebooks available at this moment
                  </p> -->
                </div>

                <div class="col-sm-12 col-xs-12 col-md-12"><a class="btn btn-primary" id="back">Back</a></div>
              </div>
          </div>
        </div>

    </div>

    <div class="col-md-4">
        <!-- <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Filter E-Books</h3>
          </div>
          <div class="panel-body">

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
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>

<script type="text/javascript">

 $("#back").hide();
 
$(document).on("mouseenter", ".trunc_text", function() {
    var $this = $(this);
    $this.tooltip({
       title: $this.text(),
       placement: "bottom"
    });
    $this.tooltip('show');


});

$(".tiles").on("click", function () {
  load_ebooks_by_stream($(this).attr("id"));
})
$("#back").on("click", function () {
  load_ebooks_by_stream(0);
})

function load_ebooks_by_stream(id) {
  // alert(id);
  if (id == 0) {
    $("#back").hide();
    $("#ebooks").hide();
    $("#streams").show();
  }
  else{
  $("#streams").hide();
  $("#back").show();
  $("#ebooks").show();
    }
$("#ebooks").html('LOADING.....');
    $.ajax({
        url: site_url+'site/load_ebooks_by_stream',
        type: "GET",
        dataType: "text",
        data: {"limit" : 0, "id": id},
        crossDomain: true,
        success: function(response) {
          // alert(response);
            var obj = jQuery.parseJSON(response);
            if (!jQuery.isEmptyObject(obj)) {
              $("#ebooks").empty();
              $.each(obj, function(i, value) {
                // var trimmed_title = truncate_string(value["book_title"], 12);
                //<img src="'+base_url+"assets/images/pdf.png"+'" alt="...">
                $("#ebooks").append('<div class="col-xs-12 col-sm-12 col-md-6"><a href="'+base_url+"ebooks/"+value['book_filename']+'" class="no_anchor_decoration thumbnail" target="_blank"><div class="caption trunc_text text-center"><h5 class="btn btn-primary">'+value['book_title']+'</h5></div></a></div>');
              });
              
            } else {
                $("#ebooks").html('<p class="lead text-muted text-center m-t-b-100"><i class="fa fa-frown-o fa-2x"></i><br />No ebooks available at this moment</p>');
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
  }

</script>
