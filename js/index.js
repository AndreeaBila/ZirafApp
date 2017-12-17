$(function() {
  //=================== DELETE THIS SECTION ==================//
  $('#fillSignupInfo').click(function(){
    //fill the signup form data
    $('#signupName').val("test");
    $('#signupEmail').val("test@test.com");
    $('#signupPassword').val("test");
    $('#signupConfirmPassword').val("test");
    $('#signupUsername').val("test");
    $('#signupDescription').val("test");
    $('#signupPhoneNumber').val("test");
    $('#termsCheckbox').prop('checked', true);
  });

  //=================== END SECTION ==================//


  //hide signup form when opening ppage
  $('#signupContainer').hide();

  //hide login and show signup when "Create New Account" button is clicked
  $('#loginToSignup').click(function() {
    $('#signupContainer').show(500);
    $('#loginContainer').hide(500);
  });

  //hide signup and show login when "Already Have An Account" button is clicked
  $('#signupToLogin').click(function() {
    $('#signupContainer').hide(500);
    $('#loginContainer').show(500);
  });

  //fire login procedure
  $('#loginBtn').click(processLoginRequest());
});

//verify the data passed by the user on the client side
function signupVerification(){
  //check if the provided email address is unique
  if(!checkUniqueEmail()){
    alert("Email not unique");
    return false;
  }else if($('#signupPassword').val() != $('#signupConfirmPassword').val()){
    //check if the two passwords are equal
    alert("The two passwords do not match");
    return false;
  }else if(!checkFile()){
    //check if the submitted file is of an accepted file type
    alert("Submitted file type is not correct");
    return false;
  }
  return true;
}

function checkUniqueEmail(){
  //get the value of the email field
  var emailAddress = {emailAddress: $('#signupEmail').val()};
  var result;
  //send email address to the server and wiat for response
  $.ajax({
    async: false,
    type: "GET",
    url: "../php/phpDirectives/checkUniqueEmail.php",
    data: emailAddress,
    success: function(response){
      result = (response == "0");
    }
  });
  return result;
}

function checkFile(){
  //check the type of the uploaded file and make sure it is an image
  var file = $('#signupProfilePictureBtn')[0].files[0];
  var fileType = file["type"];
  var ValidImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
  if ($.inArray(fileType, ValidImageTypes) < 0) {
       return false;
  }
  return true;
}

function processLoginRequest(){
  //check if email has been verified
  var success = false;
  var userData = $('#loginForm').serialize();
  $.ajax({
    data: userData,
    type: "POST",
    url: "../php/phpDirectives/checkEmailVerification.php",
    complete: function(result){
      success = (result == "true");
    }
  })
}