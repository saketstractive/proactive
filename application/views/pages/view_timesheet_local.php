		<script type="text/javascript">
 		$(document).on("ready", function () {
        $("#history").hide();

        $(".square-btn").on("click", function(){
            var pid = $(this).attr("data-id");
            $("#select-project").hide();
            $.ajax({
		        url: site_url+'user/describe_project',
		        type: "POST",
		        dataType: "text",
		        data: {"uid" :<?php echo $this->session->userdata('uid'); ?>, "pid" : pid },
		        crossDomain: true,
		        success: function(response) {
		            var obj = JSON.parse(response);
		            if(obj.length == 0){
			              $("#select-project").show();
			              $("#history").hide();
			              alert("Sorry, no data to show!");
		              }
		              $("#rows").empty();
		              $("#time-head").empty();
		              $("#time-head").text("Timesheet");
		              $("#time-head").append(" > "+obj[0].pro_title+" <a id='close' class='chip right'>Close</a>");
		               $("#close").on("click", function(){
			              $("#time-head").text("Timesheet");
			              $("#select-project").show();
			              $("#history").hide();
			            });
		              $("#pro_title").text(obj[0].pro_title);
		              $("#pro_client").text(obj[0].pro_client); 
		              var cnt = 0;
		              DTtable.clear();
		              $.each(obj, function(i, value) {
		              	cnt += parseInt(value.hrs); 
		              	var cWeek = getDateOfISOWeek(value.tm_week);
		              	// alert(cWeek); 
		              	DTtable.row.add(['<span class="hide">'+value.tm_week+'</span><a data-id="'+value.tm_week+'" class="drill_week">'+cWeek+'</a>', '<span class="tdhours">'+value.hrs+'</span>', '<span class="desc"><a class="grey-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+value.wdesc+'">Note <i class="fa fa-sticky-note"></i></a></span>', value.resourc]).draw();
		               });
		              $('.tooltipped').tooltip({delay: 50}); 
		              $(".drill_week").on("click",function(){
		              	isDrilled = true;
		              	showWeek(pid,$(this).attr("data-id")); //pid set at start of this function
		              });
		        },
		        complete: function() {
		            // alert(keyword_arr);
		        },
		        error: function(error) {
		            console.log(error);
		        }
		    });
            $("#history").show();
            $("#close").on("click", function(){
              $("#time-head").text("Timesheet");
              $("#select-project").show();
              $("#history").hide();
            });
        });

        getTotal();

        //process get parameter if any
            <?php 
            if (isset($search)) { ?>
              $("#btnProject"+<?= $search ?>).click();	
              // $("#DataTables_Table_0_filter > label > input").val("<?= $search ?>").keyup();
            <?php }
            ?>

        }); // end of ready

 		function showWeek(pid,week) {
 			$.ajax({
		        url: site_url+'user/describe_project',
		        type: "POST",
		        dataType: "text",
		        data: {"uid" :<?php echo $this->session->userdata('uid'); ?>, "pid" : pid, "week":week },
		        crossDomain: true,
		        success: function(response) {
		            var obj = JSON.parse(response);
		               delete(obj.approver);
		            DTtable.clear();
		            var cnt = 0;
		              $.each(obj, function(i, value) {
		              	cnt += parseInt(value.tm_hours); 
		              	DTtable.row.add(['<a class="drill_out">'+value.tm_date+"<BR />"+value.tm_day+'</a>', '<span class="tdhours">'+value.tm_hours+'</span>', value.tm_description, value.res_name.split(' ')[0]]).draw();
		               });
		             $(".drill_out").on("click", function () {
		             	DTtable.clear();
		             	//square-btn with data-id pid
		             	$("#btnProject"+pid).click();
		             }); 
		            },
		        complete: function() {
		            // alert(keyword_arr);
		        },
		        error: function(error) {
		            console.log(error);
		        }
		    });
 		}

        function getTotal(){
          var total = 0;  
          $(".work-hours:visible").each(function(){
            total = total + parseInt($(this).text());
          });
          $("#total-hours").text(total+" hours");
        }

        function getDateOfISOWeek(wy) {
        	var y = wy.substring(0,4);
        	var w = wy.substring(4,6);
		    var simple = new Date(y, 0, 1 + (w - 1) * 7);
		    var dow = simple.getDay();
		    var ISOweekStart = simple;
		    var ISOweekEnd = simple;
		    if (dow <= 4)
		        ISOweekStart.setDate(simple.getDate() - simple.getDay());
		    else
		        ISOweekStart.setDate(simple.getDate() + 7 - simple.getDay());
		    
		    var start = ISOweekStart.toString().split(" ").slice(1,4).join(" ");
		   
		    ISOweekEnd.setDate(ISOweekEnd.getDate() + 6);
		    var end = ISOweekEnd.toString().split(" ").slice(1,4).join(" ");

		    return start+"<BR/>"+end;
		}

        </script>