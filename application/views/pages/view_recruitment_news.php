<div class="row">
    <div class="col-md-8">

        <div class="panel panel-default">
          <div class="panel-body">
            <?php
                if (count($recruitment_data) != 0) {
                  foreach($recruitment_data as $value) {
                      echo '<div class="row"><div class="col-lg-12"><h2>'.$value["recruit_title"].'</h2><p>'.$value["recruit_desc"].'</p><p><i class="fa fa-clock-o"></i> Posted On : '.$value["published_on"].'</p></div></div><hr />';
                  }
                } else {
                  echo '<div class="text-center text-muted m-t-b-100"><i class="fa fa-exclamation-triangle" style="font-size: 48px;"></i><br />No recruitment news found.</div>';
                }
             ?>
          </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="text-center m-b-10">
          <img src="http://placehold.it/360x170" class="img-responsive" />
        </div>

        <div class="text-center m-b-10">
          <img src="http://placehold.it/360x170" class="img-responsive" />
        </div>

        <div class="text-center m-b-10">
          <img src="http://placehold.it/360x340" class="img-responsive" />
        </div>
    </div>
</div>
