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
});

//verify the data passed by the user on the client side
function signupVerification(){
  //check if the provided email address is unique
  if(!checkUniqueEmail()){
    alert("Email not unique");
    return false;
  }
  return true;
}

function checkUniqueEmail(){
  //get the value of the email field
  var emailAddress = $('#signupEmail').val();
  var result;
  //send email address to the server and wiat for response
  $.ajax({
    async: false,
    type: "POST",
    url: "../php/phpDirectives/checkUniqueEmail.php",
    data: emailAddress,
    success: function(response){
      result = (response == "0");
    }
  });
  return result;
}