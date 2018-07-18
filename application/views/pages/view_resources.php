
        <div class="row center">
          <div class="col s10 m6 offset-m1 l6 offset-l1">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>            
          </div>

        </div>
        <div class="row">
          <div class="col s6 offset-s1 m6 offset-m1 l6 offset-l1">
            <h5 class="red-text">Resource List</h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>

        <div class="row">
          <div class="col s12 m12 l12"> 
            <table class="highlight centered">
              <thead>
                <th>#</th>
                <th>Name</th>
                <th>Projects</th>
                <th>Expertise</th>
                <th>Designation</th>
                <th>Actions</th>
              </thead>
              <tbody>
                <?php $count = 0; foreach ($my_resources as $emp) { $count++;   ?>
                <tr id="row<?= $emp['res_id'] ?>">
                <td><?= $count ?></td>
                <td><?= $emp['res_name'] ?></td>
                <?php $tmp = explode(",", $emp['projects']); $tmp = array_unique($tmp);  ?>
                <td><?= implode(",", $tmp) ?></td>
                <td><?= $emp['res_expertise'] ?></td>
                <td><?= $emp['res_designation'] ?></td>
                <td><a onclick="show_menu('#project-info<?= $count ?>')"><span class="chip red-text white"><i class="fa fa-eye"></i></span> </a> <a href="<?php echo site_url('user/add_resource/'.$emp['res_id']); ?>"><span class="chip red-text white"> <i class="fa fa-pencil"></i></span></a><a class="btn-delete" data-id="<?= $emp['res_id'] ?>" ><span class="chip red-text white"> <i class="fa fa-trash"></i></span></a> </td>
                </tr>
                <tr class="project-info white z-depth-3" id="project-info<?= $count ?>">
                  <td colspan="6">
                    <div class="row">
                      <div class="col s4 m4 l4">
                        <h5><?= $emp['res_name'] ?></h5>
                        <hr>
                      </div>  
                    </div>
                    <div class="row">
                        <div class="col s6 m4 l4 p-t-b-20">
                          <b class="grey-text">User: </b> <span class="blue-text"><?= $emp['res_user'] ?></span>
                        </div>
                        <div class="col s6 m4 l4 p-t-b-20">
                          <b class="grey-text">Projects: </b> <span class="blue-text"><?= $emp['projects'] ?></span>
                        </div>
                        <div class="col s6 m4 l4 p-t-b-20">
                          <b class="grey-text">Expertise: </b> <span class="blue-text"><?= $emp['res_expertise'] ?></span>
                        </div>
                        <div class="col s6 m4 l4 p-t-b-20">
                          <b class="grey-text">Salary: </b> <span class="blue-text"><?= $emp['res_base'] ?></span>
                        </div>
                        <div class="col s6 m4 l4 p-t-b-20">
                          <b class="grey-text">Consulting Bonus: </b> <span class="blue-text"><?= $emp['res_bonus'] ?></span>
                        </div>
                        <div class="col s6 m4 l4 p-t-b-20">
                          <b class="grey-text">Modified on: </b> <span class="blue-text"><?= $emp['res_date_modified'] ?></span>
                        </div>
                    </div>
                  </td>
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
      