        <div class="row center">
          <div class="col s10 m6 offset-m1 l6 offset-l1">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>
          </div>

        </div>
        <div class="row">
          <div class="col s6 offset-s1 m6 offset-m1 l6 offset-l1">
            <h5 class="red-text">Add Resource </h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
        <div class="row">
        <form class="container" id="formAddResource">
      <div class="row card z-depth-3">
        <div class="col s12 card-title">
          Details
          <hr class="red-text red" />
        </div>
        <div class="input-field col s6">
          <input type="text" name="user" id="user" value="<?= isset($edit_data['user'])?$edit_data['user']:"" ?>" />
          <label for="user">Username</label>
        </div>
        <div class="input-field col s5">
          <input type="password" name="password" id="password" />
          <label for="password">Password </label>
        </div>
        <div class="col s1">  
          <h5><i class="prefix fa fa-eye grey-text"></i></h5>
        </div>        
        <div class="input-field col s6">
          <input id="name" name="name" type="text" class="validate" value="<?= isset($edit_data['name'])?$edit_data['name']:"" ?>">
          <label for="name">Name</label>
        </div>
        <div class="input-field col s6">
          <input id="designation" name="designation" type="text" class="validate" value="<?= isset($edit_data['designation'])?$edit_data['designation']:"" ?>">
          <label for="designation">Designation</label>
        </div>
        <div class="input-field col s4 ">
          <input id="salary" name="salary" type="number" class="validate" value="<?= isset($edit_data['salary'])?$edit_data['salary']:"" ?>">
          <label for="salary">Salary(Month)</label>
        </div>
        <div class="input-field col s4 ">
          <input id="bonus" name="bonus" type="number" class="validate" value="<?= isset($edit_data['bonus'])?$edit_data['bonus']:"" ?>">
          <label for="bonus">Consulting Bonus (Per Year)</label>
        </div>        
        <div class="input-field col s4">
          <select name="role">
            <option value="" disabled="disabled" selected="selected">Select Access Level</option>
            <option value="1" <?php echo (isset($edit_data['role']) && $edit_data['role'] == 1)?'selected="selected"':'' ?>">Developer</option>
            <option value="2" <?php echo (isset($edit_data['role']) && $edit_data['role'] == 2)?'selected="selected"':'' ?>">Accountant</option>
            <option value="3" <?php echo (isset($edit_data['role']) && $edit_data['role'] == 3)?'selected="selected"':'' ?>">Observer(Intern)</option>
            <option value="0" <?php echo (isset($edit_data['role']) && $edit_data['role'] == 0)?'selected="selected"':'' ?>">Admin</option>
          </select>
        </div>
        <div class="input-field col s8 offset-s1">
          <h6 class="grey-text">Expertise (Press TAB after each entry)</h6>
          <input class="form-control tagit-hidden-field" id="expertise" name="expertise" type="text" value="<?= isset($edit_data['expertise'])?$edit_data['expertise']:"" ?>" />

        </div>
      </div>
      <div class="row">
          <div class="col s12 m12 l12">
            <hr />
          </div>
        </div>
      <div class="row">
        <div class="col s4 offset-s4 center">
          <button class="btn red" id="btnSubmit" name="submit">Update Resource</button>         
        </div>
      </div>
    </form>
        </div>

        
      