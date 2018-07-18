<!DOCTYPE html>
<html lang="en">

<head>
      <!--Import Google Icon Font-->
      <link href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/css/materialize.min.css"); ?>"  media="screen,projection"/>

      <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/jquery-ui.min.css");?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/jquery.tagit.css");?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style.css");?>">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>ProActive - <?php echo isset($title) ? $title : "Welcome to Project World"; ?> </title>

      <style type="text/css">
 
  @media(min-width: 768px){
   
    body{
    background: url(<?php echo base_url("assets/images/whole-bg-white-maze.png"); ?>);
    }

    .square-btn{
        width: 150px !important;
        min-height: 150px !important;
        border: 1px solid rgb(0,0,50);
        margin-bottom: 15px;
      }  
   
  }     

      .all-p-15{
        padding: 15px;
      }

      .min-ht{
        min-height: 400px;
        padding-bottom: 10px;
      }
  body {
    display: flex;
    min-height: 100vh;
    flex-direction: column;
  }

  main {
    flex: 1 0 auto;
  } 

      </style>
    </head>

<body class="whole-bg">
<!-- <?php echo $this->session->userdata('uid'); ?> -->
    <div id="preloader"></div>
    <!-- <div class="container"> -->
       <?php

        $this->load->view('layout/header');

     ?>


    <!-- Page Content -->
    <div class="container" id="master_container">


        <?php

            $this->load->view($content);

        ?>


    </div>
    <!-- /.container -->
    <!-- Footer -->
      <!--   <footer class="page-footer blue lighten-2">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">We can write instructions or quick tips here if we have any</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            &copy; 2017-18 Copyright
            <a class="grey-text text-lighten-4 right" href="#!">Developed by Stractive</a>
            </div>
          </div>
        </footer> -->

<!-- Scrpits -->
  <!-- // -->
    <!-- jQuery JS -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.4.min.js'); ?>"></script>
    <!-- jQuery UI JS -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>


    <!-- Bootstrap JS -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

    <!-- jQuery selectBoxIt JS -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.selectBoxIt.min.js'); ?>"></script>

    <!-- dropzone JS -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/dropzone.min.js'); ?>"></script>

    <!-- Toastr JS -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/toastr.min.js'); ?>"></script>

    <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="<?php echo base_url("assets/js/materialize.min.js"); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url("assets/js/tag-it.min.js");?>"></script>
      <script type="text/javascript">
        $(document).on("ready", function () {
          $("#preloader").show();
        $(".extra-nav:not(#blank)").hide();
        $(".project-info").hide();

        $("#expertise").tagit({
          caseSensitive : false,
        allowDuplicates : false,
        allowSpaces:true,
        tagLimit:10,
        onTagExists: function(event, ui) {
          toastr.options.timeOut = 5000;
          toastr.options.positionClass = "toast-bottom-right";
          toastr.warning('Duplicate words not allowed');
        },
        onTagLimitExceeded: function(event, ui) {
          toastr.options.timeOut = 5000;
          toastr.options.positionClass = "toast-bottom-right";
          toastr.warning('Maximum 10 words allow');
        }
        });

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 4, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            // clear: 'Clear',
            close: 'OK',
            format: 'dd-mm-yyyy',
            closeOnSelect: true // Close upon selecting a date,
          });
       
        $(".datepicker").change(function(){
          if ($("#start_date").val() != "" && $("#end_date").val() != "" )
          {
            var date1 = new Date($("#start_date").val());
            var date2 = new Date($("#end_date").val());
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            $("#days").text(diffDays);
          }

        });
        $("#preloader").hide();
        });

        function show_menu(selector){
          var cnt = 0;
          $(".extra-nav").each(function(){
            if ("#" + $(this).attr("id") != selector) {
              $(this).hide();
              cnt++;
            }
          });

          $(".project-info").each(function(){
            if ("#" + $(this).attr("id") != selector) {
              $(this).hide();
            }
          });
          $(selector).toggle();

          if ($(".extra-nav:visible").length == 0) {$("#blank").show();}
        }
      </script>
   

    <!-- // -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

   
<!-- Scripts end -->

    <!-- Global Variable -->
    <script type="text/javascript">
        var site_url = "<?php echo site_url(); ?>";
        var base_url = "<?php echo base_url(); ?>";
    </script>

   

    <!-- Validation -->
    <script src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>

    <!-- Custom Script -->
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/scripts/validation_script.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/data-table.css'); ?>" >
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/DTbuttons.min.css'); ?>" > -->
      <script type="text/javascript" src="<?php echo base_url('assets/js/data-table.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.buttons.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/pdfmake.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/vfs_fonts.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/buttons.html5.min.js'); ?>"></script>



<script type="text/javascript">
        var DTtable; //initialise global
        var isDrilled = false;
        $(document).ready(function(){
          $(document).bind("keypress", function (e) {
            if (e.keyCode == 8 && isDrilled && !($("input").is(":focus"))) { // back button
                      isDrilled = false;
                      $(".drill_out:first").click();
                      return false;
                  }
          });
          <?php if ($this->session->has_userdata('uid')) { ?>
             $("form").bind("keypress", function(e) {
                  if (e.keyCode == 13) {
                    alert("ENTER is disabled. Use TAB instead.");
                      return false;
                  }
              }); 
          <?php } ?>

          page_load();
          $('.modal').modal();
          $("#btnChange").attr("disabled","disabled");

          $("#newEye").on("mouseover", function () {
                $("#newPass").attr("type","text");
              });
              $("#newEye").on("mouseleave", function () {
                $("#newPass").attr("type","password");
              });
              $("#btnChangePass").on("click",function (){
                $('#modalPass').modal('open');
                return false;
              });
              // $("#btnChange").hide();
              $("#error").hide();

              $("#newPass").on("keyup",function () {
                match_pass();
              });

              $("#confirm").on("keyup",function () {
                match_pass();
              });

              $("#btnChange").on("click", function () {
                if ($("#newPass").val() == $("#confirm").val()) {
                  $("#formChange").submit();
                }
                else{
                  match_pass();
                }
              });
               $('.tooltipped').tooltip({delay: 50});

              $(".dt-button").addClass("btn-flat blue lighten-2 white-text m-s-5"); 
        });
       
        function match_pass() {
           if($("#newPass").val()==$("#confirm").val() && $("#newPass").val() != "" ){
            $("#error").hide();
            $("#btnChange").removeAttr("disabled");
           }
           else{
            $("#error").show();
            $("#btnChange").attr("disabled","disabled");
           }
         }
        function page_load() {
              $(this).scrollTop(0);

            $(window).load(function(){
                 $('#preloader').fadeOut('slow',function() {$(this).hide();});
            });
            if(typeof DTtable != "undefined"){
              DTtable.destroy();
            }
             DTtable = $(".data-table").DataTable({
              "lengthChange":false,
              "pageLength":20,
              dom: 'B<"clear">lfrtip',
              buttons: [
              'csv','excel',
              'pdf'                ]
           
            });
            
             if ($(".data-table").length > 0) {
              var buttons = new $.fn.dataTable.Buttons(DTtable, {
             buttons: [
               'copyHtml5',
               // 'excelHtml5',
               'csvHtml5',
               'pdfHtml5'
               ]
              }).container().appendTo($('#buttons'));
             }

             DTtable.on( 'draw', function () {
                if (typeof $("#hours") != 'undefined') {
                  var newcnt = 0;
                  $(".tdhours").each(function(){
                    newcnt += parseInt($(this).text());
                  });
                  $("#hours").text(newcnt+' Hours');
                }
              } );
       
        }

    </script>
 <?php if(isset($local)) {$this->load->view($local);} ?>   


</body>
</html>