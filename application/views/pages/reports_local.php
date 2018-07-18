      <script type="text/javascript">
        var resid = 0; // global for multiple forms
        var resname = "";
        var base_used = bonus_paid = totalCTC = 0;
        $(document).on("ready", function () {
        $('#view_project').hide();
        // $('#payableTable').hide();
        $('select').material_select();
        $('.collapsible').collapsible();
        $("#filter_resource_report").hide();
        $("#view_resource").hide();
        update_total();
        DTtable.on("draw", update_total);

        $(".square-btn.btnProject").on("click", function () {
          proid = $(this).attr("data-id");
          $("#preloader").show();
          $("#proName").text($(this).find('.ptitle').text());
          $.post(site_url+'user/get_project_figures', {"proid":proid}, function(response) {
            if(response.length > 2){
              var obj = JSON.parse(response);
              var totalInvoice = totalCTC = resExpend = projectExpend = gross = 0;

              if (obj.expense_list.length > 0) {
                for(i in obj.expense_list){
                  // if (obj.expense_list[i].inv == "1") {
                    // totalInvoice += parseInt(obj.expense_list[i].amount); 
                  // }
                  // else
                   if (obj.expense_list[i].ex_resid == "0") {
                    projectExpend = obj.expense_list[i].amount; 
                  }
                  else{
                    resExpend += parseInt(obj.expense_list[i].amount);
                  }
                }
              }
              if (obj.invoice_list.length > 0) {
                totalInvoice = obj.invoice_list[0].amount; ///  seperated after seperate table invoices
              }
              if (obj.efforts.length > 0) {
                totalCTC = 0;
                for(i in obj.efforts){
                      var hourBonus = obj.efforts[i].bonus/(240*8);
                      base_used  = Math.floor(obj.efforts[i].hrs * obj.efforts[i].res_base / (8*22));
                      bonus_paid = Math.floor(obj.efforts[i].hrs * hourBonus);
                      totalCTC += base_used + bonus_paid;
                  // totalCTC += obj.efforts[i].hrs * obj.efforts[i].res_base / 8; 
                }
              }

              $("#invoice").text(totalInvoice);
              $("#proExpense").text(projectExpend);
              $("#resExpense").text(resExpend);
              $("#resCTC").text(totalCTC);
              gross = totalInvoice - projectExpend - resExpend - totalCTC;
              
              if (gross > 0) $("#gross_profit").removeClass("blue-text red-text").addClass("green-text");  
              else           $("#gross_profit").removeClass("blue-text green-text").addClass("red-text");  
              
              $("#gross_profit").text(gross);
              $("#link_inv").attr("href", site_url+"user/add_invoices/"+$("#proName").text().replace(/ /g,"_"));
              $("#link_history").attr("href", site_url+"user/approve_timesheet/"+proid+"/Approved");
              $("#link_expenses1").attr("href", site_url+"user/view_expenses/"+$("#proName").text().replace(/ /g,"_"));
              $("#link_expenses2").attr("href", site_url+"user/view_expenses/"+$("#proName").text().replace(/ /g,"_"));


              $("#preloader").hide();
              $('#view_project').show();
              $('html, body').animate({ scrollTop: $('#view_project').offset().top }, 'slow');
            }
            else{
                    toastr.options.timeOut = 5000;
                    toastr.options.positionClass = "toast-up-right";
                    toastr.warning('Sorry! No data to show.'); 
                    $('#view_project').hide();
                    $("#preloader").hide();
                    }
            });

        });
        $(".square-btn.btnResource").on("click", function () {
          $("#approx_warning").hide();
          $("#preloader").show();          
          resid = $(this).attr("data-id");
          resname = $(this).find(".resname").text();
          // alert(resname);
          $("#select_resource").hide();
          $("#filter_resource_report").show();
          $("#view_resource").show();
          $("#btnFilterResHistory").click();
        });

        $("#btnCloseResHistory").on("click", function () {
          $("#preloader").show();          
          $("#select_resource").show();
          $("#filter_resource_report").hide();
          $("#view_resource").hide();
          $("#startOfRes").val("<?= date('01-m-Y') ?>");
          $("#endOfRes").val("<?= date('d-m-Y') ?>");
          $("#preloader").hide();          
        });
        $("#btnFilterResHistory").on("click", function () {
          $("#preloader").show();
          start = $("#startOfRes").val(); 
          end = $("#endOfRes").val();
          if (start.split("-").reverse().join("") > end.split("-").reverse().join("") ) {
             toastr.options.timeOut = 5000;
             toastr.options.positionClass = "toast-up-right";
             toastr.warning('Start date cannot be ahead of end date.');
                $("#preloader").hide();
          }
          else if (start == "") {
           toastr.options.timeOut = 5000;
             toastr.options.positionClass = "toast-up-right";
             toastr.warning('Start date cannot be empty.');
                $("#preloader").hide(); 
          }
          else{
          $.post(site_url+'user/get_resource_history', {"resid":resid, "start":start, "end":end}, function(response) {
                    if(response.length > 2)
                    {
                      var obj = JSON.parse(response);
                      DTtable.clear().draw();
                      $("#resource_name").html("<a href='"+site_url+"user/add_resource/"+obj[0].tm_resid+"' target='_blank'>"+obj[0].res_name+"</a>");
                      $.each(obj, function(i, value) {
                      var hourBonus = value.bonus/(240*8);
                      base_used  = Math.floor(value.hrs * value.res_base / (8*value.wdays));
                      bonus_paid = Math.floor(value.hrs * hourBonus);
                      totalCTC = base_used + bonus_paid;
                       
                        var sdate = value.start.split("-").reverse().join("-");
                        var edate = value.end.split("-").reverse().join("-");
                      DTtable.row.add([value.pro_title,sdate,edate,'<span class="hrs">'+value.hrs+'</span>','<span class="utilctc">'+base_used+'</span>','<span class="utilbonus">'+bonus_paid+'</span>','<span class="utilsubtotal">'+totalCTC+'</span>','<span class="desc"><a class="grey-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+value.wdesc+'">Note <i class="fa fa-sticky-note"></i></a></span>','<button class="btn-floating view_more_res transparent" data-id="'+value.tm_proid+'"><i class="fa fa-eye red-text"></i></button>']).draw();
                      });
                      $('.tooltipped').tooltip({delay: 50});
                      init_view_more(); 
                      update_total();  
                    }
                    else{
                        
                        DTtable.clear().draw();
                        init_view_more(); 
                        update_total();  
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No data to show.'); 
                        $("#resource_name").html("<a href='"+site_url+"user/add_resource/"+resid+"' target='_blank' >"+resname+"</a>");
                          // $("#btnCloseResHistory").click();
                    }
                $("#preloader").hide();

                 });
                }
          return false;
        });

        $("#btnGetPeriod").on("click",function () {
          var start = $("#inpStartPeriod").val().split("-").reverse().join("-");
          var end = $("#inpEndPeriod").val().split("-").reverse().join("-");
          sval = start.replace(/-/g,"");
          eval = end.replace(/-/g,"");
          if(sval > eval){
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-up-right";
            toastr.warning('<b>Start</b> cannot be greater than <b>End</b>');
          }
          else if(start != "")
            {getPayable(start, end);}
          else{
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-up-right";
            toastr.warning('<b>Start</b> cannot be blank'); 
          }
        });

        $("#btnGetMonth").on("click", function () {
          var start, end;
          if ($("#payableMonth").val() != "" && $("#payableYear").val() != "" ) {
          start = $("#payableYear").val()+"-"+$("#payableMonth").val()+"-01";
          end = $("#payableYear").val()+"-"+$("#payableMonth").val()+"-31"; // it should work for all months
          getPayable(start, end);
          }
          else if ($("#payableYear").val() != "") {
          start = $("#payableYear").val()+"-01-01";
          end = $("#payableYear").val()+"-12-31"; 
          getPayable(start, end);
          }
          else{
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-up-right";
            toastr.warning('Invalid Data');
          }
        });

        }); // end of ready

      function getPayable(start, end) {
        var resource = $("#payableResource").val();
          if (resource != null && start != "" && end != "") {
          $.post(site_url+'user/get_resource_figures', {"resid":resource, "start":start, "end":end}, function(response) {
            var obj = JSON.parse(response);
            $("#payableName").text($("#payableResource > option:selected").text());
            $("#payableStart").text(start.split("-").reverse().join("-"));
            $("#payableEnd").text(end.split("-").reverse().join("-"));
            $("#payableBonus").text(obj.bonus);
            $("#payableExpenses").text(obj.expense);
            $("#payableSalary").text(obj.CTC);
            $("#payableSub").text(obj.bonus*1+obj.expense*1+0); // add per diem instead of zero
            $("#payableAdvance").text(0);//add advance instead of zero
            $("#payableOutstd").text(obj.bonus*1+obj.expense*1 + 0 - 0);

          });
        }
        else{
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-up-right";
            toastr.warning('Please select a <b>Resource</b> with valid dates.');          
        }
      }



      function update_total() {
        var total = 0;
        $(".hrs:visible").each(function(){
            total = total + parseInt($(this).text());
        });
        $("#hrsTotal").text(total);

        var total = 0;
        $(".utilctc:visible").each(function(){
            total = total + parseInt($(this).text());
        });
        $("#CTCTotal").text(total);

        var total = 0;
        $(".utilbonus:visible").each(function(){
            total = total + parseInt($(this).text());
        });
        $("#BonusTotal").text(total);

        var total = 0;
        $(".utilsubtotal:visible").each(function(){
            total = total + parseInt($(this).text());
        });

        $("#GrandTotal").text(total);
      }


      function init_view_more() {
        $(".view_more_res").on("click", function () {
          $("#preloader").show();
          start = $("#startOfRes").val(); 
          end = $("#endOfRes").val();
          proid = $(this).attr("data-id");

          $.post(site_url+'user/get_resource_history_project', {"proid":proid,"resid":resid, "start":start, "end":end}, function(response) {
                    if(response.length > 2)
                    {
                      var obj = JSON.parse(response);
                      DTtable.clear().draw();

                      $.each(obj, function(i, value) {
                      var hourBonus = value.bonus/(240*8);
                      base_used  = Math.floor(value.hrs * value.res_base / (8*22));
                      bonus_paid = Math.floor(value.hrs * hourBonus);
                      totalCTC = base_used + bonus_paid;

                        var edate = value.tm_date.split("-").reverse().join("-");
                        //,'<span class="utilctc">'+base_used+'</span>' Removed base_used as it is appox
                      DTtable.row.add([value.pro_title,edate,edate,'<span class="hrs">'+value.hrs+'</span>','<span class="utilctc">'+base_used+'</span>','<span class="utilbonus">'+bonus_paid+'</span>','<span class="utilsubtotal">'+totalCTC+'</span>','<span class="desc"><a class="grey-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="'+value.wdesc+'">Note <i class="fa fa-sticky-note"></i></a></span>','<button class="btn-floating back_btn transparent"><i class="fa fa-mail-reply red-text"></i></button>']).draw();
                      });

                      $('.tooltipped').tooltip({delay: 50});
                      // $("#CTCHead").hide();
                      // $("#CTCLabel").hide();
                      // $("#CTCTotal").hide();
                      // $(".utilctc").parent().hide();
                      init_back_btn();   
                      update_total();
                      $("#approx_warning").show();
                    }
                    else{
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No data to show.'); 
                          $("#btnCloseResHistory").click();
                    }
                    $("#approx_warning").show();
                   $("#preloader").hide();
                 });

          return false;
        });
      }

      function init_back_btn() {
        $(".back_btn").on("click", function () {
          $("#CTCHead").show();
          $("#CTCLabel").show();
          $("#CTCTotal").show();
          $(".square-btn.btnResource[data-id='"+resid+"']").click(); 
        });
      }
      </script>