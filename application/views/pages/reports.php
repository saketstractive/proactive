<style type="text/css">
  .collapsible-body{
    padding: 0 !important;
  }

</style>
        <div class="row center">
          <div class="col s10 m6 offset-m1 l6 offset-l1">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>           
          </div>

        </div>
        <div class="row">
          <div class="col s11 offset-s1 m11 offset-m1 l11 offset-l1">
            <h5 class="red-text">Reports </h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
        <!-- <div class="" > -->
        <div class="row">
          <div class="col s12 m12 l12 grey lighten-3">
            <ul class="collapsible popout" data-collapsible="accordion">
            <li>
              <div class="collapsible-header"><b class="orange-text"><i class="fa fa-th-large"></i>Project Profitability</b></div>
              <div class="collapsible-body">
              <div class="row all-p-15" id="select_project">
                <?php
                foreach ($project_list as $row) {
                     $backClr = 'red'; 
                     if (isset($ProjectPnL[$row['pro_id']]))
                        $revenue = $ProjectPnL[$row['pro_id']];                   
                     else
                        $revenue = 0;

                   if ($revenue > 0) {
                     $backClr = 'green'; 
                   }
                   else if($revenue == 0)
                   {
                     $backClr = 'grey'; 
                   }
                 echo '
                <div class="col s3 center">
                  <button class="btn '.$backClr.'-text white square-btn btnProject all-p-15 z-depth-5"  data-id="'.$row['pro_id'].'" >
                  <p class="center"><b class="ptitle">'.$row['pro_title'].'</b><br/>('.$revenue.')</p>
                  </button>
                </div>' ;

                } ?>
              </div>
              <div class="container" id="view_project">
                <div class="row center card grey lighten-3 z-depth-3"> 
                <div class="col s12 m12 l12 ">
                  <h5 class="blue-text">Project: <b id="proName">AZF</b> </h5> 
                </div>  
                <div class="col s12 m6 l6">
                  <p>Invoices Collected : <b id="invoice" class="green-text"></b>
                    <a id="link_inv" target="_blank" href=""><i class="fa fa-eye blue-text"></i></a>
                  </p>
                </div>
                <div class="col s12 m6 l6">
                  <p>Resource CTC : <b id="resCTC" class="red-text"></b>
                    <a id="link_history" target="_blank" href=""><i class="fa fa-eye blue-text"></i></a>
                    </p>
                </div>  
                <div class="col s12 m6 l6">
                  <p>Individual Expenses : <b id="resExpense" class="red-text"></b>
                    <a id="link_expenses1" target="_blank" href=""><i class="fa fa-eye blue-text"></i></a>
                  </p>
                </div>
                <div class="col s12 m6 l6">
                  <p>Project Level Expenses : <b id="proExpense" class="red-text"></b>
                    <a id="link_expenses2" target="_blank" href=""><i class="fa fa-eye blue-text"></i></a>
                  </p>
                </div>

                <div class="col s12 m12 l12 right">
                  <hr>
                  <p>Gross P/L : <b id="gross_profit" class="blue-text"></b></p>
                </div>
              </div>
              </div>
            </div>
          </li>
          <li>
              <div class="collapsible-header "><b class="orange-text"><i class="fa fa-user"></i>Resource Utilization <small class="grey-text"> <b>(Indicators are for working days in this month)</b></small></b></div>
              <div class="collapsible-body">
              <div class="row all-p-15" id="select_resource">
                <?php
                foreach ($resource_list as $row) {
                 $util = isset($billables[$row['res_id']]['work']) ? 100 * $billables[$row['res_id']]['work']/$wdays : 0;
                 $utiLabel = isset($billables[$row['res_id']]['work']) ? $billables[$row['res_id']]['work']."/".$wdays : "0";   
                 echo '
                <div class="col s5 offset-s1 m3 l3 center">
                  <button class="btn white square-btn btnResource all-p-15 z-depth-5 row" data-id="'.$row['res_id'].'" >
                  <span class="col s11 red-text"><span class="resname">'.$row['res_name'].'</span><BR />('.$utiLabel.')</span>
                    <div class="progress">
                    <div class="determinate" style="width: '.$util.'%"></div>
                    </div>
                  </button>
                </div>' ;

                } ?>
              </div>
              <div class="row blue lighten-4 m-t-10 z-depth-3" id="filter_resource_report">
                <!-- <div class="col s2 m2 l2"> -->
                  <!-- Filter by Date:  -->
                 <!-- </div>  -->
                 <div class="col s12 m12 l12">
                   <h5><span id="resource_name">No Resource</span> <i class=" grey-text fa fa-pencil"></i></h5>
                 </div>
                <div class="col s3 m3 l3">
                  <div class="input-field">
                    <input type="text" class="datepicker" value="<?= date("01-m-Y") ?>" id="startOfRes" name="start" />
                  </div>
                </div>  
                <div class="col s3 m3 l3">
                  <div class="input-field">
                    <input type="text" class="datepicker" value="<?= date("d-m-Y") ?>" id="endOfRes" name="end" />
                  </div>    
                </div>
                <div class="col s3 m3 l3">
                  <div class="input-field">
                    <button id="btnFilterResHistory" class="btn blue">Apply Range</button>
                  </div>    
                </div>
                <div class="col s3 m3 l3">
                  <div class="input-field">
                    <button id="btnCloseResHistory" class="btn red lighten-1 white-text">Close</button>
                  </div>    
                </div>
               </div> 
              <div class="row all-p-15" id="view_resource">
                <div class="col s12 m12 l12">
                  <table class="data-table centered responsive-table" id="utilisation_table">
                    <thead>
                    <tr>
                      <td>Project</td>
                      <td>Start</td>
                      <td>End</td>
                      <td>Hours</td>
                      <td class="center" id="CTCHead">CTC <small class="grey-text">(INR)</small></td>
                      <td class="center" id="BonusHead">Consulting Bonus <small class="grey-text">(INR)</small></td>
                      <td class="center" id="TotalHead">Subtotal <small class="grey-text">(INR)</small></td>
                      <td>Description</td>
                      <td>Action</td>
                    </tr> 
                    </thead>
                    <tbody>
                      <!-- <tr>  
                        <td>PNAME</td>
                        <td>01-01-2018</td>
                        <td>31-01-2018</td>
                        <td class="hrs">14</td>
                        <td>Pending</td>
                        <td> This is the description  </td>
                        <td><button class="blue"><i class="fa fa-eye white-text"></i></button></td>
                    </tr> -->
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="center-align"><!-- Total Hours :  --><b id="hrsTotal" class="red-text"></b></th>
                        <th class="center-align"><!-- <span id="CTCLabel">CTC :</span> --><b id="CTCTotal" class="red-text">Pending</b></th>
                        <th class="center-align"><!-- <span id="BonusLabel">Bonus :</span> --> <b id="BonusTotal" class="red-text">Pending</b></th>
                        <th class="center-align"><!-- <span id="TotalLabel">Total :</span> --> <b id="GrandTotal" class="red-text">Pending</b></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr class="red-text" id="approx_warning"><td class="center-align" colspan="9">The values in drilled down are approximate.</td> </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="col s8 offset-s2 m8 offset-m2 l8 offset-l2 grey lighten-1">
                  <!-- <p class="center">Total Hours : <b id="hrsTotal" class="red-text"></b> &nbsp; &nbsp; &nbsp; <span id="CTCLabel">CTC :</span><b id="CTCTotal" class="red-text">Pending</b>&nbsp; &nbsp; &nbsp; <span id="BonusLabel">Bonus :</span> <b id="BonusTotal" class="red-text">Pending</b>&nbsp; &nbsp; &nbsp; <span id="TotalLabel">Total :</span> <b id="GrandTotal" class="red-text">Pending</b> </p> -->
                </div>
              </div>
            </div>
          </li>
          <li>
            
              <div class="collapsible-header"><b class="orange-text"><i class="fa fa-money"></i>Resource Payable </b></div>
              <div class="collapsible-body">
                <div class="container">
                  
                <div class="row card">
                  <div class="col s12 m3 l3">
                    <select name="payableResource" id="payableResource">
                      <option value="" disabled="disabled" selected="selected">Resource</option>
                      <?php foreach ($resource_list as $row) {
                      echo "<option value='".$row['res_id']."'>".explode(" ",$row['res_name'])[0]."</option>";
                    }  ?></select>
                  </div>
                  <div class="col s12 m3 l3">
                    <select name="payableMonth" id="payableMonth">
                      <option value="">All months</option>
                      <?php foreach ($months as $key => $value) {
                      echo "<option value='".$key."'>".$value."</option>";
                      } ?>
                    </select>
                  </div>
                  <div class="col s12 m3 l3">
                    <select name="payableYear" id="payableYear">
                      <?php foreach ($years as $value) {
                      echo "<option value='".$value."'>".$value."</option>";
                      } ?>
                    </select>
                  </div>
                  <div class="col s12 m3 l3">
                    <button id="btnGetMonth" class="btn-flat green lighten-1 white-text">Get Month</button>
                  </div>

                  <!-- second line starts here -->
                  <!-- <div class="col s12 m3 l3">
                    <select><?php foreach ($resource_list as $row) {
                      echo "<option value='".$row['res_id']."'>".explode(" ",$row['res_name'])[0]."</option>";
                    }  ?></select>
                  </div> -->
                  <div class="col s12 m12 l12">
                    <p class="center">OR</p>
                  </div>
                  <div class="col s12 m3 offset-m3 l3 offset-l3">
                    <input type="text" name="inpStartPeriod" id="inpStartPeriod" class="datepicker" placeholder="Start Date" />
                  </div>
                  <div class="col s12 m3 l3">
                    <input type="text" name="inpEndPeriod" id="inpEndPeriod" class="datepicker" placeholder="End Date" />
                  </div>
                  <div class="col s12 m3 l3">
                    <button id="btnGetPeriod" class="btn-flat green lighten-1 white-text" >Get Period</button>
                  </div>
                
                </div>

                <div class="row card" id="payableTable">
                  <div class="col s4 m4 l4">
                    <h5 id="payableName">Name</h5>
                  </div>
                  <div class="col s4 m4 l4">
                    <br />
                    Period: <b id="payableStart">00-00-0000</b> :
                            <b id="payableEnd">00-00-0000</b>
                  </div>
                  <div class="col s12 m12 l12"> <hr/> </div>
                  <div class="col s6 offset-s2 m6 offset-m2 l6 offset-l2">
                    <table class="center bordered">
                      <tr>
                        <th>Bonus</th>
                        <td class="green-text">(+) <span id="payableBonus">0</span></td>
                      </tr>
                      <tr>
                        <th>Expenses</th>
                        <td class="green-text">(+) <span id="payableExpenses">0</span></td>
                      </tr>
                      <tr>
                        <th>Per Diem</th>
                        <td class="green-text">(+) <span id="payableDiem">0</span></td>
                      </tr>
                      <tr class="grey lighten-2">
                        <th>Sub Total</th>
                        <td class="green-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="payableSub">0</span></td>
                      </tr>
                      <tr>
                        <th>Advances</th>
                        <td class="red-text">(-) &nbsp; <span id="payableAdvances" class="red-text">0</span></td>
                      </tr>
                      <tr class="grey lighten-2">
                        <th>Outstanding</th>
                        <td class="green-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="payableOutstd">0</span></td>
                      </tr>
                    </table>
                    <br />
                  </div>
                  <div class="col s4 m4 l4">
                    <table>
                      <tr class="grey lighten-2">
                        <th>Salary Utilised</th>
                        <td class=""><span id="payableSalary">0</span></td>
                      </tr>
                    </table>
                  </div>

                </div>

              
                </div>
              </div>
          
          </li>
        </ul>
      </div>
        </div>
        
      