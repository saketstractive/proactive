      <script type="text/javascript">
        copyEnabled = false; 
        $(document).on("ready", function () {
        $("#refresh").hide();
        $("#btnAddToBooks").attr("disabled","disabled");    
        $("#table-append").hide();
        $('select').material_select();
        update_total();

        DTtable.on("draw", update_total);

        $("#mergeFilter").on("click", function () {
          apply_filter("merge");
        });

        $("#filterHeads").on("change",function(){
          apply_filter("heads");
        });
     
        $("#filterFrequency").on("change",function(){
            apply_filter("frequency");
        });

        $("#filterAmount").on("keyup", function(){
            apply_filter("amount");
        });

        $("#operatorAmount").on("change", function () {
            apply_filter("amount");
        });

        $("#btnAddToBooks").on("click", function(){

            $.post(site_url+'user/insert_expenses', $("#form-add-expenses").serialize(), function(response) {
                    if(parseInt(response) > 0)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.success('Entry added successfully!');
                         $("#refresh").show();
                    }
                    else{
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No data updated.'); 
                    }
                    // $("#btn-update-timesheet").attr("disabled",false);
                 });
            return false;
        });

        $("#copyRow").on("click", function () {
          copyEnabled = true; 
          $("#btn_add_expenses").click();
          return false;
        });

        $("#btn_add_expenses").on("click", function () {
          $("#table-append").show();
          $("#btnAddToBooks").removeAttr("disabled");
          add_id = $("tr.appended:last").attr("data-id");
           if (add_id == undefined) { add_id = 1;}
           else {add_id++;}
           $("#lastid").val(add_id*1+1);
          var freq_options = "<option>None</option><option>Daily</option><option>Weekly</option><option>Monthly</option><option>Yearly</option><option>Quarterly</option>";
          var head_options = "<option>Select Head</option><option>Visa</option><option>Airfare</option><option>Hotel</option><option>Taxi</option><option>FnB</option><option>Other/Misc</option>";
          var project_options = "<?php echo $project_list; ?>";

            $("#table-append").append("<tr class='appended' data-id='"+add_id+"'><td><select id='project"+add_id+"' name='project"+add_id+"'>"+project_options+"</select></td><td><select id='head"+add_id+"' name='head"+add_id+"'>"+head_options+"</select> </td><td><input type='text' id='title"+add_id+"' name='title"+add_id+"' class='validate' /></td><td><input type='text' id='date"+add_id+"' name='date"+add_id+"' class='datepicker' /></td>  <td><input type='number' min='0' class='validate' id='amount"+add_id+"' name='amount"+add_id+"'/></td><td class='hide'><select id='frequency"+add_id+"' name='frequency"+add_id+"'>"+freq_options+"</select></td><td><a class='red-text'><h5><i class='fa fa-trash'></i></h5></a></td></tr>");
             
             $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 4, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'OK',
            format: 'dd-mm-yyyy',
            max: '0D',
            closeOnSelect: true // Close upon selecting a date,
          }); 

            $(".fa-trash").on("click", function(){
                $(this).parent().parent().parent().parent().remove();
                if($("#table-append tr").length < 3) 
                    {$("#table-append").hide(); 
                     $("#btnAddToBooks").attr("disabled","disabled");}
              });
            if (copyEnabled) {
              prev = add_id - 1;
              $("#project"+add_id).val($("#project"+prev).val());
              $("#head"+add_id).val($("#head"+prev).val());
              $("#title"+add_id).val($("#title"+prev).val());
              // $("#date"+add_id).val($("#date"+prev).val());
              // $("#amount"+add_id).val($("#amount"+prev).val());
              $("#resource"+add_id).val($("#resource"+prev).val());
            }

            $('select').material_select();
            update_total();
            copyEnabled = false; //reset the flag
            return false;
          });
        $("#all-expenses").hide();
        $("#btn-toggle").on("click", function () {
          $("#my-expenses").toggle();
          $("#all-expenses").toggle();
        });

//dont use trash for delete, it is for deleting input
            $(".delexp").on("click", function(){
              if (confirm("Are your sure? \nThis operation is irreversible.")) {
                var ex_id = $(this).attr("data-id");
                $.post(site_url+'user/delete_expense', {"ex_id":ex_id}, function(response) {
                    if(parseInt(response) > 0)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.success('Expense Entry Deleted!');
                        $("#row"+ex_id).remove();
                        update_total();
                         // $("#refresh").show();
                    }
                    else{
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.warning('Sorry! No data deleted.'); 
                    }
                    // $("#btn-update-timesheet").attr("disabled",false);
                 });
              }//if ends
              });
        }); // end of ready

      function apply_filter(prompter){
          var merge = true; //$("#mergeFilter").is(":checked");
          var hd = $("#filterHeads").find(":selected").text();
          var amt = $("#filterAmount").val();
          var op = $("#operatorAmount").val();
          var freq = $("#filterFrequency").find(":selected").text();

          if (merge) {
            filter_by_all();

          }
          else{
            switch(prompter)
            {
              case "heads":
                filter_by_heads();
              break;

              case "frequency":
                filter_by_frequency();
              break;

              case "amount":
                filter_by_amount();

              default:
                update_total();
            }
          }
          show_pagination(hd, amt, op, freq);
          update_total();
      }

      function show_pagination(hd, amt, op, freq) {
        if (hd == "Select Head" && !(parseInt(amt) > 0) && freq != "Frequency") {
          $("#DataTables_Table_0_info").show();
          $("#DataTables_Table_0_paginate").show();
        }
        else
        {
          $("#DataTables_Table_0_info").hide();
          $("#DataTables_Table_0_paginate").hide();
        }
      }


      function update_total() {
        var total = 0;
        $(".amounts:visible").each(function(){
            total = total + parseInt($(this).text());
        });
        $("#myTotal").text(total);
      }

      function filter_by_all(){
        var head = $("#filterHeads").find(":selected").text();
        var freq = $("#filterFrequency").find(":selected").text();
        var amt = parseInt($("#filterAmount").val());
        var op = $("#operatorAmount").val();
        var hide = false;

        $(".data-table > tbody > tr").each(function () {
          hide = false;

          if (head != "Select Head" && head != "" ) {
            if ($(this).find(".heads").text() != head) {
              hide = true;
            }
          }
          if (amt > 0) {
            var curAmt = $(this).find(".amounts").text(); 
            if (!eval(curAmt+" "+op+" "+amt)) {
              hide = true;
            }
          }
          if (hide) {
            $(this).hide();
          }
          else{
            $(this).show();
          }
        });
      }

      function filter_by_heads() {
        var head = $("#filterHeads").find(":selected").text();
        $(".heads").each(function(){
            if(head != $(this).text() && head != "Select Head")
              $(this).parent().hide();
            else //if(!merge || head == "Select Head")
          $(this).parent().show();              
          });
      }

      function filter_by_frequency() {
        var freq = $("#filterFrequency").find(":selected").text();
          $(".frequencies").each(function(){
            if(freq != $(this).text() && freq != "Frequency")
              $(this).parent().hide();
            else //if(!merge || freq == "Frequency")
          $(this).parent().show();              
          });
      }

      function filter_by_amount(){
          var amt = $("#filterAmount").val();
          var op = $("#operatorAmount").val();
          $(".amounts").each(function(){
            if (op == ">") {
            if(parseInt(amt) > parseInt($(this).text()) && parseInt(amt) > 0)
              $(this).parent().hide();
            else //if(!merge || !(parseInt(amt) > 0))
          $(this).parent().show();
          }
        else if (op == "<") {
            if(parseInt(amt) < parseInt($(this).text()) && parseInt(amt) > 0)
              $(this).parent().hide();
            else //if(!merge || !(parseInt(amt) > 0))
          $(this).parent().show();
          } 

          });
        }


      </script>