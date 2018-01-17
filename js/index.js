$(function() {

  $('.alert').hide();
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

  //style upload file
  $('input[type=file]').each(function()
  {
      $(this).attr('onchange',"sub(this)");
      $('<div id="uploadProfilePicBtn" onclick="getFile()"><i class="fa fa-camera-retro" aria-hidden="true"></i> Choose a Profile Picture</div>').insertBefore(this);
      $(this).wrapAll('<div style="height: 0px;width: 0px; overflow:hidden;"></div>');
  });
});

//upload file button
function getFile(){
  $('input[type=file]').click();
}
function sub(obj){
 var file = obj.value;
 var fileName = file.split("\\");
 document.getElementById("uploadProfilePicBtn").innerHTML = fileName[fileName.length-1];
}

//verify the data passed by the user on the client side
function signupVerification(){
  //check if the provided email address is unique
  if(!checkUniqueEmail()){
    $('#uniqueEmailAlert').show();
    return false;
  }else if($('#signupPassword').val() != $('#signupConfirmPassword').val()){
    //check if the two passwords are equal
    $('#matchingPasswordsAlert').show();
    return false;
  }else if(!checkFile()){
    //check if the submitted file is of an accepted file type
    $('#invalidFileAlert').show();
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
  
  //send ajax request to the server
  $.ajax({
    data: userData,
    type: "POST",
    url: "../php/phpDirectives/login.php",
    success: function(result){
      if(result === "loginInfo"){
        $('#invalidLoginAlert').show();
      }else if(result === "email"){
        $('#emailNotConfirmedAlert').show();
      }else if(result === "exec"){
        $('#accountNotConfirmedAlert').show();
      }else if(result === "success"){
        //redirect user
        location.href = "newsfeed";
      }else{
        $('#loginErrorAlert').show();
      }
    },
    error: function(){
      $('#loginErrorAlert').show();
    }
  });
}