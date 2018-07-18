        <div class="row center">
          <div class="col s10 m6 offset-m1 l6 offset-l1">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>            
          </div>

        </div>
        <div class="row">
          <div class="col s6 offset-s1 m6 offset-m1 l6 offset-l1">
            <h5 class="red-text">Add Project </h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
        <div class="row">
        <form class="" id="formAddProject">
      <div class="row card z-depth-3">
        <div class="col s12 card-title">
          Project Details
          <hr class="red-text" />
        </div>
        <div class="input-field col s6">
          <input id="project_name" name="project_name" type="text" class="validate" value="<?= isset($edit_data['pro_title'])? $edit_data['pro_title'] : "" ?>">
          <label for="project_name">Name</label>

        </div>
        <div class="input-field col s6">
          <input id="client_name" name="client_name" type="text" class="validate" value="<?= isset($edit_data['pro_client'])? $edit_data['pro_client'] : "" ?>">
          <label for="client_name">Client</label>
        </div>
        <div class="input-field col s12">
        <span id="warning" class="red-text">Duplicate name. Entering name of existing project updates old project. Please do not use same name. </span>
        </div>
        <div class="input-field col s12 m6">
          <textarea class="materialize-textarea" id="description" name="description" class="validate" ><?= isset($edit_data['pro_description'])? $edit_data['pro_description'] : "" ?></textarea>
          <label for="description">Description</label>
        </div>
        <div class="switch col s12 m3">
            <label>
              <b>Apply bonus</b>
              <input type="checkbox" id="bonus" name="bonus" <?= (isset($edit_data['pro_billable']) && $edit_data['pro_billable']=='1' )?'checked="checked"':"" ?> />
              <span class="lever"></span>
            </label>
        </div>
        <div class="switch col s12 m3">
            <label>
              <b>Allow expenses</b>
              <input type="checkbox" id="expense" name="expense" <?= (isset($edit_data['pro_billable']) && $edit_data['pro_allow_exp']=='1' )?'checked="checked"':"" ?> />
              <span class="lever"></span>
            </label>
        </div>
       </div>
       <div class="row card z-depth-3">
        <div class="col s12">
          <p>Duration</p>
          <hr />
        </div>
        <div class="col s12">
          Project Calender
        </div>
        <div class="input-field col s4">
          <input type="date" id="start_date" name="start_date" class="datepicker" value="<?= isset($edit_data['pro_start'])? $edit_data['pro_start'] : "" ?>">
          <label for="start_date">Start date</label>
        </div>
        <div class="input-field col s4">
          <input type="date" id="end_date" name="end_date" class="datepicker" value="<?= isset($edit_data['pro_end'])? $edit_data['pro_end'] : "" ?>">
          <label for="on_end_date">Estimated End Date</label>
        </div>
        <div class="input-field col s4">
          <input id="days" type="text" name="days" value="<?= isset($edit_data['pro_days'])?$edit_data['pro_days']:"0" ?>" readonly="readonly" />
          <label for="ondays">Total Calender Days</label>
        </div><!-- new addition main duration -->
        <div class="col s12">
          On-Site duration
        </div>
        <div class="input-field col s4">
          <input type="date" id="on_start_date" name="on_start_date" class="datepicker" value="<?= isset($edit_data['pro_onsite_start'])? $edit_data['pro_onsite_start'] : "" ?>">
          <label for="on_start_date">Start date</label>
        </div>
        <div class="input-field col s4">
          <input type="date" id="on_end_date" name="on_end_date" class="datepicker" value="<?= isset($edit_data['pro_onsite_end'])? $edit_data['pro_onsite_end'] : "" ?>">
          <label for="on_end_date">Estimated End Date</label>
        </div>
        <div class="input-field col s4">
          <input id="ondays" type="text" name="ondays" value="<?= isset($edit_data['pro_onsite_days'])?$edit_data['pro_onsite_days']:"0" ?>" readonly="readonly" />
          <label for="ondays">Onsite Days</label>
        </div>
        <div class="col s12">
          Offshore duration
        </div>
        <div class="input-field col s4">
          <input type="date" id="off_start_date" name="off_start_date" class="datepicker" value="<?= isset($edit_data['pro_offshore_start'])? $edit_data['pro_offshore_start'] : "" ?>">
          <label for="off_start_date">Start date</label>
        </div>
        <div class="input-field col s4">
          <input type="date" id="off_end_date" name="off_end_date" class="datepicker" value="<?= isset($edit_data['pro_offshore_end'])? $edit_data['pro_offshore_end'] : "" ?>" >
          <label for="off_end_date">Estimated End Date</label>
        </div>
        <div class="input-field col s4">
          <input type="text" name="offdays" id="offdays" value="<?= isset($edit_data['pro_offshore_days'])? $edit_data['pro_offshore_days'] : "0" ?>" readonly="readonly">
          <label for="offdays">Offshore Days</label>
        </div>
      </div>
      <div class="row card z-depth-3">
        <div class="input-field col s8">
          <h6>Expertise Required</h6>
          <hr />
          <h6><small>(Press TAB after each entry)</small></h6>
          <input class="form-control tagit-hidden-field" id="expertise" name="expertise" type="text" value="<?= isset($edit_data['pro_expertise'])? str_replace(":", ",", $edit_data['pro_expertise']) : ""  ?>" />
        </div>
        <div class="col s12">
          <button id="btnSubmit" class="m-t-b-10 btn red right" >NEXT </button>         
        </div>
      </div>
      
    </form>
        </div>

        <div class="row">
          <div class="col s12 m12 l12">
            <hr />
          </div>
        </div>
      