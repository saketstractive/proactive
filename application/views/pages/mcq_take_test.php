<div class="row">

	<div class="col-lg-8">

		<div class="panel panel-default">
			<div class="panel-heading">
				<!-- [Test Name]
        <p> [Test Description] </p> -->
				<h4><?php echo $package_name; ?></h4>
			</div>
		  	<div class="panel-body">
				<div id="question_container">
					<p class="text-muted">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

						<button type="button" class="btn btn-default btn-lg m-t-20" onclick="startTest()">Start <i class="fa fa-angle-double-right"></i></button>
					</p>
				</div>
		  	</div>
		</div>

	</div>

	<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Question Palette</h4>
				</div>
				<div class="panel-body" id="palette" >
					<?php
						for($count = 0; $count < count($q_arr); $count++) {
							echo '<button class="btn btn-default m-b-10 question" data-id="'.$q_arr[$count].'">'.($count+1).'</button>&nbsp;&nbsp;';
						}
					 ?>
				</div>
				<div class="panel-footer">
					<button class="btn btn-primary" id="submitTest">Submit Test</button>
				</div>
			</div>
	</div>

</div>

<script type="text/javascript">
		var site_url = "<?php echo site_url(); ?>";
		var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url("assets/js/app.js"); ?>"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$(".question").prop("disabled","disabled");
		$("#submitTest").prop("disabled","disabled");
	});

	function startTest() {
		var question = $(".question").first().attr("data-id");
		ret_question("#question_container", question);
		$(".question").prop("disabled","");
		$("#submitTest").prop("disabled","");
	}

	$(document).on("click",".question",function() {
		
		var question = $(this).attr("data-id");		
		if (question == "end") {
			if(confirm("Do you want to submit?"))
			{
			$("#submitTest").click();				
			}

		}
		else{
			ret_question("#question_container", question);
		};
	});

	var count = $("#palette").children().length; 
	var a_arr = new Array(count);
	
	$(document).on("change",".userOption",function() {
		
		var pointer = $(this).val();
		var tmp = pointer.split(":");
		a_arr[tmp[0]] = tmp[1];
	});

	$("#submitTest").on("click",function() {
		$.ajax({
		      url: site_url+'user/save_result',
		      type: "POST",
		      dataType: "text",
		      crossDomain: true,
		      data: {"pid": "<?php echo $this->uri->segment(3); ?>", "attempt_ans": a_arr.toString()},
		      success: function(response) {
		          var obj = jQuery.parseJSON(response);
		          if (obj.success == 1) {

	          		var success = '<h1 class="m-t-b-30"><i class="fa fa-check-square-o"></i> Test Complete!</h1><p class="lead">You result is saved successfully.<br />You scored <strong>'+obj.score+' marks.</strong></p><p>View the <a href="<?php echo site_url("user/view_solution/"); ?>/'+obj.rid+'">solutions</a></p><p><i class="fa fa-reply"></i> Go to your <a href="<?php echo site_url("user/bagpack"); ?>" class="no_anchor_decoration">BACK PACK</a></p>';
	          		$("#question_container").html(success);

		          } else if (obj.success == 0) {
		          		
	          		var fail = '<h1 class="m-t-b-30"><i class="fa fa-frown-o"></i> Oops!</h1><p class="lead">Something went wrong.</p><p><i class="fa fa-reply"></i> Go to your <a href="<?php echo site_url("user/bagpack"); ?>" class="no_anchor_decoration">BACK PACK</a></p>';
	          		$("#question_container").html(fail);

		          }
		      },
		      complete: function() {
		      	$(".question").prop("disabled","disabled");
		      	$("#submitTest").prop("disabled","disabled");
		      },
		      error: function(error) {
		          console.log(error);
		      }
		});				
	});

</script>
