<style type="text/css">
  .square-btn{
        width: 150px !important;
        height: 150px !important;
        border: 1px solid rgb(0,0,50);
        margin-bottom: 15px;
      }

      .all-p-15{
        padding: 15px;
      }

      .min-ht{
        min-height: 400px;
        padding-bottom: 10px;
      }
</style>
        <div class="row center">
          <div class="col s10 m6 l6">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>            
          </div>

        </div>
        <div class="row">
          <div class="col s9 m9 l9">
            <h5 id="time-head" class="red-text">Timesheet </h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
        
        <!-- Select Project Starts -->
        <!-- <div class="row" id="select-project">
          <?php
          foreach ($my_projects as $row) {
             
           echo '
          <div class="col s3 center">
            <button class="btn white red-text square-btn all-p-15 z-depth-5" id="btnProject'.$row['pro_id'].'" data-id="'.$row['pro_id'].'" >
            <p class="center">'.$row['pro_title'].'</p>
            </button>
          </div>' ;

          } ?>
        </div> -->

        <!-- Update Timesheet Starts -->
        <div class="row" id="history">
      <div class="row card blue white-text z-depth-3">
        <div class="input-field col s6">
          <h6 for="project_name">Project: <b id="pro_title"><?= $pname ?></b></h6>
        </div>
        <div class="input-field col s6">
          <h6 for="client_name">Client: <b id="pro_client"><?= $pclient ?></b></h6>
        </div>
      </div>
      <div class="row card z-depth-3">
        <div class="col s12 card-title">
          Approved History <button id="closeWindow" class="btn red lighten-1 right">Close</button>
          <hr class="red-text" />
        </div>
        <div class="col s12 m12 l12">
          <table id="table-history" class="data-table striped centered">
            <thead>
              <tr>
                <th>Resource</th>
                <th>Billable Hours</th>
                <th>Work done </th>
              </tr>
            </thead>
            <tbody id="rows">
              <?php
                foreach ($cond_data as $row) {
                  echo "<tr><td>".$row['res_name']."</td><td class='work-hours'>".$row['hrs']."</td><td>".$row['wdesc']."</td></tr>";
                }
               ?>
            </tbody>
            
          </table>
          
        </div>
        <div class="col s12 m12 l12">
          <p> <blockquote> TIP: After drilling down to a week, you can press BACKSPACE to drill out from the week. </blockquote></p>
        </div>
      </div>
      <div class="row card z-depth-3" style="padding: 10px;">
        <div class="col s2 m2 l2">
          <span class="right">Total Efforts &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right grey-text"></i></span>
        </div>
        <div class="col s3 m3 l3">
          <b id="total-hours" class="red-text left">0</b>
        </div>
        
      </div>
        </div>      