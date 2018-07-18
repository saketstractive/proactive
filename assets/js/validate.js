validateName($("#first_name"));
validateName($("#middle_name"));
validateName($("#last_name"));
validateName($("#father_name"));
validateName($("#occupation"));
validateName($("#city"));
validateName($("#title"));
validatePAN($("#pan"),$("#submit"));
validateAADHAR($("#adhar"),$("#submit"));
validateMobile($("#mobile"),$("#submit"));
validatePhone($("#telephone"),$("#submit"));
validConsumer($("#cheque_no"),$("#submit"));
validEmail($("#email"));
validConsumer($("#consumer_no"));
validAddress($("#address"));

function validateName(element)
{
  element.on("keyup", function () {
    var str = $(this).val().replace(/^\s+/g, "");
    $(this).val(str.replace(/(?!\w|\s)./g, '').replace(/[0-9]/g,"").substring(0,30));

  });
}

function validatePAN(element,button)
{
  element.on("keyup", function () {
    var format = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
    var current = $(this).val().toUpperCase();
    if (current.length < 10) {
    var str = current.replace(/^\s+/g, "");
    $(this).val(str.replace(/(?!\w|\s)./g, ''));
    element.addClass("invalid");
    }
    else if(format.test(current)) {
      element.removeClass("invalid");       
      }
    else{
      alert("Invalid PAN");
    element.addClass("invalid");
      $(this).val(current.substring(0,10));
    }  
  });
}


//////////////////////////////

function validEmail(element) {
  element.on("change",function(){
   email = element.val().trim();
  if(email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))
    {
      return true;
    }
    else
    {
      alert("Invalid Email!");
      // $("#email").addClass("red-text");
      return false;
    } 
  });
  
}

function validateAADHAR(aadhar,button) {
    aadhar.on("keyup", function(){
      current = aadhar.val().replace(/[^0-9]+/g, '').substring(0,12);  
    aadhar.val(current);
      if (current.length != 12) {
        aadhar.addClass("invalid");
      }
      else{
       aadhar.removeClass("invalid"); 
      }
    });
    
}


function validateMobile(phone,button) {
    phone.on("keyup", function(){
      current = phone.val().replace(/[^0-9]+/g, '').substring(0,10);  
    phone.val(current);
      if (current.length == 10) {
        button.show();
      }
      else
      {
        button.hide();
      }
    });
    
}

function validatePhone(phone,button) {
    phone.on("keyup", function(){
      current = phone.val().replace(/[^0-9]+/g, '').substring(0,12);  
      phone.val(current);
    });
    
}

function validConsumer(element)
{
  element.on("keyup", function () {
  element.val(element.val().substr(0,15));
  });
}

function validAddress(element)
{
  element.on("keyup", function () {
  element.val(element.val().substr(0,300));
  });
}

$("#pincode").on("keydown",function(e){
  var zip = $(this).val();
  if (zip.length == 6 && e.keyCode != 8 ) {
    return false;
  }
});
$("#pincode").on("keyup",function(e){
  var zip = $(this).val();
  if (zip.match(/^[0-9]{0,6}$/)) {
    // if (zip.length == 6)
    // $("#submit").show();
  }
  else if(zip.length > 6)
  {
  $(this).val(zip.substring(0,6));  
  alert("Only 6 digits are allowed");
  }
  else{
    $(this).val(parseInt(zip));
    $(this).val($(this).val().replace("NaN",""));
    alert("Only numbers are allowed in Pin Code!");
    // $("#submit").hide();
  }
});

$("#submit").on("click", function(){

  if ($("#pan").val().length != 10 || $("#mobile").val().length != 10 || $("#aadhar").val().length != 12 ) {
      alert("Valid Mobile number, Aadhar UID and PAN is mandatory to submit the application.");
      return false;
    }

  $("input").each(function(){
    if ($(this).val() == "" && $(this).attr("id") != "other" && $(this).attr("id") != "mobile" && $(this).attr("id") != "telephone") {
      alert("Please fill up all the details before submitting.");
      return false;
    }

  }); 
});