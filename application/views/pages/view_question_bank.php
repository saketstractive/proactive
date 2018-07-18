<div class="row">

    <div class="col-md-9">
        
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">View and Manipulate Question Bank</h3>
          </div>
          <div class="panel-body">
            
            <div class="row m-b-10">
                <div class="col-md-12">
                    <div class="pull-left">
                        <button class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span> Delete Selected Items</button>
                    </div>

                    <div class="pull-right">
                        <select class="form-control">
                          <option selected="selected">Sort by</option>
                          <option>Subjects</option>
                        </select> 
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <tr>
                  <th class="col-md-1">Select</th>
                  <th class="col-md-9">Questions</th>
                  <th class="col-md-2">Actions</th>
                </tr>

                <tr>
                  <td class="col-md-1 center">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" />
                      </label>
                    </div>
                  </td>
                  <td class="col-md-9">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            
                              Question #1
                            </h4>
                          </div>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="col-md-2 center">
                    <a href="<?php echo site_url('testcreator/edit_question'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <button class="btn btn-default" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                </tr>

                <tr>
                  <td class="col-md-1 center">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" />
                      </label>
                    </div>
                  </td>
                  <td class="col-md-9">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            
                              Question #2
                            </h4>
                          </div>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="col-md-2 center">
                    <a href="<?php echo site_url('testcreator/edit_question'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <button class="btn btn-default" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                </tr>

                <tr>
                  <td class="col-md-1 center">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" />
                      </label>
                    </div>
                  </td>
                  <td class="col-md-9">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            
                              Question #3
                            </h4>
                          </div>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="col-md-2 center">
                    <a href="<?php echo site_url('testcreator/edit_question'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <button class="btn btn-default" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                </tr>

                <tr>
                  <td class="col-md-1 center">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" />
                      </label>
                    </div>
                  </td>
                  <td class="col-md-9">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            
                              Question #4
                            </h4>
                          </div>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="col-md-2 center">
                    <a href="<?php echo site_url('testcreator/edit_question'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <button class="btn btn-default" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                </tr>

                <tr>
                  <td class="col-md-1 center">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" />
                      </label>
                    </div>
                  </td>
                  <td class="col-md-9">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            
                              Question #5
                            </h4>
                          </div>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="col-md-2 center">
                    <a href="<?php echo site_url('testcreator/edit_question'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <button class="btn btn-default" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                </tr>

                <tr>
                  <td class="col-md-1 center">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" />
                      </label>
                    </div>
                  </td>
                  <td class="col-md-9">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel panel-default">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                            
                              Question #6
                            </h4>
                          </div>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="col-md-2 center">
                    <a href="<?php echo site_url('testcreator/edit_question'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <button class="btn btn-default" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                </tr>
              </table>
            </div>

            <div class="row m-b-10">
                <div class="col-md-12 text-center">
                    <nav aria-label="Page navigation">
                      <ul class="pagination">
                        <li>
                          <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">6</a></li>
                        <li><a href="#">7</a></li>
                        <li><a href="#">8</a></li>
                        <li><a href="#">9</a></li>
                        <li><a href="#">10</a></li>
                        <li>
                          <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                </div>
            </div>

          </div>

          <!-- <div class="panel-footer">
            <span>To view and manipulate question bank, <a href="#">click here.</a></span>
          </div> -->

        </div>

    </div>

    <?php 
    
        $this->load->view($menu); 
    
    ?>
    
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="padding: 15px;">
          <div class="text-center">
            <span class="glyphicon glyphicon-exclamation-sign" style="font-size: 36px;"></span>
            <p class="lead">Are you sure?<br />You want to delete this record?</p>
            <button class="btn btn-primary" id="deleteLottery">Delete</button>&nbsp;&nbsp;<button data-dismiss="modal" aria-label="Close" class="btn btn-default">Cancel</button>
          </div>
      </div>
    </div>
</div>