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
            <h5 class="red-text">All Expenses <!-- <button id="btn-toggle" class="btn grey lighten-1 right" id="swap-expenses"><i class="fa fa-arrows-h"></i></button> --> </h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
        <!-- <div class="" > -->
        <div class="row">
          <div class="col s12 m12 l12 grey lighten-3">
            <ul class="collapsible" data-collapsible="accordion">
            <li>
              <div class="collapsible-header"><i class="fa fa-filter"></i>Filter<!-- &nbsp;&nbsp;&nbsp;<span class="purple-text">( Single - For individual columns || Merge - For multiple columns )</span> --></div>
              <div class="collapsible-body">
            <div class="row">
          <div class="col s4 l4 m4">
                    <h5>Filter:</h5>
                <!-- <div class="switch">
                    <label>
                      Single
                      <input id="mergeFilter" type="checkbox">
                      <span class="lever"></span>
                      Merge
                    </label>
                  </div>  -->
              </div>
          <div class="col s3 m3 l3">
            <div class="input-field">
            <select id="filterHeads"><option>Select Head</option><option>Visa</option><option>Airfare</option><option>Hotel</option><option>Taxi</option><option>FnB</option><option>Other/Misc</option></select>
          </div>
          </div>
        <div class="col s3 m3 l3 hide">
            <div class="input-field">
            <select id="filterFrequency"><option>Frequency</option><option>Daily</option><option>Weekly</option><option>Monthly</option><option>Yearly</option><option>Quarterly</option></select>
          </div>
        </div>
          <div class="col s3 offset-s4 m3 offset-m4 l3 offset-l4">
            <div class="input-field">
              <select id="operatorAmount"><option>></option><option><</option></select>
            </div>
          </div>
          <div class="col s3 m3 l3">
            <div class="input-field">    
            <input type="number" id="filterAmount" placeholder="Amount" / >
          </div>
        </div>
        </div>
          </li>
        </ul>
      </div>
        <form class=" col s12 m12 l12 " id="form-add-expenses" method="post">
          <input type="hidden" name="lastid" id="lastid" />
      <div class="row card z-depth-3" id="my-expenses">
        <div class="col s12 card-title">
            <button class="btn-floating white" id="btn_add_expenses">
            <i class="fa fa-plus-circle red-text"></i> </button>
            <a href="<?= site_url('user/view_expenses') ?>" class="btn-floating pulse red" id="refresh" ><i class=" white-text fa fa-refresh"></i></a>
          <h6 class="right"><button id="btnAddToBooks" class="btn green" type="submit" name="submit" > <i class="fa fa-check"></i> Submit </button></h6>    
        </div>
        <div class="col s12">
          <hr class="red-text" />
        </div>
        <div class="col s12 m12 l12">
          <table class="centered " id="table-append">
            <thead>
            <tr>
                <th>Project</th>
                <th>Head</th>
                <th>Justification</th>
                <th>Date</th>
                <th>Amount</th>
                <!-- <th>Frequency</th> -->
                <th>Resource</th>
            </tr>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <tr><td colspan="2"><button id="copyRow" class="btn grey lighten-1 black-text"> <i class="fa fa-copy"></i> Copy Row</button></td></tr>
            </tfoot>    
          </table>
          <table class="centered data-table striped">
            <thead>
              <tr>
                <th>Project</th>
                <th>Head</th>
                <th>Justification</th>
                <th>Date</th>
                <th>Amount</th>
                <!-- <th>Frequency</th> -->
                <th>Resource</th>
                <th>Status</th>
                <th>Action</th>    
              </tr>
            </thead>
            <tbody>
              <?php foreach ($all_expenses as $key => $value) {
                $status = "<span class=\"chip white-text grey \">Submitted</span>";
                $reason_inp = "<input type='text' placeholder='Reason to Reject' id='reason".$value['ex_id']."' />";
                $actions = "<i data-id='".$value['ex_id']."' class='green-text fa fa-check invert'></i>&nbsp;&nbsp;<i data-id='".$value['ex_id']."' class='red-text fa fa-close invert'></i>";

                if($value['res_name'] != "" || $value['res_name'] != null ) $value['res_name'] .= " ";
                else $value['res_name'] = "N/A ";//here trailing space is important

                if($value['pro_title'] == "" || $value['pro_title'] == null ) $value['pro_title'] .= "N/A";
                
                if ($value['ex_approved'] == "1") {
                    $status = "<span class=\"chip white-text green \">Approved</span>";
                    $actions = "<i data-id='".$value['ex_id']."' class='hide green-text fa fa-check invert'></i>&nbsp;&nbsp;<i data-id='".$value['ex_id']."' class='red-text fa fa-close invert'></i>";
                  }
                else if ($value['ex_approved'] == "2") {
                  $actions = "<i data-id='".$value['ex_id']."' class='green-text fa fa-check invert'></i>&nbsp;&nbsp;<i data-id='".$value['ex_id']."' class='hide red-text fa fa-close invert'></i>";
                  $status = "<span class=\"chip white-text red \">Rejected</span>";
                  $reason_inp = "<input type='text' class='hide' placeholder='Reason' id='reason".$value['ex_id']."' />";
                  }
                ?>
              <tr id="row<?= $value['ex_id'] ?>" class="" >
              <td><?= $value['pro_title'] ?></td>
              <td class="heads"><?= $value['ex_head'] ?></td>
              <td><?= $value['ex_title'] ?></td>
              <td><i class="hide"><?= $value['ex_date'] ?></i><?php $dtarr = explode("-", $value['ex_date']); 
                $thisdate = implode("-", array_reverse($dtarr));
               ?>
                <?= $thisdate ?></td>
              <td class="amounts"><?= $value['ex_amount'] ?></td>
              <!-- <td class="frequencies hide"><?= $value['ex_frequency'] ?></td> -->
              <td><?= substr($value['res_name'],0, strpos($value['res_name'], " ")) ?></td>
              <td id="status<?= $value['ex_id'] ?>"><?= $status ?><BR /><?= $value['reason'] ?></td>
              <td><?= $reason_inp ?><h5><?= $actions ?>&nbsp;&nbsp;<i data-id="<?= $value['ex_id'] ?>" class="red-text fa fa-trash delexp"></i></h5>  </td>
              </tr>
              <?php } ?>
              
            </tbody>
          </table>
          
        </div>
        
      </div>
      <div class="row card z-depth-3" >

      <table class="col s6 offset-s4 m6 offset-m4 l6 offset-l4 centered">
            <tr><td><b>Total</b></td><td><b class="red-text left" id="myTotal">0</b></td></tr>
          </table>
      </div>
      <!-- <div class="row card z-depth-3" id="all-expenses">
        <div class="col s12 card-title">
          All Expenses 
        </div>
        <div class="col s12">
          <hr class="red-text" />
        </div>
        <div class="col s12 m12 l12">
          <table class="centered">
            <thead>
              <tr>
                <th>Justification</th>
                <th>Head</th>
                <th>Amount</th>
                <th>Frequency</th>
                <th>Resource</th>
                <th>Project</th>      
              </tr>
            </thead>
            <tbody>
              <tr>
              <td>Dinner</td>
              <td>FnB</td>
              <td>100</td>
              <td>Daily</td>
              </tr>
              <tr>
              <td>Railway Tkt</td>
              <td>Travel</td>
              <td>1200</td>
              <td>One Time</td>
              </tr>
              
            </tbody>
          </table>

        </div>
        
      </div> -->

      <div class="row">
          <div class="col s12 m12 l12">
            <hr />
          </div>
        </div>
      
    </form>
        </div>
        
      