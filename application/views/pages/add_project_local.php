      <script type="text/javascript">
        $(document).on("ready", function () {
        $("#warning").hide();

        $("form").bind("keypress", function(e) {
                  if (e.keyCode == 13) {
                    alert("ENTER is disabled. Use TAB instead.");
                      return false;
                  }
              });

        <?php if (isset($edit_data)) { ?>
          $(".datepicker").change();
          <?php }
           else  { ?>
        $("#project_name").on("change", function(){
          $.post(site_url+'user/duplicate_project', $("#formAddProject").serialize(), function(response) {
            if (response != 0) {
              $("#warning").show();
            }
            else{
              $("#warning").hide();
            }
            });
        });
        <?php }
           ?>

        $("#btnSubmit").on("click", function(){
          if($("#project_name").val() != ""){
          $.post(site_url+'user/create_project', $("#formAddProject").serialize(), function(response) {
                    if(parseInt(response) > 0)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.success('Project updated successfully!');
                         window.location = site_url+'user/map_resources';
                    }
                    else{
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No project updated.'); 
                    }
                    // $("#btn-update-timesheet").attr("disabled",false);
                 });
            }
            else{
                    toastr.options.timeOut = 5000;
                    toastr.options.positionClass = "toast-up-right";
                    toastr.success('Feed me project name atleast!');
            }
            return false;
        });

        $("#expertise").tagit({
          caseSensitive : false,
        allowDuplicates : false,
        allowSpaces:true,
        tagLimit:10,
        singleFieldDelimiter:":",
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
            clear: 'Clear',
            close: 'OK',
            closeOnSelect: true // Close upon selecting a date,
          });
        
        $(".datepicker").change(function(){
          if ($("#start_date").val() != "" && $("#end_date").val() != "" )
          {
            var arr1 = $("#start_date").val().split("-");
            var date1 = new Date(parseInt(arr1[2]) , parseInt(arr1[1])-1 , parseInt(arr1[0]) );
            var arr2 = $("#end_date").val().split("-");
            var date2 = new Date(parseInt(arr2[2]) , parseInt(arr2[1])-1 , parseInt(arr2[0]) );
            if (date2.getTime() > date1.getTime()) {
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = 1+ Math.ceil(timeDiff / (1000 * 3600 * 24));// add one to count present day
            $("#days").val(diffDays);
            }
            else
            {
              $(this).val("");
               $("#days").val("");
            }
          }
          if ($("#on_start_date").val() != "" && $("#on_end_date").val() != "" )
          {
            var arr1 = $("#on_start_date").val().split("-");
            var date1 = new Date(parseInt(arr1[2]) , parseInt(arr1[1])-1 , parseInt(arr1[0]) );
            var arr2 = $("#on_end_date").val().split("-");
            var date2 = new Date(parseInt(arr2[2]) , parseInt(arr2[1])-1 , parseInt(arr2[0]) );
            if (date2.getTime() > date1.getTime()) {
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = 1+ Math.ceil(timeDiff / (1000 * 3600 * 24));// add one to count present day
            $("#ondays").val(diffDays);
              }
            else
            {
              $(this).val("");
               $("#days").val("");
            }
          }

          if ($("#off_start_date").val() != "" && $("#off_end_date").val() != "" )
          {
            var arr1 = $("#off_start_date").val().split("-");
            var date1 = new Date(parseInt(arr1[2]) , parseInt(arr1[1])-1 , parseInt(arr1[0]) );
            var arr2 = $("#off_end_date").val().split("-");
            var date2 = new Date(parseInt(arr2[2]) , parseInt(arr2[1])-1 , parseInt(arr2[0]) );
            if (date2.getTime() > date1.getTime()) {
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            var weeks = Math.floor(diffDays / 7);
            diffDays = 1 + diffDays - weeks * 2; // add one to count present day
            $("#offdays").val(diffDays);
              }
            else
            {
              $(this).val("");
               $("#days").val("");
            }
          }
          var thisdate = $(this).val();
          arr1 = thisdate.split("-");
          dt = new Date(parseInt(arr1[2]) , parseInt(arr1[1])-1 , parseInt(arr1[0]));
          
          var startPro = $("#start_date").val();
          arr1 = startPro.split("-");
          startDay = new Date(parseInt(arr1[2]) , parseInt(arr1[1])-1 , parseInt(arr1[0]));
          
          var endPro = $("#end_date").val()
          arr1 = endPro.split("-");
          endDay = new Date(parseInt(arr1[2]) , parseInt(arr1[1])-1 , parseInt(arr1[0]));
          // alert(endDay);
        if ($(this).attr("id") == "start_date" || $(this).attr("id") == "end_date" ) {
          $("#on_start_date").val("");
          $("#on_end_date").val("");
          $("#off_start_date").val("");
          $("#off_end_date").val("");
          $("#on_days").val("");
          $("#off_days").val("");
        }  
        else if ((endDay) <= (startDay))
        {
          alert("ERROR");
        }

        else if(startDay.getTime() > dt.getTime() || dt.getTime() > endDay.getTime())
        {
          $(this).val("");
          alert("Date out of project schedule");
        }
        else if((startDay == "Invalid Date" || endDay == "Invalid Date") && $(this).attr("id") != "start_date" && $(this).attr("id") != "end_date") {
          alert("Project schedule is not set. Please set project duration");
          $(this).val("");
        }

        });

        });

      </script>