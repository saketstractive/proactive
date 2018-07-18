		<script type="text/javascript">
 		$(document).on("ready", function () {
        // $("#history").hide();
       		 getTotal();

        }); // end of ready

 		$("#closeWindow").click(function(){
   			 window.close();
		});

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