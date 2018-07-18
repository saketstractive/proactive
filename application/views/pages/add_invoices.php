
        <div class="row center">
          <div class="col s10 m6 offset-m1 l6 offset-l1">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>           
          </div>

        </div>
        <div class="row">
          <div class="col s11 offset-s1 m11 offset-m1 l11 offset-l1">
            <h5 class="red-text">Invoices <!-- <button id="btn-toggle" class="btn grey lighten-1 right" id="swap-expenses"><i class="fa fa-arrows-h"></i></button> --> </h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
        <!-- <div class="" > -->
        <div class="row">
        <form class=" col s10 offset-s1 m10 offset-m1 l10 offset-l1" id="form-add-expenses" method="post">
      <div class="row card z-depth-3" id="my-expenses">
        <div class="col s12 card-title">
          <div class="col s12 m3 l3">
            <button class="btn-floating white" id="btn_add_expenses">
            <i class="fa fa-plus-circle red-text"></i> </button>
            <a href="<?= site_url('user/add_invoices') ?>" class="btn-floating pulse red" id="refresh" ><i class=" white-text fa fa-refresh"></i></a>
          </div>
            <div class="col s12 m2 l2">
            <div class="input-field">
              <select id="operatorAmount"><option>></option><option><</option></select>
              <label for="operatorAmount" class="red-text"><b>Filter Invoices</b></label>
            </div>
          </div>
          <div class="col s12 m3 l3">
            <div class="input-field">    
            <input type="number" id="filterAmount" placeholder="Amount" / >
          </div>
        </div>
          <div class="col s12 m4 l4">
          <h6 class="right"><button id="btnAddToBooks" class="btn red" type="submit" name="submit" > <i class="fa fa-check"></i> Submit</button></h6>    
        </div>
        </div>
        <div class="col s12">
          <hr class="red-text" />
        </div>
        <div class="col s12 m12 l12">
          <table class="centered responsive-table" id="table-append">
            <thead>
            <tr>
                <th>Inv Number</th>
                <th>Date</th>
                <th>Project</th>
                <th>Invoice Amount</th>
                <th>Rec. Amount</th>
            </tr>
            </thead>    
          </table>
          <table class="centered data-table responsive-table">
            <thead>
              <tr>
                <th>Inv Number</th>
                <th>Date</th>
                <th>Project</th>
                <th>Invoice Amount</th>
                <th>Received Amount</th>
                <th>Action</th>    
              </tr>
            </thead>
            <tbody>
              <?php foreach ($my_invoices as $key => $value) { 
                // $invno = 
                ?>
              <tr id="row<?= $value['inv_id'] ?>">
              <td><?= $value['inv_number'] ?></td>
              <td><i class="hide"><?= $value['inv_date'] ?></i><?php $dtarr = explode("-", $value['inv_date']); 
                $thisdate = implode("-", array_reverse($dtarr));
               ?>
                <?= $thisdate ?></td>
              <td><?= $value['pro_title'] ?></td>
              <td class=""><?= $value['inv_total'] ?></td>
              <td class="amounts"><?= $value['inv_amount'] ?></td>
              <td><h5><i data-id="<?= $value['inv_id'] ?>" class="red-text fa fa-trash delexp"></i></h5></td>
              </tr>
              <?php } ?>
              
            </tbody>
          </table>
          
        </div>
        
      </div>
      <div class="row card z-depth-3" >

      <table class="col s6 offset-s2 m6 offset-m2 l6 offset-l2 centered">
            <tr><td><b>Total</b></td><td><b class="red-text left" id="myTotal">0</b></tr>
          </table>
      </div>
      

      <div class="row">
          <div class="col s12 m12 l12">
            <hr />
          </div>
        </div>
      
    </form>
        </div>
        
      