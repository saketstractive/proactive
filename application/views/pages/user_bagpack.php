<?php
	$today = date_create();
?>

<div class="row">

	<div class="col-lg-8">

		<div class="panel panel-default">
			<div class="panel-heading">
				Your Bag Pack
			</div>
		  	<div class="panel-body">

		  		<?php
					foreach ($user_packages as $value) {
							$pdate = date_create($value['updated_on']);
					    $doc_list = $value["p_smlist"];

				?>

						<div class="row">
						    <div class="col-lg-12">
				                <div class="form-group">
				                    <h1><?php echo $value["p_name"]; ?></h1>
				                    <?php if($value['p_type'] != 2) { ?>
				                    <span class="text-muted"><?php echo $value["stream"]." <i class='fa fa-angle-double-right'></i> ".$value["category"]." <i class='fa fa-angle-double-right'></i> ".$value["subcategory"]." <i class='fa fa-angle-double-right'></i> ".$value["subject"]; ?></span>
				                   <?php } ?>
				                </div>
				            </div>
				        </div>

				        <div class="row">
				            <div class="col-lg-12">
				                <div class="form-group">
				                    <p>
										<?php echo $value["p_desc"];?>
									</p>
				                </div>
				            </div>
				        </div>
								<?php
								if (intval(date_diff($today,$pdate)->days) < $value['p_duration'] ) {
											if ($value['p_type'] == 0) {
												?>
													<div class="row m-t-20">
														<div class="col-lg-12">
															<p class="lead">Document(s) bagpacked</p>

									          			<?php
									          			$cnt = 0 ;
									          			if ($value['p_smlist'] != "") {
									          				$this_pck = explode(',', $value['p_smlist']);
								          			 		foreach ($this_pck as $smaterial) {
								          			 			if (isset($annot_sm[$smaterial]['sm_filename'])) {
								          						echo '<a href="'. site_url("viewer/view").'/'.$annot_sm[$smaterial]['sm_filename'].'" class="btn btn-default m-b-10" target="_blank"><i class="fa fa-file-pdf-o"></i> '.$annot_sm[$smaterial]['sm_title'].'</a>&nbsp;&nbsp;	';
								          			 			}
								          			 			else{
								          			 				$cnt++;
								          			 			}

								          					}
								          					if ($cnt > 0) {
								          						echo "<p>Note: $cnt outdated item/s deleted from this package.</p>";
								          					}
									          			}

									          			?>


														</div>
													</div>
							<?php
											} // end of files attached
											else if ($value['p_type'] == 2) {
												foreach (explode(",",  $value['p_smlist']) as $pckid) {
													 ?>
													<span class="text-muted"><?php echo $annot_pcks[$pckid]["stream"]." <i class='fa fa-angle-double-right'></i> ".$annot_pcks[$pckid]["category"]." <i class='fa fa-angle-double-right'></i> ".$annot_pcks[$pckid]["subcategory"]." <i class='fa fa-angle-double-right'></i> ".$annot_pcks[$pckid]["subject"]; ?></span>
													<a href=" <?php echo site_url("user/mcq_test")."/".$annot_pcks[$pckid]['pid']; ?>" class="btn btn-default"><i class="fa fa-clock-o"></i> Take test</a>&nbsp;&nbsp;
										<?php 
												}
											}
											else {
												echo	'<a href="'.site_url("user/mcq_test")."/".$value['pid'].'" class="btn btn-default"><i class="fa fa-clock-o"></i> Take test</a>&nbsp;&nbsp;';
											 } // end of take test button
									}
									else {
											echo '<p class="text-danger lead"><i class="fa fa-exclamation-triangle"></i> Package Expired!!!</p> ';
									}
							?>

								 	<hr>

				<?php
			} // end of foreach
				?>

		  	</div>
		</div>

	</div>

	<div class="col-lg-4">
		<img src="<?php echo base_url('assets/images/360x170_ad.jpg'); ?>" />
		<div class="m-b-20"></div>
		<img src="<?php echo base_url('assets/images/360x170_cspl.jpg'); ?>" />
	</div>

</div>

<script type="text/javascript">
		var site_url = "<?php echo site_url(); ?>";
		var base_url = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript" src="<?php echo base_url("assets/js/app.js"); ?>"></script>
<script type="text/javascript">
function get_doc_info(element, selector) {
	// $(selector).append("<p class='lead'>"+element+"</p>");

	$.get(site_url+"user/load_material_by_id", {"sm_id" : element}, function(response) {
	    var obj = jQuery.parseJSON(response);
	    $.each(obj, function(i, value) {
	        $(selector).append('<a href="'+base_url+"upload/"+value['sm_filename']+'" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> '+value["sm_title"]+'</a>&nbsp;&nbsp;');
	    });
	});
}

$(document).ready(function() {
    var doc_list_str = "<?php echo $doc_list; ?>";
    var doc_list_arr = doc_list_str.split(",");

    doc_list_arr.forEach(function(element, index) {
        get_doc_info(element, "#doc_list");
    });
});

</script>
