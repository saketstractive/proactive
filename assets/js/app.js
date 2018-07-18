function truncate_string(text, length) {
    if (text.length >= length) {
        return text.substr(0, length)+"...";
    } else {
        return text;
    }
}

// Array.prototype.remove = function(value) {
//      this.splice(this.indexOf(value), 1);
//      return true;
// };
//
// function deleteArrayElement(arr, element) {
//    var i = arr.length;
//    while( i-- ) if(arr[i] == element ) arplice(i,1);
// }

// Operations related to news
function load_news(selector) {
    $.get(site_url+"admin/load_news", {limit: 5}, function(response) {
        var obj = jQuery.parseJSON(response);

        var trimmed_title;
        var status, status_button;
        var actions;

				$(selector).empty();

        $.each(obj, function(i, value) {
            trimmed_title = truncate_string(value['news_title'], 60);

            if (value['status'] == 1) {
                status = '<p class="text-success"><em>Published</em></p>';
                status_button = '<button type="button" class="btn btn-danger" id="news_status" data-id="'+value["news_id"]+'">Unpublish</button>';
            } else {
                status = '<p class="text-danger"><em>Not Published</em></p>';
                status_button = '<button type="button" class="btn btn-success" id="news_status" data-id="'+value["news_id"]+'">Publish</button>';
            }

            actions = '<div class="btn-group btn-group-sm" role="group"><a href='+site_url+"admin/news"+' type="button" class="btn btn-default">View</a><a href='+site_url+"admin/update_news/"+value["news_id"]+' type="button" class="btn btn-default">Update</a>'+status_button+'</div>';

            $(selector).append('<div class="well well-sm"><p><strong>'+trimmed_title+'</strong></p>'+status+' '+actions);
        });
    });
}

function load_news_list(selector) {
  $.get(site_url+"admin/load_news", {limit: 0}, function(response) {
      var obj = jQuery.parseJSON(response);

      var status;
      var actions;

      $(selector).empty();

      $.each(obj, function(i, value) {
          if (value['status'] == 1) {
              status = '<em>Published</em>';
              // status = '<div class="btn-group btn-group-sm" data-toggle="buttons"><label class="btn btn-default"><input type="checkbox" autocomplete="off" checked> Published</label></div>';
          } else {
              status = '<em>Not Published</em>';
              // status = '<div class="btn-group btn-group-sm" data-toggle="buttons"><label class="btn btn-default"><input type="checkbox" autocomplete="off"> Not Published</label></div>';
          }

          actions = '<div class="btn-group btn-group-sm" role="group"><button data-toggle="modal" data-id="'+value['news_id']+'" id="btnDeleteNews" class="btn btn-default">Delete</button><a href='+site_url+"admin/update_news/"+value["news_id"]+' type="button" class="btn btn-default">Update</a></div>';

          $(selector).append('<div class="well well-sm"><h2>'+value['news_title']+'&nbsp;&nbsp;<small>'+status+'</small></h2><p>'+value['news_desc']+'</p>'+actions);
      });
  });
}


// Operations related to editorials
function load_editorials(selector) {
    $.get(site_url+"admin/load_editorials", {limit: 5}, function(response) {
        var obj = jQuery.parseJSON(response);

        var trimmed_title;
        var status, status_button;
        var actions;

				$(selector).empty();

        $.each(obj, function(i, value) {
            trimmed_title = truncate_string(value['ed_title'], 60);

            if (value['status'] == 1) {
                status = '<p class="text-success"><em>Published</em></p>';
                status_button = '<button type="button" class="btn btn-danger" id="ed_status" data-id="'+value["ed_id"]+'">Unpublish</button>';
            } else {
                status = '<p class="text-danger"><em>Not Published</em></p>';
                status_button = '<button type="button" class="btn btn-success" id="ed_status" data-id="'+value["ed_id"]+'">Publish</button>';
            }

            actions = '<div class="btn-group btn-group-sm" role="group"><a href='+site_url+"admin/view_editorial/"+value["ed_id"]+' type="button" class="btn btn-default">View</a><a href='+site_url+"admin/update_editorial/"+value["ed_id"]+' type="button" class="btn btn-default">Update</a>'+status_button+'<button data-toggle="modal" data-id="'+value['ed_id']+'" id="btnDeleteEditorial" class="btn btn-default">Delete</button></div>';

            $(selector).append('<div class="col-lg-4 col-md-2 col-sm-2 col-xs-1"><div class="well well-sm"><p><strong>'+trimmed_title+'</strong></p>'+status+' '+actions+'</div>');
        });
    });
}

// function load_editorials_data(selector) {
//     $.get(site_url+"admin/load_editorials", {limit: 0}, function(response) {
//         var obj = jQuery.parseJSON(response);
//
// 				$(selector).empty();
//
//         $.each(obj, function(i, value) {
//             $(selector).append('<div class="row"><div class="col-lg-12"><p class="lead"><strong>'+value['ed_title']+'</strong></p><p>'+value['ed_desc']+'</p><p class="text-muted"><i class="fa fa-clock-o"></i> Published on '+value['published_on']+'</p></div></div><hr>');
//         });
//     });
// }


// Operations related to streams






// Operations related to exam category
function load_exam_category_list(selector) {
	$.get(site_url+"admin/load_exam_category_list", function(response) {
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th>#</th><th>Category Name</th><th>Stream</th><th>Actions</th></tr>");
		var count = 0;
        $.each(obj, function(i, value) {
        	count = count + 1;
        	$(selector).append("<tr><td>"+count+"</td><td>"+value['cat_name']+"</td><td>"+value['stream_name']+"</td><td><button class='btn btn-default btn-sm' id='btnUpdateCategory' data-toggle='modal' data-id="+value["cat_id"]+"><i class='fa fa-pencil-square-o'></i> Edit</button>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteCategory' data-toggle='modal' data-id="+value["cat_id"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
	});
}


function load_exam_category_droplist(selector) {
	$.get(site_url+"admin/load_category_list", function(response) {
		var obj = jQuery.parseJSON(response);
		$(selector).html("<option selected hidden value='0'>Select Appropriate Exam Category</option>");
        $.each(obj, function(i, value) {
        	$(selector).append("<option value="+value['cat_id']+">"+value['cat_name']+"</option>");
        });
	});
}


// Operations related to exam sub category
function load_sub_category_list(selector) {
	$.get(site_url+"admin/load_sub_category_list", function(response) {
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th>#</th><th>Sub Category Name</th><th>Category</th><th>Actions</th></tr>");
		var count = 0;
        $.each(obj, function(i, value) {
        	count = count + 1;
        	$(selector).append("<tr><td>"+count+"</td><td>"+value['subcat_name']+"</td><td>"+value['cat_name']+"</td><td><button class='btn btn-default btn-sm' id='btnUpdateSubcategory' data-toggle='modal' data-id="+value["subcat_id"]+"><i class='fa fa-pencil-square-o'></i> Edit</button>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteSubcategory' data-toggle='modal' data-id="+value["subcat_id"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
	});
}


function load_sub_category_droplist(selector) {
	$.get(site_url+"admin/load_sub_category_list", function(response) {
		var obj = jQuery.parseJSON(response);
		$(selector).html("<option selected hidden value='0'>Select Appropriate Sub Category</option>");
        $.each(obj, function(i, value) {
        	$(selector).append("<option value="+value['subcat_id']+">"+value['subcat_name']+"</option>");
        });
	});
}


// Operations related to subjects
function load_subject_list(selector) {
	$.get(site_url+"admin/load_subject_list", function(response) {
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th>#</th><th>Subject Name</th><th>Sub Category</th><th>Actions</th></tr>");
		var count = 0;
        $.each(obj, function(i, value) {
        	count = count + 1;
        	$(selector).append("<tr><td>"+count+"</td><td>"+value['subject_name']+"</td><td>"+value['subcat_name']+"</td><td><button class='btn btn-default btn-sm' id='btnUpdateSubject' data-toggle='modal' data-id="+value["subject_id"]+"><i class='fa fa-pencil-square-o'></i> Edit</button>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteSubject' data-toggle='modal' data-id="+value["subject_id"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
	});
}

function load_subject_droplist(selector) {
    $.get(site_url+"admin/load_subject_list", function(response) {
        var obj = jQuery.parseJSON(response);
        $(selector).html("<option selected hidden value='0'>Select Appropriate Subject</option>");
        $.each(obj, function(i, value) {
            $(selector).append("<option value="+value['subject_id']+">"+value['subject_name']+"</option>");
        });
    });
}


// Modal Sign In Operations
// $("#modalSigninBtn").click(function(event) {
//     event.preventDefault();
//
//     var email = $('#modalEmail').val();
//     var password = $('#modalPassword').val();
//
//     if (email != "" && password != "") {
//
//         $.ajax({
//             url: site_url+'site/auth_user',
//             type: "POST",
//             dataType: "text",
//             crossDomain: true,
//             data: {"email": email, "password": password},
//             beforeSend: function() {
//
//             },
//             success: function(response) {
//                 if (response == 1) {
//
//                     toastr.options.timeOut = 5000;
//                     toastr.options.positionClass = "toast-bottom-right";
//                     toastr.success('Signing in to your account...');
//
//                     // redirect to userhome
//                     $('#SignInModal').modal('hide');
//                     window.location.href = site_url+"user/";
//
//                 } else if (response == 0) {
//
//                     toastr.options.timeOut = 5000;
//                     toastr.options.positionClass = "toast-bottom-right";
//                     toastr.error('Invalid email / password or your email address is not verified yet.');
//
//                 }
//             },
//             complete: function() {
//                 // $("#modalEmail").val("");
//                 $("#modalPassword").val("");
//             },
//             error: function(error) {
//                 console.log(error);
//             }
//         });
//
//     } else {
//         toastr.options.timeOut = 5000;
//         toastr.options.positionClass = "toast-bottom-right";
//         toastr.info('All fields are mandatory.');
//     }
// });


// Operations related to study material
function load_study_material(selector) {
	$.get(site_url+"admin/load_study_material", {limit: 0}, function(response) {
		$(selector).empty();
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th>#</th><th>Title</th><th>Subject</th><th>Actions</th></tr>");
		var count = 0;
        $.each(obj, function(i, value) {
        	count = count + 1;
        	$(selector).append("<tr><td>"+count+"</td><td>"+value['sm_title']+"</td><td>"+value['subject_name']+"</td><td><button class='btn btn-default btn-sm' id='btnUpdateStudyMaterial' data-toggle='modal' data-id="+value["sm_id"]+"><i class='fa fa-pencil-square-o'></i> Edit</button>&nbsp;&nbsp;<a href='"+base_url+"upload/"+value['sm_filename']+"' target='_blank' class='btn btn-default btn-sm' id='btnViewStudyMaterial'><i class='fa fa-external-link'></i> View</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteStudyMaterial' data-toggle='modal' data-id="+value["sm_id"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
	});
}

function load_posters(selector) {
    $.get(site_url+"admin/load_posters", {limit: 0}, function(response) {
        $(selector).empty();
        var obj = jQuery.parseJSON(response);
        $(selector).html("<tr><th>#</th><th>Filename</th><th>Actions</th></tr>");
        var count = 0;
        $.each(obj, function(i, value) {
            count = count + 1;
            $(selector).append("<tr><td>"+count+"</td><td>"+value['sm_title']+"</td><td>"+value['subject_name']+"</td><td><button class='btn btn-default btn-sm' id='btnUpdateStudyMaterial' data-toggle='modal' data-id="+value["sm_id"]+"><i class='fa fa-pencil-square-o'></i> Edit</button>&nbsp;&nbsp;<a href='"+base_url+"upload/"+value['sm_filename']+"' target='_blank' class='btn btn-default btn-sm' id='btnViewStudyMaterial'><i class='fa fa-external-link'></i> View</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteStudyMaterial' data-toggle='modal' data-id="+value["sm_id"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
    });
}


function load_study_material_droplist(selector) {
    $.get(site_url+"admin/load_study_material_list", function(response) {
        var obj = jQuery.parseJSON(response);
        // $(selector).html("<option selected hidden value='0'>Select Appropriate Subject</option>");
        $.each(obj, function(i, value) {
            $(selector).append("<option value="+value['sm_id']+">"+value['sm_title']+"</option>");
        });
    });
}

// Operations related to free ebooks
function load_ebooks(selector) {
	$.get(site_url+"admin/load_ebooks", function(response) {
		$(selector).empty();
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th>#</th><th>Title</th><th>Actions</th></tr>");
		var count = 0;
        $.each(obj, function(i, value) {
        	count = count + 1;
        	$(selector).append("<tr><td>"+count+"</td><td>"+value['book_title']+"</td><td><button class='btn btn-default btn-sm' id='btnUpdateEbook' data-toggle='modal' data-id="+value["bid"]+"><i class='fa fa-pencil-square-o'></i> Edit</button>&nbsp;&nbsp;<a href='"+base_url+"ebooks/"+value['book_filename']+"' target='_blank' class='btn btn-default btn-sm' id='btnViewEbook'><i class='fa fa-external-link'></i> View</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteEbook' data-toggle='modal' data-id="+value["bid"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
	});
}

// Operations related to packages
function load_package(selector) {
	$.get(site_url+"admin/load_packages_list", {limit: 0}, function(response) {
		$(selector).empty();
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th>#</th><th>Package Name</th><th>Duration (in days)</th><th>Cost (in INR)</th><th>Actions</th></tr>");
		var count = 0;
        $.each(obj, function(i, value) {
        	count = count + 1;
        	/* $(selector).append("<tr><td>"+count+"</td><td>"+value['p_name']+"</td><td>"+value['p_duration']+"</td><td>"+value['p_cost']+"</td><t><button class='btn btn-default btn-sm' id='btnUpdatePackage' data-toggle='modal' data-id="+value["pid"]+"><i class='fa fa-pencil-square-o'></i> Edit</button>&nbsp;&nbsp;<a href='"+site_url+"admin/view_package/"+value['pid']+"' class='btn btn-default btn-sm' id='btnViewPackage'><i class='fa fa-external-link'></i> View</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeletePackage' data-toggle='modal' data-id="+value["pid"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>"); */
        	$(selector).append("<tr><td>"+count+"</td><td>"+value['p_name']+"</td><td>"+value['p_duration']+"</td><td>"+value['p_cost']+"</td><td><a href='"+site_url+"admin/edit_package/"+value['pid']+"' class='btn btn-default btn-sm' id='btnEditPackage'><i class='fa fa-external-link'></i> Edit</a>&nbsp;&nbsp;<a href='"+site_url+"admin/view_package/"+value['pid']+"' class='btn btn-default btn-sm' id='btnViewPackage'><i class='fa fa-external-link'></i> View</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeletePackage' data-toggle='modal' data-id="+value["pid"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
	});
}

function load_subjective_package(selector) {
    $.get(site_url+"admin/load_subjective_packages_list", {limit: 0}, function(response) {
        $(selector).empty();
        var obj = jQuery.parseJSON(response);
        $(selector).html("<tr><th>#</th><th>Package Name</th><th>Duration (in days)</th><th>Cost (in INR)</th><th>Actions</th></tr>");
        var count = 0;
        $.each(obj, function(i, value) {
            count = count + 1;
            /* $(selector).append("<tr><td>"+count+"</td><td>"+value['p_name']+"</td><td>"+value['p_duration']+"</td><td>"+value['p_cost']+"</td><t><button class='btn btn-default btn-sm' id='btnUpdatePackage' data-toggle='modal' data-id="+value["pid"]+"><i class='fa fa-pencil-square-o'></i> Edit</button>&nbsp;&nbsp;<a href='"+site_url+"admin/view_package/"+value['pid']+"' class='btn btn-default btn-sm' id='btnViewPackage'><i class='fa fa-external-link'></i> View</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeletePackage' data-toggle='modal' data-id="+value["pid"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>"); */
            $(selector).append("<tr><td>"+count+"</td><td>"+value['p_name']+"</td><td>"+value['p_duration']+"</td><td>"+value['p_cost']+"</td><td><a href='"+site_url+"admin/edit_package/"+value['pid']+"' class='btn btn-default btn-sm' id='btnEditPackage'><i class='fa fa-external-link'></i> Edit</a>&nbsp;&nbsp;<a href='"+site_url+"admin/view_package/"+value['pid']+"' class='btn btn-default btn-sm' id='btnViewPackage'><i class='fa fa-external-link'></i> View</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeletePackage' data-toggle='modal' data-id="+value["pid"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
    });
}


function load_objective_package(selector) {
  $.get(site_url+"admin/load_objective_packages_list", {limit: 0}, function(response) {
    $(selector).empty();
    var obj = jQuery.parseJSON(response);
    $(selector).html("<tr><th>#</th><th class='addCheck'>Select</th><th>Package Name</th><th>Duration (in days)</th><th>Cost (in INR)</th><th>Actions</th></tr>");
    var count = 0;
        $.each(obj, function(i, value) {
          count = count + 1;
          var chkbox = "<input type='checkbox' value='"+value['pid']+"'>";
          if(value['p_type'] == 2) chkbox = "Combo"; 
          $(selector).append("<tr><td>"+count+"</td><td class='addCheck'>"+chkbox+"</td><td>"+value['p_name']+"</td><td>"+value['p_duration']+"</td><td>"+value['p_cost']+"</td><td><a href='"+site_url+"admin/edit_mcq_package/"+value['pid']+"' class='btn btn-default btn-sm' id='btnEditMCQPackage'><i class='fa fa-edit'></i> Edit</a>&nbsp;&nbsp;<a href='"+site_url+"admin/view_package/"+value['pid']+"' class='btn btn-default btn-sm' id='btnViewPackage'><i class='fa fa-external-link'></i> View</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeletePackage' data-toggle='modal' data-id="+value["pid"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
  })
  .always(function () {
      $(".addCheck").hide();
        var joinChecked = function() {
          var arr = $("input:checked");
          var chkd = [];
          arr.each(function(){
            chkd.push($(this).val());
          });
        $("#pack_list").val(chkd.join());  
        };
         
        $( "input[type=checkbox]" ).on( "click", joinChecked );
  });
}


// Search functionality
/*function search_result(query, selector) {
	$.ajax({
			url: site_url+'site/search',
			type: "GET",
			dataType: "text",
			data: {"query": query},
			beforeSend: function() {
					// $("#updated-category-droplist").empty();
			},
			success: function(response) {
					if (response == 0) {

							// no search result found
							alert(response);

					} else {

							// show search result in selector
							alert(response);

					}
			},
			complete: function() {
					// load_category_droplist("#update-category-droplist");
			},
			error: function(error) {
					console.log(error);
			}
	});
}*/

// Operations related to recruitment
function load_recruitment_news(selector) {
    $.get(site_url+"admin/load_recruitment_news", {limit: 5}, function(response) {
        var obj = jQuery.parseJSON(response);

        var trimmed_title;
        var status, status_button;
        var actions;

				$(selector).empty();

        $.each(obj, function(i, value) {
            trimmed_title = truncate_string(value['recruit_title'], 60);

            if (value['status'] == 1) {
                status = '<p class="text-success"><em>Published</em></p>';
                status_button = '<button type="button" class="btn btn-danger" id="recruit_status" data-id="'+value["recruit_id"]+'">Unpublish</button>';
            } else {
                status = '<p class="text-danger"><em>Not Published</em></p>';
                status_button = '<button type="button" class="btn btn-success" id="recruit_status" data-id="'+value["recruit_id"]+'">Publish</button>';
              }

            actions = '<div class="btn-group btn-group-sm" role="group"><a href='+site_url+"admin/view_recruitment_news"+' type="button" class="btn btn-default">View</a><a href='+site_url+"admin/update_recruitment_news/"+value["recruit_id"]+' type="button" class="btn btn-default">Update</a>'+status_button+'</div>';

            $(selector).append('<div class="well well-sm"><p><strong>'+trimmed_title+'</strong></p>'+status+' '+actions);
        });
    });
}


function load_recruitment_news_list(selector) {
  $.get(site_url+"admin/load_recruitment_news", {limit: 0}, function(response) {
      var obj = jQuery.parseJSON(response);

      var status;
      var actions;

      $(selector).empty();

      $.each(obj, function(i, value) {
          if (value['status'] == 1) {
              status = '<em>Published</em>';
              // status = '<div class="btn-group btn-group-sm" data-toggle="buttons"><label class="btn btn-default"><input type="checkbox" autocomplete="off" checked> Published</label></div>';
          } else {
              status = '<em>Not Published</em>';
              // status = '<div class="btn-group btn-group-sm" data-toggle="buttons"><label class="btn btn-default"><input type="checkbox" autocomplete="off"> Not Published</label></div>';
          }

          actions = '<div class="btn-group btn-group-sm" role="group"><button data-toggle="modal" data-id="'+value['recruit_id']+'" id="btnDeleteRecruitNews" class="btn btn-default">Delete</button><a href='+site_url+"admin/update_recruitment_news/"+value["recruit_id"]+' type="button" class="btn btn-default">Update</a></div>';

          $(selector).append('<div class="well well-sm"><h2>'+value['recruit_title']+'&nbsp;&nbsp;<small>'+status+'</small></h2><p>'+value['recruit_desc']+'</p>'+actions);
      });
  });
}


// Operations related to testimonial
function load_testimonial(selector) {
    $.get(site_url+"admin/load_testimonial", {limit: 5}, function(response) {
        var obj = jQuery.parseJSON(response);
				$(selector).empty();

        $.each(obj, function(i, value) {

            if (value['status'] == 1) {
                status = '<p class="text-success"><em>Published</em></p>';
                status_button = '<button type="button" class="btn btn-danger" id="testimonial_status" data-id="'+value["tid"]+'">Unpublish</button>';
            } else {
                status = '<p class="text-danger"><em>Not Published</em></p>';
                status_button = '<button type="button" class="btn btn-success" id="testimonial_status" data-id="'+value["tid"]+'">Publish</button>';
              }

            actions = '<div class="btn-group btn-group-sm" role="group"><button data-toggle="modal" data-id="'+value['tid']+'" id="btnDeleteTestimonial" class="btn btn-default">Delete</button><a href='+site_url+"admin/update_testimonial/"+value["tid"]+' type="button" class="btn btn-default">Update</a>'+status_button+'</div>';

            $(selector).append('<div class="well well-sm"><p><strong>'+value["customer_name"]+'</strong></p>'+status+' '+actions);
        });
    });
}


// Operations related to package and Cart
function count_user_cart(selector, user_id) {
  $.post(site_url+"user/count_user_cart_item", {uid: user_id}, function(response) {
      $(selector).empty();
      $(selector).html(response);
  });
}


function load_user_cart_item(selector, user_id) {
  $.post(site_url+"user/load_user_cart_item", {uid : user_id}, function(response) {
    var count = 0;
    var total = 0;
    var obj = jQuery.parseJSON(response);
    $(selector).html("<tr><th>#</th><th>Package</th><th>Amount</th><th>Actions</th></tr>");

    $.each(obj, function(i, value) {
      count = count + 1;
      total = total + parseInt(value['p_cost']);
      var type = (value["pid"]>100000)?1:0;

      $(selector).append("<tr><td>"+count+"</td><td>"+value['p_name']+"</td><td class='ptype"+type+"'>"+value['p_cost']+"</td><td><button class='btn btn-default btn-sm' id='btnDeleteCartItem' data-toggle='modal' data-id="+value["cart_id"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
    });

    $("#total_amount").html('Total : <strong>Rs. '+total+' /-</strong>');
    $("#amount").val(total);
    // alert("changed "+$("#amount").val());
  });
}


// Operations related to users
function load_user_data(id) {
  $.post(site_url+"user/load_user_by_id", {uid : id}, function(response) {
    var obj = jQuery.parseJSON(response);
    $.each(obj, function(i, value) {
        $("#fullname").append('<p class="lead">'+value["fullname"]+'</p>');
        $("#email").append('<p class="lead">'+value["email"]+' <span class="edit-link text-muted"><i>you cannot edit your email address</i></span></p>');
        $("#contact").append('<p class="lead">'+value["contact"]+'</p>');
        $("#user_stream").append('<p class="lead">'+value["stream_name"]+'</p>');

        if (value["qualification"] != "" && value["qualification"] != null) {
          $("#qualification").append('<p class="lead">'+value["qualification"]+'</p>');
        } else {
          $("#qualification").append('<p class="lead text-muted"><em>Add your qualification</em></p>');
        }

        if (value["address"] != "" && value["address"] != null) {
          $("#address").append('<p class="lead">'+value["address"]+'</p>');
        } else {
          $("#address").append('<p class="lead text-muted"><em>Add your address</em></p>');
        }

        if (value["city"] != "" && value["city"] != null) {
          $("#city").append('<p class="lead">'+value["city"]+'</p>');
        } else {
          $("#city").append('<p class="lead text-muted"><em>Add your city</em></p>');
        }

        if (value["district"] != "" && value["district"] != null) {
          $("#district").append('<p class="lead">'+value["district"]+'</p>');
        } else {
          $("#district").append('<p class="lead text-muted"><em>Add your district</em></p>');
        }

        if (value["state"] != "" && value["state"] != null) {
          $("#state").append('<p class="lead">'+value["state"]+'</p>');
        } else {
          $("#state").append('<p class="lead text-muted"><em>Add your state</em></p>');
        }

        if (value["dob"] != "" && value["dob"] != null) {
          $("#dob").append('<p class="lead">'+value["dob"]+'</p>');
        } else {
          $("#dob").append('<p class="lead text-muted"><em>Add your birth date</em></p>');
        }

        if (value["gender"] != "" && value["gender"] != null) {
          $("#gender").append('<p class="lead">'+value["gender"]+'</p>');
        } else {
          $("#gender").append('<p class="lead text-muted"><em>Add your gender</em></p>');
        }

    });
  });
}


// Operations related to Question Bank
function load_question_bank(selector) {
	$.get(site_url+"admin/load_all_question_bank_list", {limit: 0}, function(response) {
		$(selector).empty();
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th>#</th><th>Questions</th><th>Actions</th></tr>");
		var count = 0;
    $.each(obj, function(i, value) {
    	count = count + 1;
      var question = '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"><div class="panel panel-default"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+count+'" aria-expanded="true" aria-controls="collapse'+count+'" class="no_anchor_decoration black-font"><div class="panel-heading" role="tab" id="heading'+count+'"><h4 class="panel-title">'+value["question"]+'</h4></div></a>';
      var answer = question + '<div id="collapse'+count+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+count+'"><div class="panel-body"><p>Option 1 : '+value["opt1"]+'</p><p>Option 2 : '+value["opt2"]+'</p><p>Option 3 : '+value["opt3"]+'</p><p>Option 4 : '+value["opt4"]+'</p><br /><p>Correct option is : '+value["answer"]+'</p><br /><p>Solution : <br />'+value["solution"]+'</p></div></div></div></div>';
    	$(selector).append("<tr><td class='col-lg-1 text-center'>"+count+"</td><td class='col-lg-9'>"+answer+"</td><td class='col-lg-2 text-center'><button class='btn btn-default btn-sm' id='btnUpdateQuestion' data-toggle='modal' data-id="+value["qid"]+"><i class='fa fa-pencil-square-o'></i></button>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteQuestion' data-toggle='modal' data-id="+value["qid"]+"><i class='fa fa-trash'></i></button></td></tr>");

    });
     
	});
}


function ret_question(selector, question) {

  $.ajax({
      url: site_url+'user/ret_question',
      type: "POST",
      dataType: "text",
      crossDomain: true,
      data: {"question": question},
      success: function(response) {
          $(selector).empty();
          var obj = jQuery.parseJSON(response);
          var data = obj.data;

          $.each(data, function(i, value) {
              var ques = '<p class="m-t-b-10"><h4>Question : </h4>'+value["question"]+'</p>';
              var options = '<p class="m-t-b-10"><h4>Options : </h4><p><input type="radio" class="userOption" name="userOption" value="'+question+':1"> '+value["opt1"]+'</p><p><input type="radio"  class="userOption" name="userOption" value="'+question+':2"> '+value["opt2"]+'</p><p><input type="radio" class="userOption" name="userOption" value="'+question+':3"> '+value["opt3"]+'</p><p><input type="radio" class="userOption" name="userOption" value="'+question+':4"> '+value["opt4"]+'</p></p><hr>';
              var navigation = '<p class="m-t-b-20"><button type="button" class="btn btn-default m-t-b-10 question" data-id="'+obj.prev+'" ><i class="fa fa-angle-double-left"></i> Prev</button>&nbsp;&nbsp;<button type="button" class="btn btn-default m-t-b-10 question"  data-id="'+obj.next+'" >Next <i class="fa fa-angle-double-right" ></i></button></p>';

              $(selector).html(ques+options+navigation);
          });
      },
      complete: function() {

      },
      error: function(error) {
          console.log(error);
      }
  });

  $(".question").each(function (i, value) {
    if ($(this).attr("data-id") == question ) {
      $(this).addClass("btn-primary active");
    }
     else{
     $(this).removeClass("btn-primary active");
     };
  });

}


//
// Subscribers related operations
//

function get_subscribers(selector, filter) {
    $(selector).html("<h3>Loading.....</h3>");
  $.post(site_url+"admin/load_subscribers_list", {"filter" : filter}, function(response) {
    var obj = jQuery.parseJSON(response);
    $(selector).empty();
    $(selector).html("<tr><th>#</th><th>Name</th><th>Actions</th></tr>");
    var count = 0;
    $.each(obj, function(i, value) {
      count = count + 1;
      $(selector).append("<tr><td class='text-center'>"+count+"</td><td><a href='"+site_url+"admin/subscriberprofile/"+value['uid']+"'>"+value['fullname']+"</a></td><td class='text-center'><input type='checkbox' data-id='"+value["uid"]+"' name='subscriber_chkbox' class='form-control subscriber_chkbox' /></td></tr>");
    });
  });
}


//
// Videos related operations
//

function load_published_videos(selector) {
  $.get(site_url+"admin/load_published_videos", function(response) {
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th class='text-center'>#</th><th class='text-center'>Title</th><th class='text-center'>Actions</th></tr>");
		var count = 0;
    $.each(obj, function(i, value) {
    	  count = count + 1;
    	  $(selector).append("<tr><td class='text-center'>"+count+"</td><td>"+value['video_title']+"</td><td class='text-center'><a href="+site_url+'admin/play/'+value["vid"]+" class='btn btn-default btn-sm' id='btnPlayVideo'><i class='fa fa-play-circle'></i> Play</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteVideo' data-toggle='modal' data-id="+value["vid"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
    });
	});
}


/////////////////////

function load_video_package(selector) {
	$.get(site_url+"admin/load_video_packages_list", {limit: 0}, function(response) {
		$(selector).empty();
		var obj = jQuery.parseJSON(response);
		$(selector).html("<tr><th>#</th><th>Package Name</th><th>Duration (in days)</th><th>Cost (in INR)</th><th>Actions</th></tr>");
		var count = 0;
        $.each(obj, function(i, value) {
        	count = count + 1;
        	$(selector).append("<tr><td>"+count+"</td><td>"+value['vp_name']+"</td><td>"+value['vp_duration']+"</td><td>"+value['vp_cost']+"</td><td><a href='"+site_url+"admin/edit_video_package/"+value['vpid']+"' class='btn btn-default btn-sm' id='btnEditVideoPackage'><i class='fa fa-external-link'></i> Edit</a>&nbsp;&nbsp;<button class='btn btn-default btn-sm' id='btnDeleteVideoPackage' data-toggle='modal' data-id="+value["vpid"]+"><i class='fa fa-trash'></i> Delete</button></td></tr>");
        });
	});
}


////////////////////////////////Show orders

function get_orders(selector, filter) {
  $.post(site_url+"admin/load_orders_list", {"filter" : filter}, function(response) {
    var obj = jQuery.parseJSON(response);
    $(selector).empty();
    $(selector).html("<tr><th>#</th><th> Name of subscriber</th> <th> Mobile no</th> <th> E-mail id</th> <th> Address</th> <th>Purchased package name</th> <th>Amount of package</th> <th>Order Date</th></tr>");
    var count = 0;
    $.each(obj, function(i, value) {
      count = count + 1;
      if (value["p_name"] == null && value["p_cost"] == null) {
        value["p_name"] = value["vp_name"];
        value["p_cost"] = value["vp_cost"];
      }
      $(selector).append("<tr><td class='text-center'>"+count+"</td><td><a href='"+site_url+"admin/subscriberprofile/"+value['uid']+"'>"+value['fullname']+"</a></td><td class='text-center'>"+value["contact"]+"</td><td class='text-center'>"+value["email"]+"</td><td class='text-center'>"+value["address"]+"</td><td class='text-center'>"+value["p_name"]+"</td><td class='text-center'>"+value["p_cost"]+"</td><td class='text-center'>"+value["added_on"]+"</td></tr>");
    });
  });
}

