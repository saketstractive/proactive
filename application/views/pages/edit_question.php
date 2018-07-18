<div class="row">

    <div class="col-md-9">
        
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Edit Question</h3>
          </div>
          <div class="panel-body">
            <form name="" id="" action="" method="POST">

                <!-- <p class="text-muted help-block">
                    Following form is all about question bank.<br />Please choose proper subject and upload proper CSV file.<br />
                    All fields are mandatory.
                </p> -->

                <div class="row m-b-10">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Question</label>
                          <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>


                <div class="row m-b-10">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Options</label>
                          <div class="m-t-b-10">
                            <input class="form-control" type="text" />
                          </div>
                          <div class="m-t-b-10">
                            <input class="form-control" type="text" />
                          </div>
                          <div class="m-t-b-10">
                            <input class="form-control" type="text" />
                          </div>
                          <div class="m-t-b-10">
                            <input class="form-control" type="text" />
                          </div>
                        </div>
                    </div>
                </div>

                <div class="row m-b-10">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Solution</label>
                          <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row m-b-10">
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
                          <button class="btn btn-primary">Update</button>
                          <button class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div>

            </form>
          </div>

          <div class="panel-footer">
            <span><a href="<?php echo site_url('testcreator/view_question_bank'); ?>">CLICK HERE</a> TO GO BACK</span>
          </div>

        </div>

    </div>

    <?php 
    
        $this->load->view($menu); 
    
    ?>
    
</div>