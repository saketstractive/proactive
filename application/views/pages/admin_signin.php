<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="m-t-b-20">
            <?php 
                if (isset($signout_msg) && !empty($signout_msg)) {
                    echo $signout_msg;
                }
                
             ?>
        </div>
        <div class="panel panel-default login-dialog">
            <div class="panel-body">
                <form id="admin_login" name="admin_login" action="<?php echo site_url('admin/auth_user'); ?>" method="POST">
                    <div class="text-center">
                        <h2 class="help-block">Sign in to your account</h2> <hr>
                    </div>

                    <div class="form-group">
                        <!-- <label>Username</label> -->
                        <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" autofocus>
                    </div>
                  
                    <div class="form-group">
                        <!-- <label>Password</label> -->
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
                    </div>

                    <?php 

                        if (isset($msg) && !empty($msg)) {
                            echo $msg;
                        }

                     ?>
                  
                    <input type="submit" value="Sign in" class="btn btn-primary btn-block btn-lg"><hr>

                    <div class="text-center" style="margin-top: 20px;">
                        <a href="<?php echo site_url(); ?>" class="no_anchor_decoration"><p class="help-block"><i class="fa fa-reply"></i> go to home page</p></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>