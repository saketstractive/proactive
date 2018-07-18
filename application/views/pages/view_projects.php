
        <div class="row center">
          <div class="col s10 m6 offset-m1 l6 offset-l1">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>         
          </div>

        </div>
        <div class="row">
          <div class="col s6 offset-s1 m6 offset-m1 l6 offset-l1">
            <h5 class="red-text">Project <span id="page_head">List</span> <i id="close-info" class="chip grey lighten-1 right fa fa-close"></i></h5>
            
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
<!-- Extra hidden info -->
          <div class="col s12 m12 l12" id="extra-table">
            <table>
        
         <?php $count = 0; 
                foreach ($my_projects as $proj) { $count++; ?>
                  <tr class="project-info" id="project-info<?= $count ?>">
                  <td colspan="7">
                    <div class="row">
                      <?php foreach ($proj as $col => $val) {
                             if(strstr($col, "pro_") !== FALSE && $col != "pro_id"){ $col = str_replace("pro_", "", $col); 
                          $width = "s5 offset-s1 m4 l4";
                          if($col == "description") $width = "s10 offset-s1 m10 l10";
                          else if($col == "title") $width = "s5 offset-s1 m4 l4"; 
                           ?>
                        <div class="col <?= $width ?> red-text left-align p-t-b-20">
                          <?= str_replace("_", " ", strtoupper($col)) ?>: &nbsp; <span class="blue-text"><b><?= $val ?></b></span>
                        </div>
                      <?php  } } ?>  
                    </div>
                  </td>
                </tr>
         <?php } ?>
        </table>
          </div>
        <!-- Extra hidden info ends. Real list starts  -->
        <div class="row">
          <div class="col s12 m12 l12" id="list-projects"> 
            <table class="highlight centered data-table">
              <thead>
                <th>#</th>
                <th>Project Name</th>
                <!-- <th>Client Name</th> -->
                <th>On-site Schedule</th>
                <th>Offshore Schedule</th>
                <th>Bonus Applicable?</th>
                <th>Resources</th>
                <th>Approver</th>
                <th>Actions</th>
              </thead>
              <tbody>
                <?php $count = 0; 
                foreach ($my_projects as $proj) { $count++; ?>
                <tr id="row<?= $proj['pro_id'] ?>">
                <td><?= $count ?></td>
                <td><?= $proj['pro_title'] != "" ? $proj['pro_title'] : "NA" ?></td>
                <!-- <td><?= $proj['pro_client'] != "" ? $proj['pro_client'] : "NA" ?></td> -->
                <td><?= $proj['pro_onsite_start'] != "" ? $proj['pro_onsite_start'] : "NA"."<BR />".$proj['pro_onsite_end'] ?></td>
                <td><?= $proj['pro_offshore_start'] != "" ? $proj['pro_offshore_start'] : "NA"."<BR />".$proj['pro_offshore_end'] ?></td>
                <td><?= $proj['pro_billable'] == "1" ? "Yes" : "No" ?></td>
                <td><?= $proj['res_list'] != "" ? trim($proj['res_list'],",") : "NA" ?></td>
                <td><?= $proj['approver_list'] != "" ? trim($proj['approver_list'],",") : "NA" ?></td>
                <td>
                  <a class="eye" onclick="show_menu('#project-info<?= $count ?>')"><span class="chip red-text white"><i class="fa fa-eye"></i></span> </a> 

                  <a href="<?php echo site_url('user/add_project/'.$proj['pro_id']); ?>"><span class="chip red-text white"> <i class="fa fa-pencil"></i></span></a> 

                  <a class="btn-delete" data-id="<?= $proj['pro_id'] ?>" ><span class="chip red-text white"> <i class="fa fa-trash"></i></span></a> 
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

        
      