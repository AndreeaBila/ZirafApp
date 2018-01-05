$(function() {

  $('.your-checkbox').prop('indeterminate', true)
  
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
  $('#loginBtn').click(function(){
    processLoginRequest();
  });

  //verify if the enter key was pressed while the login form was selected
  $('#loginForm').keydown(function(e){
    //verify what key was pressed
    if(e.keyCode == 13){
      $('#loginBtn').click();
    }
  });

  //verify if the enter key was pressed while the signup form was selected
  $('#signupForm').keydown(function(e){
    //verify what key was pressed
    if(e.keyCode == 13){
      $('#signupBtn').click();
    }
  }); 
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
  if(typeof file == 'undefined') return true;
  var fileType = file["type"];
  var ValidImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
  if ($.inArray(fileType, ValidImageTypes) < 0) {
       return false;
  }
  return true;
}

function processLoginRequest(){
  var loginSuccess = false; //flag used to check the result of the login script
  //get the user infromation from the server
  var userData = $('#loginForm').serialize();
  //get the token value
  var token = $.url('?token', location.href);
  //alert the user data form to include the token
  if(typeof token != 'undefined'){
    userData += "&token=" + token;
  }
  //send ajax request to the server
  $.ajax({
    data: userData,
    type: "POST",
    url: "../php/phpDirectives/login.php",
    success: function(result){
      if(result === "loginInfo"){
        alert("Login information incorrect");
      }else if(result === "email"){
        alert("You haven't activated your account");
      }else if(result === "exec"){
        alert("Your account hasn't been verified by a member of the exec team");
      }else if(result === "success"){
        //redirect user
        location.href = "newsfeed";
      }else{
        alert("error");
      }
    },
    error: function(){
      alert("An error has occured");
    }
  });
}