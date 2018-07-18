<div class="row">

    <div class="col-md-9">
        
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Create and Populate Question Bank</h3>
          </div>
          <div class="panel-body">
            <form name="" id="" action="" method="POST">

                <p class="text-muted help-block">
                    Following form is all about question bank.<br />Please choose proper subject and upload proper CSV file.<br />
                    All fields are mandatory.
                </p>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Course</label>
                          <select name="course" id="course" class="form-control">
                              <option selected hidden>Select appropriate course</option>
                          </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Choose your CSV File</label>
                          <input class="btn btn-default" type="file" />
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                      <div id="message">
                          <!-- <div class="alert alert-success"><span class="glyphicon glyphicon-ok-sign"></span> Uploaded Successfully!</div> -->
                          <!-- <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Some error occurred!</div> -->
                      </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <!-- <input type="submit" value="Sign Up" class="btn btn-primary" /> -->
                          <button class="btn btn-primary">Upload</button>
                        </div>
                    </div>
                </div>

            </form>
          </div>

          <div class="panel-footer">
            <span>To view and manipulate question bank, <a href="#">click here.</a></span>
          </div>

        </div>

    </div>

    <!-- <div class="col-md-3">
        <div class="list-group">
          <a href="#" class="list-group-item active">
            Create New Question Bank
          </a>
          <a href="#" class="list-group-item">Create Exam Set</a>
          <a href="#" class="list-group-item">Edit / Update Exam Set</a>
        </div>
    </div> -->

    <?php 
    
        $this->load->view($menu); 
    
    ?>
    
</div>