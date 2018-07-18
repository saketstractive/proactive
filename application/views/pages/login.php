        <div class="row center">
          <div class="col s2">
          <img class="responsive-img" src="<?php echo base_url("assets/images/logo.png"); ?>" />
          </div>
          <div class="col s12">
          <h3 class="red-text lighten-text-2">Welcome to ProActive</h3>
          <?php if (isset($msg) && $msg != "") { ?>
            <h5 class="yellow-text text-darken-3"><?= $msg ?></h5>
          <?php } ?>
          </div>
          
        </div>
        <div class="row">
          <div class="col s6 offset-s3">
            <div class="card z-depth-4">
              <div class="card-title">
                <br />
                &nbsp;&nbsp;&nbsp;Login
              </div>
              <div class="card-contents">
                <div class="row">
                <form action="<?php echo site_url('site/auth_user'); ?>" method="post" class="col s12">
                  <div class="row">
                    <div class="input-field col s6 offset-s3">
                      <input id="user" name="user" type="text" class="validate" />
                      <label for="user">User</label>
                    </div>
                    <div class="input-field col s6 offset-s3">
                      <input id="password" name="password" type="password" class="validate" />
                      <label for="password">Password</label>
                    </div>
                    <div class="input-field col s6 offset-s3 center">
                      <input class="btn red lighten-1" type="submit" name="submit" value="Log in">
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      