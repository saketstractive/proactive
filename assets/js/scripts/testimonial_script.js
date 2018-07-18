$(document).ready(function() {
	$('#testimonial_desc').summernote({
    	height: 150
    });
});

//
// Insertion
// Testimonial News
//
$("#btnPublishTestimonial").click(function() {

	var customer_name = $('#customer_name').val();
	var testimonial_desc = $('textarea[name="testimonial_desc"]').val();

	if (customer_name != "" && testimonial_desc != "") {

		$.ajax({
            url: site_url+'admin/publish_testimonial',
            type: "POST",
            dataType: "text",
            data: {"customer_name": customer_name, "testimonial_desc": testimonial_desc},
            success: function(response) {
                if (response == 1) {

                    toastr.options.timeOut = 5000;
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.success('Testimonial published successfully.');

                } else if (response == 0) {

                    toastr.options.timeOut = 5000;
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.error('Some error occurred. Please try again.');

                }
            },
            complete: function() {
                $("#customer_name").val("");
                $("#testimonial_desc").summernote('reset');
								load_testimonial("#published_testimonials");
            },
            error: function(error) {
                console.log(error);
            }
        });

	} else {
				toastr.options.timeOut = 5000;
        toastr.options.positionClass = "toast-bottom-right";
        toastr.info('All fields are mandatory.');
	}

});

var tid;

//
// Toggle
// Testimonial Status
//

$(document).on("click", "#testimonial_status", function() {
    tid = $(this).attr("data-id");

    var jqxhr = $.post(site_url+"admin/toggle_testimonial_status", {"tid" : tid}, function(response) {
        if (response == 1) {
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-bottom-right";
            toastr.success('Status Changed.');
        } else if(response == 0) {
            toastr.options.timeOut = 5000;
            toastr.options.positionClass = "toast-bottom-right";
            toastr.error('Some error occurred. Please try again.');
        }
    })
    .done(function() {
        load_testimonial("#published_testimonials");
    });
});


//
// Updation
// Testimonial
//
$("#btnUpdateTestimonial").click(function() {
		var tid = $("#tid").val();
		var customer_name = $("#update_customer_name").val();
		var testimonial_desc = $("#update_testimonial_desc").val();

		if (customer_name != "" && testimonial_desc != "") {
			$.ajax({
          url: site_url+'admin/update_testimonial_details',
          type: "POST",
          dataType: "text",
          data: {"tid": tid, "customer_name": customer_name, "testimonial_desc": testimonial_desc},
          success: function(response) {
              if (response == 1) {

                  toastr.options.timeOut = 5000;
                  toastr.options.positionClass = "toast-bottom-right";
                  toastr.success('Testimonial updated successfully.');

              } else if (response == 0) {

                  toastr.options.timeOut = 5000;
                  toastr.options.positionClass = "toast-bottom-right";
                  toastr.error('Some error occurred. Please try again.');

              }
          },
          complete: function() {
							//
							// $("#update_customer_name").val("");
	            // $("#update_testimonial_desc").summernote('reset');
							// load_news("#published_news");
          },
          error: function(error) {
              console.log(error);
          }
      });

		} else {
			toastr.options.timeOut = 5000;
			toastr.options.positionClass = "toast-bottom-right";
			toastr.info('All fields are mandatory.');
		}
});


//
// Deletion
// Testimonial
//
$(document).on("click", "#btnDeleteTestimonial", function() {
    $(".delete-testimonial-modal").modal("show");
    tid = $(this).attr("data-id");
});

$("#deleteTestimonial").click(function() {
	$.ajax({
			url: site_url+'admin/delete_testimonial',
			type: "POST",
			dataType: "text",
			data: {"tid" : tid},
			crossDomain: true,
			cache: false,
			beforeSend: function() {
					// $("#update-category-droplist").empty();
			},
			success: function(response) {
					$(".delete-testimonial-modal").modal("hide");
					if (response == 1) {
							toastr.options.timeOut = 5000;
							toastr.options.positionClass = "toast-bottom-right";
							toastr.success('Testimonial deleted successfully.');
					} else if(response == 0) {
							toastr.options.timeOut = 5000;
							toastr.options.positionClass = "toast-bottom-right";
							toastr.error('Some error occurred. Please try again.');
					}
			},
			complete: function() {
					$(".delete-testimonial-modal").modal("hide");
					load_testimonial("#published_testimonials");
			},
			error: function(error) {
					console.log(error);
			}
	});
});
