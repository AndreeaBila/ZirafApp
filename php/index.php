<?php
  session_start();
  session_destroy();
  //get the security file
  require_once "phpComponents/security.php";
  if(checkCookie()){
    header("Location: newsfeed");
  }
?>
<!--Main Page that will include all the other smaller sections (header, presentation, portofolio, about, contact, footer-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title>Zirafers - Log In</title>

    <meta name="description" content="The platform for zirafers to interact, find news and leave reviews">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" 
    integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    
    <!--Google Fonts for this project-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300|Roboto:300" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--media="screen, handheld">-->
    <!--<link rel="stylesheet" type="text/css" href="enhanced.css" media="screen  and (min-width: 40.5em)" /> -->

    <!-- Icon -->
    <link rel="shortcut icon" href=""> 

    <!--Capcha-->
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- [if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif] -->        
  </head>
  <body id='bodyID'>

    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

      <!-- LOGIN CONTAINER -->
      <div id="loginContainer">
        <!-- login title -->
        <h2 class="text-center" id="loginTitle">Log In</h2>

        <!-- LOGIN FORM -->
        <!-- we need these alerts:
            1. Please confirm your email address to access this account. (when email address not confirmed)
            2. Sorry! Your account applicaton hasn't been approved! If you think this is a mistake please contact us. (when application not approved)
            3. Invalid email or password
        -->
        <form id="loginForm" class="loginForm">
          <!-- login email -->
          <div class="input-group">
            <span class="input-group-addon" id="loginEmailAddon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter email" required>
          </div>
          <!-- login password -->
          <div class="input-group">
            <span class="input-group-addon" id="loginPasswordAddon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
            <input type="password" class="form-control" id="exampleInputPassword1" name="loginPassword" placeholder="Enter password" required>
          </div>
          
          <!-- login keep logged in -->
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" id="keepLogged" name="keepLogged[]">
              Keep me logged in
            </label>
          </div>
          <!-- login button -->
          <button type="button" class="btn btn-primary" id="loginBtn" name="loginBtn">Log In</button>
          <!-- create account -->
          <button type="button" class="btn" id="loginToSignup" name="loginToSignup">Create New Account</button>
        </form>
      </div>
      

      <!-- SIGNUP CONTAINER -->
      <div id="signupContainer">
        <!-- signup form title -->
        <h2 class="text-center" id="signupTitle">Sign Up</h2>
        <!-- DELETE THIS BUTTON -->
        <button type="button" id="fillSignupInfo" class="btn">Fill Signup Info</button><br><br>

        <!-- SIGNUP FORM -->
        <!-- we need these alerts:
          Assuming that browser will make sure that all required fields are completed and email adress is valid
            1. Passwords don't match
            2. Password at least 8 char long?
        -->
        <form action="./phpDirectives/signup" method="POST" onsubmit="return signupVerification()" id="signupForm" name="signupForm" class="signupForm" enctype="multipart/form-data">
          <!-- signup name -->
          <div class="input-group">
            <span class="input-group-addon" id="signupNameAddon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="signupName" name="signupName" placeholder="Name" required>
          </div>
          <!-- signup email -->
          <div class="input-group">
            <span class="input-group-addon" id="signupEmailAddon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <input type="email" class="form-control" id="signupEmail" name="signupEmail" placeholder="Email" required>
          </div>
          <!-- signup password -->
          <div class="input-group">
            <span class="input-group-addon" id="signupPasswordAddon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="Password" required>
          </div>
          <small id="passwordHelpBlock" class="form-text text-muted">
            Your password must be 8 characters long.
          </small>
          <!-- signup confirm password -->
          <div class="input-group">
            <span class="input-group-addon" id="signupConfirmPasswordAddon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
            <input type="password" class="form-control" id="signupConfirmPassword" name="signupConfirmPassword" placeholder="Confirm Password" required>
          </div>
          <!-- signup username of social handle -->
          <div class="input-group">
            <span class="input-group-addon" id="signupUsernameAddon"><i class="fa fa-at" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="signupUsername" name="signupUsername" placeholder="Username of Main Social Handle">
          </div>
          <!-- signup description -->
          <div class="input-group">
            <span class="input-group-addon" id="signupDescriptionAddon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="signupDescription" name="signupDescription" placeholder="Description">
          </div>
          <!-- signup phone number -->
          <div class="input-group">
            <span class="input-group-addon" id="signupUsernameAddon"><i class="fa fa-phone" aria-hidden="true"></i></span>
            <input type="tel" class="form-control" id="signupPhoneNumber" name="signupPhoneNumber" placeholder="Phone Number">
          </div>
          <!-- signup profile picture -->
          <div class="input-group">
            <label for="signupProfilePictureBtn">Upload Profile Picture</label>
            <input type="file" class="form-control-file" id="signupProfilePictureBtn" name="signupProfilePictureBtn">
          </div>
          <!-- signup terms and conditions -->
          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" id="termsCheckbox" name="termsCheckbox" required>
              I have read and agreed with The <a href="#">Terms and Conditions</a>
            </label>
          </div>
          <!-- signup submit button -->
          <button type="submit" class="btn btn-primary" id="signupBtn" name="signupBtn">Sign Up</button>
          <!-- signup already have an account button -->
          <button type="button" class="btn" id="signupToLogin" name="singupToLogin">Already Have An Account</button>
        </form>
      </div>
    </div>

    <!-- JS/jQuery for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" 
    integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" 
    integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/74007ae870.js"></script>

    <!-- The js script for this file -->
    <script src="../js/index.js"></script>

  </body>
</html>
