<script type="text/javascript">
	    var isWeekSelected = false; // global variable
	    var isAutomatic = false;
	    var notifyUser = true;
        $(document).on("ready", function () {
        $("#refresh-warning").hide();
        $('select').material_select();
        $('.tap-target').tapTarget('open');
        $('.hoursToEnter').attr("disabled","disabled");

        // $("#table-append").parent().hide();
        $("#btn-update-timesheet").on("click", function(){
        	$(this).attr("disabled",true);

		    $.post(site_url+'user/update_work', $("#form-update-timesheet").serialize(), function(response) {
		        	if(parseInt(response) > 0)
		        	{
		        		 toastr.options.timeOut = 5000;
			             toastr.options.positionClass = "toast-up-right";
			             toastr.success('Work added successfully!');
		        	}
		        	else{
		        		 toastr.options.timeOut = 5000;
			             toastr.options.positionClass = "toast-up-right";
			             toastr.warning('Sorry! No data updated.');	
		        	}
		        	$("#btn-update-timesheet").attr("disabled",false);
		   		 });
        });


        $(".square-btn").on("click", function(){
          var name = $(this).children().text();
          if (confirm("Are you sure, you want to access "+name)) {
            $("#time-head").append(" > "+name+" <a id='close' class='chip right'>Close</>");
            $("#update-form").show();
            $("#select-project").hide();
           
            
          }       
        });
        DTtable.draw();

        $("#btnAddRow").on("click", function(){
        	var current_id = $("#table-append > tr").length + 1;
        	var newRow = '<tr><td><label class="inactive" id="inactive'+current_id+'"></label><div class="input-field"><select id="project'+current_id+'" name="project'+current_id+'"><?php echo str_replace("'", "\"", $project_list); ?></select></div></td><td><div class="input-field"><textarea class="materialize-textarea" id="description'+current_id+'" name="description'+current_id+'" placeholder="Task Description"></textarea></div></td><td><input class="hoursToEnter hourSunday center" type="number" value="0" id="hourSunday'+current_id+'" name="hourSunday'+current_id+'"></td><td><input class="hoursToEnter hourMonday center" type="number" value="0" id="hourMonday'+current_id+'" name="hourMonday'+current_id+'"></td><td><input class="hoursToEnter hourTuesday center" type="number" value="0" id="hourTuesday'+current_id+'" name="hourTuesday'+current_id+'"></td><td><input class="hoursToEnter hourWednesday center" type="number" value="0" id="hourWednesday'+current_id+'" name="hourWednesday'+current_id+'"></td><td><input class="hoursToEnter hourThursday center" type="number" value="0" id="hourThursday'+current_id+'" name="hourThursday'+current_id+'"></td><td><input class="hoursToEnter hourFriday center" type="number" value="0" id="hourFriday'+current_id+'" name="hourFriday'+current_id+'"></td><td><input class="hoursToEnter hourSaturday center" type="number" value="0" id="hourSaturday'+current_id+'" name="hourSaturday'+current_id+'"></td></tr>';
        	$("#table-append").append(newRow);
        	$('select').material_select();
        	hide_old_projects();
			$(".hoursToEnter").on("change", function () {
				sumUpEfforts($(this));
			});
        	if (!isWeekSelected) {$('.hoursToEnter').attr("disabled","disabled");}
        	if (!isAutomatic) {
	        	toastr.options.timeOut = 5000;
	          	toastr.options.positionClass = "toast-bottom-right";
	          	toastr.success('One row added at the bottom');
	        	}
	        isAutomatic = false;	
        });


        $("#btnDeleteRow").on("click", function(){
        if($("#table-append > tr:last").find(".inactive").text() == "" || isAutomatic){
        	if ($("#table-append > tr").length > 1 ) {
	        	$("#table-append > tr:last").remove();
	        	if(notifyUser){toastr.options.timeOut = 5000;
	        	          		toastr.options.positionClass = "toast-bottom-right";
	        	          		toastr.warning('Last row deleted!');}
        	}
        	else{
        		if(notifyUser){toastr.options.timeOut = 5000;
        			          		toastr.options.positionClass = "toast-bottom-right";
        			          		toastr.warning('First row cannot be deleted!');}	
        	}
	        	notifyUser = true;
        }
        else{
        	// if (!isAutomatic) {
        	toastr.options.timeOut = 5000;
       		toastr.options.positionClass = "toast-bottom-right";
       		toastr.warning('Existing row cannot be deleted.<br /> Try setting 0 in all hours to delete the row');	
    	    // }
    	}
    	    isAutomatic = false;

        });

        }); // end of ready
		$(function() {
		    var startDate, endDate, mondayDate, tuesdayDate, wednesdayDate, thursdayDate, fridayDate;
        ///////modal code
        $(".modal").modal();
        $("#btnWeekModal").on("click",function(){$("#calenderModal").modal('open');});
        $("#closeWeek").on("click", function(){
        	var cnter = $("#table-append > tr").length;
        	for(var i = 0; i < cnter; i++)
        	{
        		notifyUser = false;
        		isAutomatic = true;
        		$("#btnDeleteRow").click();
        	}

        	if(isWeekSelected){

        		$(".modal").modal('close');
        		$('.hoursToEnter').attr("disabled", false);
        		$("#inputSunday").val(startDate.toString().split(" ").slice(0,4).join(" "));
        		$("#labelSunday").text(startDate.toString().split(" ").slice(0,4).join(" "));

        		$("#inputMonday").val(mondayDate.toString().split(" ").slice(0,4).join(" "));
        		$("#labelMonday").text(mondayDate.toString().split(" ").slice(0,4).join(" "));

        		$("#inputTuesday").val(tuesdayDate.toString().split(" ").slice(0,4).join(" "));
        		$("#labelTuesday").text(tuesdayDate.toString().split(" ").slice(0,4).join(" "));

        		$("#inputWednesday").val(wednesdayDate.toString().split(" ").slice(0,4).join(" "));
        		$("#labelWednesday").text(wednesdayDate.toString().split(" ").slice(0,4).join(" "));

        		$("#inputThursday").val(thursdayDate.toString().split(" ").slice(0,4).join(" "));
        		$("#labelThursday").text(thursdayDate.toString().split(" ").slice(0,4).join(" "));

        		$("#inputFriday").val(fridayDate.toString().split(" ").slice(0,4).join(" "));
        		$("#labelFriday").text(fridayDate.toString().split(" ").slice(0,4).join(" "));

        		$("#inputSaturday").val(endDate.toString().split(" ").slice(0,4).join(" "));
        		$("#labelSaturday").text(endDate.toString().split(" ").slice(0,4).join(" "));

        		$.post(site_url+'user/get_timesheet', { wed: $("#inputWednesday").val() }, function(response) {
        			var current_project = "";
        			var current_description = "";
        			var current_row = 0;
					var data = JSON.parse(response);
					if (data.length > 0) {
						$("#table-append").empty();
						data.forEach(function(dtrow, index, data){
							if(dtrow.tm_proid != current_project || dtrow.tm_description != current_description ){
								//add a row for new project and description
								current_project = dtrow.tm_proid;
								current_description = dtrow.tm_description;
								isAutomatic = true;
								$("#btnAddRow").click();// load row
								// $('select').material_select(); // materialize select
								current_row++;
								/////
								var selct = $("#project"+current_row);
								selct.val(dtrow.tm_proid);
								$(".select-wrapper").hide(); // hide editable select
								$("#inactive"+current_row).text(selct.find(":selected").text()); 
								// Load label for uneditable value

								$("#description"+current_row).html(dtrow.tm_description);
								$("#hour"+dtrow.tm_day+current_row).val(dtrow.wrk);

								
							}
							else{
								$("#hour"+dtrow.tm_day+current_row).val(dtrow.wrk);
							}
							if (dtrow.tm_approved == 1) {$("#hour"+dtrow.tm_day+current_row).addClass("green lighten-3").attr("readonly","readonly");}
							else if (dtrow.tm_approved == 2) {$("#hour"+dtrow.tm_day+current_row).addClass("red lighten-3").removeAttr("readonly");}
							else {$("#hour"+dtrow.tm_day+current_row).removeClass("green red lighten-3").removeAttr("readonly");
											}
								

						});	        	
					}
					else{
						$(".select-wrapper").show(); // hide editable select
						$(".inactive").remove();  // Load label for uneditable value
						$("#project1").val('');
						$("select").material_select();
						$("#hourMonday1").val('0').removeClass("green red lighten-3").removeAttr("readonly");
						$("#hourTuesday1").val('0').removeClass("green red lighten-3").removeAttr("readonly");
						$("#hourWednesday1").val('0').removeClass("green red lighten-3").removeAttr("readonly");
						$("#hourThursday1").val('0').removeClass("green red lighten-3").removeAttr("readonly");
						$("#hourFriday1").val('0').removeClass("green red lighten-3").removeAttr("readonly");
						$("#hourSaturday1").val('0').removeClass("green red lighten-3").removeAttr("readonly");
						$("#hourSunday1").val('0').removeClass("green red lighten-3").removeAttr("readonly");
						$("#description1").val('');

					}
					sumUpEfforts();
					$(".hoursToEnter").on("change", function () {
						sumUpEfforts($(this));
					});
		   		 });
        	}
        	else{
        		alert("You have not selected any week!");
        	}
        });
        ////////////modal ends
        
	    
	    var selectCurrentWeek = function() {
	        window.setTimeout(function () {
	            $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
	        }, 1);
	    }
	    
	    $('.week-picker').datepicker( {
	    	dateFormat:'dd-mm-yy',
	    	showWeek: true,
	    	minDate:"-7D",
	    	maxDate: "+0D",
	    	autoClose : true,
	    	// minDate: -30,
	        showOtherMonths: true,
	        selectOtherMonths: true,
	        onSelect: function(dateText, inst) { 
	            var date = $(this).datepicker('getDate');

	            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
	            mondayDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 1);
	            tuesdayDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 2);
	            wednesdayDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 3);
	            thursdayDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 4);
	            fridayDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 5);
	            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
	            


	            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
	            $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
	            $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
	            isWeekSelected = true;
	            selectCurrentWeek();
	        },
	        beforeShowDay: function(date) {
	            var cssClass = '';
	            if(date >= startDate && date <= endDate)
	                cssClass = 'ui-datepicker-current-day';
	            return [true, cssClass];
	        },
	        onChangeMonthYear: function(year, month, inst) {
	            selectCurrentWeek();
	        },
	        onClose: function(dateText, inst) {
	        	// alert("here");
	        	$("#closeWeek").click();
	        }

	    });
	    
	    //$('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
	    //$('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
	});
	
	function sumUpEfforts(selector)
	{
		var pointer = 0;
		var position = 0;
		var sundayCount = 0;
		var saturdayCount = 0;
		var mondayCount = 0;
		var tuesdayCount = 0;
		var wednesdayCount = 0;
		var thursdayCount = 0;
		var fridayCount = 0;
		var hoursCount = 0;
		var current = 0;
		var errorCol = "";

		$(".hoursToEnter").each(function () {
			position = pointer % 7;
			if(parseInt($(this).val()) > 0)
				current = parseInt($(this).val());
			else{
				current = 0; 
				if(parseInt($(this).val()) != 0){$(this).val(0);}
				}

			switch(position)
			{
				case 0 :
					sundayCount = sundayCount + current;
					if(sundayCount > 8) {errorCol = ".hourSunday";}
					break;
				case 1 :
					mondayCount = mondayCount + current;
					if(mondayCount > 8) {errorCol = ".hourMonday";}
					break;
				case 2 :
					tuesdayCount = tuesdayCount + current;
					if(tuesdayCount > 8) {errorCol = ".hourTuesday";}
					break;
				case 3 :
					wednesdayCount = wednesdayCount + current;
					if(wednesdayCount > 8) {errorCol = ".hourWednesday";}
					break;
				case 4 :
					thursdayCount = thursdayCount + current;
					if(thursdayCount > 8) {errorCol = ".hourThursday";}
					break;
				case 5 :
					fridayCount = fridayCount + current;
					if(fridayCount > 8) {errorCol = ".hourFriday";}
					break;
				case 6 :	
					saturdayCount = saturdayCount + current;
					if(saturdayCount > 8) {errorCol = ".hourSaturday";}
					break;
				default :	
					alert('System is unavailable, please contact Administrator');
			}
			hoursCount = hoursCount + current;

			pointer++; 
		});
		if (errorCol == "") {
			// selector.removeClass("red");
			$("#btn-update-timesheet").attr("disabled", false);
			}
		else{
			// selector.addClass("red");
			selector.val(0);
			$("#btn-update-timesheet").attr("disabled", true);
			alert("Work done in a day cannot exceed 8 hours ");
			return false;
			}
		$("#SundayCount").text(sundayCount);
		$("#MondayCount").text(mondayCount);
		$("#TuesdayCount").text(tuesdayCount);
		$("#WednesdayCount").text(wednesdayCount);
		$("#ThursdayCount").text(thursdayCount);
		$("#FridayCount").text(fridayCount);
		$("#SaturdayCount").text(saturdayCount);
		$("#totalHours").text(hoursCount);
	}

	function hide_old_projects() {
		$(".inactive").each(function () {
			var pro_name = $(this).text();
			if (pro_name != ""){
			$(this).parent().find(".select-wrapper").hide();	
			$(".select-dropdown").find("span").each(function () {
				if($(this).text() == pro_name) $(this).parent().remove();
			});	
			}
		});

	}
	
	$(".hoursToEnter").on("change", function () {
		sumUpEfforts($(this));
	});
   

      </script>