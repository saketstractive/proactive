<div class="row">
    <div class="col-lg-8">

        <div class="panel panel-default">

            <div class="panel-heading">
                Your Answers and Solutions
            </div>
            <div class="panel-body">
              <div class="panel-heading">
                <h3><?= $solved_data[0]['p_name']; ?></h3>
                <p>You got <span class="text-primary"><?= $solved_data[0]['score']; ?> marks</span> Following is your analysis of answers.</p>
              </div>
            </div>

            <div class="panel-body">
                <?php

                    if (count($solved_data) != 2) {
                      echo '<div class="text-center m-t-20 m-b-30"><p class="lead text-muted">Error or invalid request!</p></div>';
                    } else {
                  // var_dump($solved_data);
                      $count = 0;
                      $attempt = explode(",", $solved_data[0]['attempt_ans_arr']);
                      $correct = explode(",", $solved_data[0]['correct_ans_arr']);                      
                      echo '<table class="table table-bordered table-hover table-striped ">';
                      echo "<tr><th>#</th><th>Question</th><th>You Marked</th><th>Answer</th><th>Description</th></tr>";
                      foreach ($solved_data['questions'] as $value) {
                          $marked = ($attempt[$count]==0)?'NA':$attempt[$count];
                          $right = $correct[$count];

                          $highlight = "danger"; 
                          if ($right==$marked) {
                            $highlight = "success"; 
                          }

                          $count = $count + 1;

                       echo "<tr class='$highlight'><th>".$count."</th><th><p class='text-left'>".$value['question']."<BR />1. ".$value['opt1']."<BR />2. ".$value['opt2']."<BR />3. ".$value['opt3']."<BR />4. ".$value['opt4']."</p></th><th>".$marked."</th><th>".$right."</th><th>".$value['solution']."</th></tr>";   
                      }
                      echo "</table>";
                    }

                 ?>
            </div>

        </div>

        

    </div>

    <div class="col-md-4">
        <img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" />
        <div class="m-b-20"></div>
        <img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" />
    </div>
</div>


<script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var val_id = "<?php echo $this->session->userdata('uid'); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/scripts/cart.js'); ?>"></script>
