$(document).ready(function() {
    $("#new_password_container").hide();

    load_user_data(val_id);
});

$("#change_password_link").click(function() {
    $("#password_container").hide();
    $("#new_password_container").show();
    $("#new_password").focus();
});

$("#change_password_cancel_link").click(function() {
    $("#new_password_container").hide();
    $("#password_container").show();
});

$("#btnChangePassword").click(function() {
    var id = val_id;
    var new_password = $("#new_password").val();
    var confirm_password = $("#confirm_password").val();

    if (new_password != "" && confirm_password != "") {

      if (new_password == confirm_password) {

        $.ajax({
                url: site_url+'user/change_password',
                type: "POST",
                dataType: "text",
                data: {"id": id, "new_password": new_password},
                beforeSend: function() {
                  // $("#message").empty();
                },
                success: function(response) {
                  // console.log(response);
                 //    $("#message").html(response);
                  if (response == 1) {

                    $("#new_password").val("");
                    $("#confirm_password").val("");

                    $("#new_password_container").hide();
                    $("#password_container").show();

                    toastr.options.timeOut = 5000;
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.success("Password changed.");

                  } else if (response == 0) {

                    toastr.options.timeOut = 5000;
                    toastr.options.positionClass = "toast-bottom-right";
                    toastr.error("Error Occurred. Please try again later.");

                  }

                },
                error: function(error) {
                    console.log(error);
                }
            });

      } else {
        toastr.options.timeOut = 5000;
				toastr.options.positionClass = "toast-bottom-right";
				toastr.warning("Both new password and confirm password must be same.");
      }

    } else {
      toastr.options.timeOut = 5000;
      toastr.options.positionClass = "toast-bottom-right";
      toastr.error('Please enter new password and confirm your new password.');
    }
});


$("#edit-fullname").on("click", function() {
    var name = $("#fullname p").text();
    $("#fullname").empty();
    $("#edit-fullname").hide();
    $("#fullname").html('<input class="form-control m-b-10" name="new_fullname" id="new_fullname" value="'+name+'" /><button class="btn btn-primary btn-sm" onClick="update_fullname()">Update</button>&nbsp;<button class="btn btn-default btn-sm" onClick="cancel_fullname()">Cancel</button>');
});

function update_fullname() {
    var new_name = $("#new_fullname").val();

    $.ajax({
  			url: site_url+'user/update_profile_data',
  			type: "POST",
  			dataType: "text",
  			data: {"uid": val_id, "col_name": "fullname", "col_value": new_name},
  			beforeSend: function() {
  					// $("#updated-category-droplist").empty();
  			},
  			success: function(response) {
  					if (response == 1) {

              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.success("Fullname updated.");

            } else if(response == 0) {

              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.error("Error Occurred. Please try again later.");

            }
  			},
  			complete: function() {
            cancel_fullname();
  			},
  			error: function(error) {
  					console.log(error);
  			}
  	});
}

function cancel_fullname() {
  var name = $("#new_fullname").val();
  $("#fullname").empty();
  $("#fullname").html('<p class="lead">'+name+'</p>');
  $("#edit-fullname").show();
}

$("#edit-contact").on("click", function() {
    var contact = $("#contact p").text();
    $("#contact").empty();
    $("#edit-contact").hide();
    $("#contact").html('<input class="form-control m-b-10" name="new_contact" id="new_contact" value="'+contact+'" /><button class="btn btn-primary btn-sm" onClick="update_contact()">Update</button>&nbsp;<button class="btn btn-default btn-sm" onClick="cancel_contact()">Cancel</button>');
});

function update_contact() {
    var new_contact = $("#new_contact").val();

    $.ajax({
  			url: site_url+'user/update_profile_data',
  			type: "POST",
  			dataType: "text",
  			data: {"uid": val_id, "col_name": "contact", "col_value": new_contact},
  			beforeSend: function() {
  					// $("#updated-category-droplist").empty();
  			},
  			success: function(response) {
  					if (response == 1) {

              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.success("Contact number updated.");

            } else if(response == 0) {

              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.error("Error Occurred. Please try again later.");

            }
  			},
  			complete: function() {
            cancel_contact();
  			},
  			error: function(error) {
  					console.log(error);
  			}
  	});
}

function cancel_contact() {
  var contact = $("#new_contact").val();
  $("#contact").empty();
  $("#contact").html('<p class="lead">'+contact+'</p>');
  $("#edit-contact").show();
}


/////////////ADDRESS ADDED BY SAKET

$("#edit-address").on("click", function() {
    //alert("Edit address is out of service");
    var name = $("#address p").text();
    $("#address").empty();
    $("#edit-address").hide();
    $("#address").html('<input class="form-control m-b-10" name="new_address" id="new_address" value="'+name+'" /><button class="btn btn-primary btn-sm" onClick="update_address()">Update</button>&nbsp;<button class="btn btn-default btn-sm" onClick="cancel_address()">Cancel</button>');
});

function update_address() {
    var new_name = $("#new_address").val();

    $.ajax({
        url: site_url+'user/update_profile_data',
        type: "POST",
        dataType: "text",
        data: {"uid": val_id, "col_name": "address", "col_value": new_name},
        beforeSend: function() {
            // $("#updated-category-droplist").empty();
        },
        success: function(response) {
            if (response == 1) {

              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.success("Address updated.");

            } else if(response == 0) {

              toastr.options.timeOut = 5000;
              toastr.options.positionClass = "toast-bottom-right";
              toastr.error("Error Occurred. Please try again later.");

            }
        },
        complete: function() {
            cancel_address();
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function cancel_address() {
  var name = $("#new_address").val();
  $("#address").empty();
  $("#address").html('<p class="lead">'+name+'</p>');
  $("#edit-address").show();
}

///////////////



// $("#edit-qualification").on("click", function() {
//     alert($("#qualification p").text());
// });
//
// $("#edit-address").on("click", function() {
//   alert($("#address p").text());
// });
//
// $("#edit-city").on("click", function() {
//     alert($("#city p").text());
// });
//
// $("#edit-district").on("click", function() {
//     alert($("#district p").text());
// });
//
// $("#edit-state").on("click", function() {
//     alert($("#state p").text());
// });
//
// $("#edit-dob").on("click", function() {
//     alert($("#dob p").text());
// });
//
// $("#edit-gender").on("click", function() {
//     alert($("#gender p").text());
// });
