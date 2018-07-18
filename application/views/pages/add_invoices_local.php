      <script type="text/javascript">
        $(document).on("ready", function () {
        $("#refresh").hide();
        $("#btnAddToBooks").attr("disabled","disabled");    
        $("#table-append").hide();
        $('select').material_select();
        update_total();

        DTtable.on("draw", update_total);

       
        $("#filterAmount").on("keyup", function(){
            filter_by_amount();
        });

        $("#operatorAmount").on("change", function () {
            filter_by_amount();
        });

        $("#btnAddToBooks").on("click", function(){

            $.post(site_url+'user/insert_invoices', $("#form-add-expenses").serialize(), function(response) {
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

        $("#btn_add_expenses").on("click", function () {
          $("#table-append").show();
          $("#btnAddToBooks").removeAttr("disabled");
          var add_id = $("#table-append tr").length;
          var project_options = "<?php echo $project_list; ?>";

            $("#table-append").append("<tr><td><input type='text' name='number"+add_id+"' class='validate' /></td><td><input type='text' name='date"+add_id+"' class='datepicker' /></td><td><select name='project"+add_id+"'>"+project_options+"</select></td><td><input type='number' min='0' class='validate' name='total"+add_id+"'/></td><td><input type='number' min='0' class='validate' name='amount"+add_id+"'/></td> </td><td><a class='red-text'><h5><i class='fa fa-trash'></i></h5></a></td></tr>");
             
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
                if($("#table-append tr").length < 2) 
                    {$("#table-append").hide(); 
                     $("#btnAddToBooks").attr("disabled","disabled");}
              });

            $('select').material_select();
            update_total();
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
                var inv_id = $(this).attr("data-id");
                $.post(site_url+'user/delete_invoice', {"inv_id":inv_id}, function(response) {
                    if(parseInt(response) > 0)
                    {
                         toastr.options.timeOut = 5000;
                         toastr.options.positionClass = "toast-up-right";
                         toastr.success('Invoice Deleted!');
                        $("#row"+inv_id).remove();
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

            //process get parameter if any
           <?php 
                if (isset($search) && $search != "") { 
                  echo "DTtable.search( '".str_replace("_", " ", $search)."' ).draw()";
                }  ?>

        }); // end of ready


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
            update_total();
        
        }


      </script>