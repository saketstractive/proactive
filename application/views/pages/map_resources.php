        <div class="row center">
          <div class="col s10 m6 offset-m1 l6 offset-l1">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>            
          </div>

        </div>
        <div class="row">
          <div class="col s6 offset-s1 m6 offset-m1 l6 offset-l1">
            <h5 class="red-text">Add Resources to Project <a href="view_projects" class="btn white grey-text right">Home</a></h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
        <div class="row">
        <form class="container" id="formAddMap" >
      <div class="row card red white-text z-depth-3">
        <div class="col s12 m12 l12 center">
          <h6 for="project_name"><b><?= $project[0]['pro_title'] ?></b></h6>
        </div>
        <!-- <div class="input-field col s6"> -->
          <!-- <h6 for="client_name">Client: <b><?= $project[0]['pro_client'] ?></b></h6> -->
        <!-- </div> -->
        <div class="col s4 m4 l4 center">
            <h6> Calender Days: <b><?= $project[0]['pro_days'] ?></b> </h6>
            </div>
            <div class="col s4 m4 l4 center">
            <h6> Onsite Days: <b><?= $project[0]['pro_onsite_days'] ?></b> </h6>
            </div>
            <div class="col s4 m4 l4 center">
            <h6> Offshore Days: <b><?= $project[0]['pro_offshore_days'] ?></b> </h6>
            </div>  
      </div>
      <div class="row card z-depth-3">
        <div class="col s12 card-title">
          <h5>Allocate Resources</h5>
          <div class="row">
            
          </div>
          <hr class="red-text" />
              <h6 class="right" colspan="3"><button class="btn-floating red white-text " id="btn_save_resource"><i class="fa fa-save"></i></button>  <button class="btn-floating red" id="btn_add_resource" ><i class="fa fa-plus-circle "></i></button> <button class="btn-floating red" id="btn_remove_entry" ><i class="fa fa-minus-circle "></i></button> </h6>

        </div>
        <div class="col s12 m12 l12">
          <table class="centered " id="table-append">
             <thead>
             <tr>
                <th>Resource</th>
                <th>Days</th>
                <th>Type</th>
                <th>Approver</th>
              </tr>
             </thead> 
          </table>
          <table class="striped centered">
            <thead>
              <tr>
                <th>Resource</th>
                <th>Days</th>
                <th>Type</th>
                <th>Approver</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($existing_resources as $res) {
              $approv = '<i class="fa fa-close red-text"></i>'; 
              if($res['prore_approver'] == 1) $approv = '<i class="fa fa-check green-text"></i>';
               ?>
              <tr id="tr<?= $res['prore_id'] ?>">
              <td><?= $res['res_name'] ?></td>
              <td><?= $res['prore_days'] ?></td>
              <td><?= $res['prore_type'] ?></td>
              <td><?= $approv ?></td>

              <td><h5><i class="fa fa-trash red-text del-exist" data-id="<?= $res['prore_id'] ?>"></i></h5></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        
      </div>
      <div class="row">
          <div class="col s12 m12 l12">
            <hr />
          </div>
        </div>
    </form>
        </div>