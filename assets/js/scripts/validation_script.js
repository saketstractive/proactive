$(document).ready(function() {

	$("#login_form").validate({
        rules : {
            email : {
                required : true,
                email : true
            },
            password : {
                required : true
            }
        },

        messages : {
            email : {
                required : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please enter your email</h5>",
                email : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please provide your email address in valid format</h5>"
            },

            password : {
                required : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please enter your password</h5>"
            }
        },

        submitHandler: function(form) {
		    		form.submit();
				}

    });

	$("#register_user").validate({
        rules : {
            fullname : {
                required : true
            },

            stream : {
            	required : true,
                min : 1
            },

            contact : {
                required : true,
                digits : true,
                minlength : 10,
                maxlength : 10
            },
            email : {
                required : true,
                email : true,
                remote : {
                    url : site_url+"site/check_email",
                    type : "POST"
                }
            },
            password : {
                required : true,
                minlength : 8
            },
            confirm_password : {
                required : true,
                minlength : 8,
                equalTo : "#password"
            }
        },

        messages : {
            fullname : {
                required : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please enter your name</h5>"
            },

            stream : {
                required : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please select your stream</h5>"
            },

            contact : {
                required : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please enter your mobile number </h5>",
                digits : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please enter your mobile number in proper format</h5>",
                minlength : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Mobile number is not less than 10 digit</h5>",
                maxlength : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Mobile number is not more than 10 digit</h5>"
            },

            email : {
                required : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please enter your email</h5>",
                email : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please provide your email address in valid format</h5>",
                remote : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Email already exists.</h5>"
            },

            password : {
                required : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Please enter your password</h5>",
                minlength : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Your password must be at least 8 characters long</h5>"
            },

            confirm_password : {
                required : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Rewrite your password</h5>",
                minlength : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Your password must be at least 8 characters long</h5>",
                equalTo : "<h5 class='text-danger'><i class='fa fa-exclamation-circle'></i> Your password doesn't match</h5>"
            }
        },

        submitHandler: function(form) {
		    		form.submit();
				}

    });


});
