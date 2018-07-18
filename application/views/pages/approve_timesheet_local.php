		<script type="text/javascript">
 		$(document).on("ready", function () {
        $("#history").hide();

        $(".square-btn").on("click", function(){
		    $(".drill_out").hide();
		    $(".apprPanel").hide();
            var pid = $(this).attr("data-id");
            $("#select-project").hide();
            $.ajax({
		        url: site_url+'user/describe_project',
		        type: "POST",
		        dataType: "text",
		        data: {"uid" :<?php echo $this->session->userdata('uid'); ?>, "pid" : pid, "approve":1 },
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
		              DTtable.clear().draw();
		              $.each(obj, function(i, value) {
		              	cnt += parseInt(value.hrs); 
		              	var cWeek = getDateOfISOWeek(value.tm_week);
		              	// alert(cWeek); 
		              	var rowColor = "";
		              	var lblStatus = "Submitted";
		              	if (value.clr == 1) {rowColor = "green white-text"; lblStatus = "Approved";}
		              	if (value.clr == 2) {rowColor = "red white-text"; lblStatus = "Rejected";}

		              	DTtable.row.add(['<span class="hide">'+value.tm_week+'</span>'+cWeek, '<span class="tdhours">'+value.hrs+'</span>', '<span class="desc"><a class="grey-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+value.wdesc+'">Note <i class="fa fa-sticky-note"></i></a></span>', value.resourc,"<span class='chip "+rowColor+"'>"+lblStatus+"</span>","<button class='drill_week btn grey invert' data-id='"+value.tm_week+"'>View</button>"]).draw();
		               });
		             $('.tooltipped').tooltip({delay: 50});
		             $(".drill_week").on("click",function(){
		             	isDrilled = true;
		             	$(".drill_out").show();
		             	$(".apprPanel").show();
		              	showWeek(pid,$(this).attr("data-id")); //pid set at start of this function
		              });
		              <?php 
		                if (isset($search) && $search != "") { 
		                  echo "DTtable.search( '".str_replace("_", " ", $search)."' ).draw()";
		                }  ?>
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
        <?php 
        if ($click_pid > 0) { 
        	echo "$(\"#btnProject\"+".$click_pid.").click();";
        	// echo "$(\"#DataTables_Table_0_filter > label > input\").val(\"".$search."\").keyup()";
         }  ?>


         $("#approveAll").on("click", function () {
			$(".green.invert").click();
         });
         $("#approveNew").on("click", function () {
			$(".green.invert").each(function () {
				if($(this).parent().parent().find(".chip").text() == "Submitted")
					$(this).click();
			});
         });

        }); // end of ready

 		function showWeek(pid,week) {
 			$.ajax({
		        url: site_url+'user/describe_project',
		        type: "POST",
		        dataType: "text",
		        data: {"uid" :<?php echo $this->session->userdata('uid'); ?>, "pid" : pid, "week":week, "approve":1 },
		        crossDomain: true,
		        success: function(response) {
		            var obj = JSON.parse(response);
		            // alert(response);
		            DTtable.clear();
		            var cnt = 0;
		            var thisid = <?php echo $this->session->userdata('uid'); ?>;
		            var approver = obj.approver;
		               delete(obj.approver);
		              $.each(obj, function(i, value) {
		              	cnt += parseInt(value.tm_hours); 
		              	var cdate = value.tm_date.split("-").reverse().join("-");
		              	var my_work = "";
		              	if(value.tm_resid == thisid){
		              		my_work = "my_work";
		              	}
		              	var disableG = disableR = rowColor = "";
		              	var labelStatus = "Submitted";
		              	var lblLast = "hide";
		              	var classReason = "";
		              	var rsn = value.reason;
		              	if(value.tm_approved == 1){
		              		disableG = "disabled";
		              		labelStatus = "Approved";
		              		rowColor = "green white-text";
		              		lblLast = "";
		              		rsn = "";
		              	}
		              	else if(value.tm_approved == 2){
		              		disableR = "disabled";
		              		labelStatus = "Rejected";
		              		rowColor = "red white-text";
		              		lblLast = "";
		              		classReason = "hide";
		              	} 
		              	// use original value as hidden to sort and add formatted date afterwards
		              	DTtable.row.add(['<span class="hide">'+value.tm_date+'</span>'+cdate+"<BR />"+value.tm_day, '<span class="tdhours ">'+value.tm_hours+'</span>', '<span class="">'+value.tm_description+'</span>', "<span>"+value.res_name.split(' ')[0]+"</span>","<span class='chip "+rowColor+"'>"+labelStatus+"</span><br />"+rsn,"<button class='btn-floating green "+disableG+" invert "+my_work+"' data-id='"+value.tm_id+"'><i class='fa fa-check'></i></button> <button class='btn-floating red "+disableR+" invert "+my_work+"' data-id='"+value.tm_id+"'><i class='fa fa-close'></i></button>  <br/><input class='"+classReason+" "+my_work+" reason' type='text' placeholder='Rejection note' id='reason"+value.tm_id+"' /><span class='"+lblLast+"'>(Last accessed by "+value.tm_approval_by+")</span>"]).draw();
		               });
				 <?php if ($this->session->has_userdata('user_type') && $this->session->userdata('user_type')==0 ) { ?>
		             $(".action").show();
		         <?php } else { //remove buttons if not admin ?>
		         	$(".my_work").remove();
		         	if(!(parseInt(approver) > 0)){
		         	$(".action").hide();
		         	$("button.invert").remove();
		         	$(".reason").remove();
		         	}
		         	else{
		             $(".action").show();
		         	}
		         	<?php } ?>

		             <?php // if($this->session->userdata['user_type'] == 0){ ?>
		             $(".invert").on("click", function(){
		             	tid = $(this).attr("data-id");
		             	var flag = 1; // default to approve
		             	var reason = "NA";
		             	if ($(this).hasClass("red")) {
		             		if ($("#reason"+tid).val().trim() == "") {
		             			alert("Please specify the reason to reject.");
		             			$("#reason"+tid).addClass("invalid red-text");
		             			}
		             		else{
		             			flag = 2;
		             			reason = $("#reason"+tid).val();
		             			approve_timesheet(flag,pid,week,tid, reason);
		             			}
		             	}
		             	else //otherwise approve
		             			approve_timesheet(flag,pid,week,tid, reason);

		             });	
		             	<?php //} ?>
		             $(".drill_out").on("click", function () {
		             	DTtable.clear();
		             	$(".action").show();
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

        		<?php //if ($this->session->userdata('user_type') == 0) { ?>
		function approve_timesheet(flag,pid,week,eid, reason){	
			$.ajax({
		        url: site_url+'user/approve_entry',
		        type: "POST",
		        dataType: "text",
		        data: { "flag":flag, "pid" : pid, "week":week, "eid":eid, "reason": reason },
		        crossDomain: true,
		       success: function(response) {
		            var obj = JSON.parse(response);
		            DTtable.clear();
		            var cnt = 0;
		            var thisid = <?php echo $this->session->userdata('uid'); ?>;
		            var approver = obj.approver;
		               delete(obj.approver);
		              $.each(obj, function(i, value) {
		              	cnt += parseInt(value.tm_hours); 
		              	var cdate = value.tm_date.split("-").reverse().join("-");
		              	var my_work = "";
		              	if(value.tm_resid == thisid){
		              		my_work = "my_work";
		              	}
		              	var disableG = disableR = rowColor = "";
		              	var labelStatus = "Submitted";
		              	var lblLast = "hide";
		              	var classReason = "";
		              	var rsn = value.reason;
		              	if(value.tm_approved == 1){
		              		disableG = "disabled";
		              		labelStatus = "Approved";
		              		rowColor = "green white-text";
		              		lblLast = "";
		              		rsn = "";
		              	}
		              	else if(value.tm_approved == 2){
		              		disableR = "disabled";
		              		labelStatus = "Rejected";
		              		rowColor = "red white-text";
		              		lblLast = "";
		              		classReason = "hide";
		              	} 
		              	// use original value as hidden to sort and add formatted date afterwards
		              	DTtable.row.add(['<span class="hide">'+value.tm_date+'</span>'+cdate+"<BR />"+value.tm_day, '<span class="tdhours ">'+value.tm_hours+'</span>', '<span class="">'+value.tm_description+'</span>', "<span>"+value.res_name.split(' ')[0]+"</span>","<span class='chip "+rowColor+"'>"+labelStatus+"</span><br />"+rsn,"<button class='btn-floating green "+disableG+" invert "+my_work+"' data-id='"+value.tm_id+"'><i class='fa fa-check'></i></button> <button class='btn-floating red "+disableR+" invert "+my_work+"' data-id='"+value.tm_id+"'><i class='fa fa-close'></i></button>  <br/><input class='"+classReason+"' type='text' placeholder='Rejection note' id='reason"+value.tm_id+"' /><span class='"+lblLast+"'>(Last accessed by "+value.tm_approval_by+")</span>"]).draw();
		               });
				 <?php if ($this->session->has_userdata('user_type') && $this->session->userdata('user_type')==0 ) { ?>
		             $(".action").show();
		         <?php } else { //remove buttons if not admin ?>
		         	$(".my_work").remove();
		         	if(!(parseInt(approver) > 0)){
		         	$(".action").hide();
		         	}
		         	else{
		             $(".action").show();
		         	}
		         	<?php } ?>

		             <?php // if($this->session->userdata['user_type'] == 0){ ?>
		             $(".invert").on("click", function(){
		             	tid = $(this).attr("data-id");
		             	var flag = 1; // default to approve
		             	var reason = "NA";
		             	if ($(this).hasClass("red")) {
		             		if ($("#reason"+tid).val() == "") {
		             			alert("Please specify the reason to reject.");
		             			$("#reason"+tid).addClass("invalid red-text");
		             			}
		             		else{
		             			flag = 2;
		             			reason = $("#reason"+tid).val();
		             			approve_timesheet(flag,pid,week,tid, reason);
		             			}
		             	}
		             	else //otherwise approve
		             			approve_timesheet(flag,pid,week,tid, reason);

		             });	
		             	<?php //} ?>
		             $(".drill_out").on("click", function () {
		             	DTtable.clear();
		             	$(".action").show();
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
		<?php	//}	?>

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