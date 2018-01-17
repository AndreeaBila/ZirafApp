<?php
  session_start();
  session_destroy();
  //get the security file
  require_once "phpComponents/security.php";
  require_once "phpComponents/databaseConnection.php";
  if(checkCookie()){
    header("Location: newsfeed");
  }
  //check if the user has verified the email address by checking the value of the token object from the url
  //check if the token exiwsts
  if(isset($_GET['token']) && isset($_GET['userEmail'])){
    //get the value of the token
    $token = $_GET['token'];
    $userEmail = $_GET['userEmail'];
    //check if the token is the same as the on in the database
    $db = createConnection();
    $query = "SELECT activationKey FROM USERS WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $stmt->bind_result($activationKey);
    $stmt->fetch();
    $stmt->close();

    if($activationKey === $token){
      //the user has activated his email address
      //update the records
      $query = "UPDATE USERS SET emailActivation = 1 WHERE email = ?";
      $stmt = $db->prepare($query);
      $stmt->bind_param("s", $userEmail);
      $stmt->execute();
      $stmt->close();
    }
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
    <link rel="shortcut icon" href="../img/zirafSmall.png"> 

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
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="loginEmailAddon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter email*" required>
          </div>
          <!-- login password -->
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="loginPasswordAddon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
            <input type="password" class="form-control" id="exampleInputPassword1" name="loginPassword" placeholder="Enter password*" required>
          </div>

          <div id="invalidLoginAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> Your login information is invalid
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div id="emailNotConfirmedAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> You haven't confirmed your email address
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div id="accountNotConfirmedAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> Your account hasn't been verified by a member of the exec team
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div id="loginErrorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> An error has occured
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- login keep logged in -->
          <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input form-check-input" id="keepLogged" name="keepLogged[]">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">
              Keep me logged in
            </span>
          </label>

          <div class="text-center">
            <!-- login button -->
            <button type="button" class="btn btn-lg bgZiraf" id="loginBtn" name="loginBtn">Log In</button>
            <!-- create account --><br>
            <button type="button" class="btn linkBtn" id="loginToSignup" name="loginToSignup">Create New Account</button>
          </div>
          
        </form>
      </div>
      

      <!-- SIGNUP CONTAINER -->
      <div id="signupContainer">
        <!-- signup form title -->
        <h2 class="text-center" id="signupTitle">Sign Up</h2>
        <!-- SIGNUP FORM -->
        <!-- we need these alerts:
          Assuming that browser will make sure that all required fields are completed and email adress is valid
            1. Passwords don't match
            2. Password at least 8 char long?
        -->
        <form action="./phpDirectives/signup" method="POST" onsubmit="return signupVerification()" id="signupForm" name="signupForm" class="signupForm" enctype="multipart/form-data">
          <!-- signup name -->
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="signupNameAddon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="signupName" name="signupName" placeholder="Name*" required>
          </div>
          <!-- signup email -->
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="signupEmailAddon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <input type="email" class="form-control" id="signupEmail" name="signupEmail" placeholder="Email*" required>
          </div>

          <div id="uniqueEmailAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> This email address is associated with an existing account. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- signup password -->
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="signupPasswordAddon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="Password*" required>
          </div>
          <!-- signup confirm password -->
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="signupConfirmPasswordAddon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
            <input type="password" class="form-control" id="signupConfirmPassword" name="signupConfirmPassword" placeholder="Confirm Password*" required>
          </div>

          <!-- unmatching passwords alert -->
          <div id="matchingPasswordsAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> The two passwords do not match
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- signup username of social handle -->
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="signupUsernameAddon"><i class="fa fa-at" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="signupUsername" name="signupUsername" placeholder="Username of Main Social Handle">
          </div>
          <!-- signup description -->
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="signupDescriptionAddon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
            <input type="text" class="form-control" id="signupDescription" name="signupDescription" placeholder="Description">
          </div>
          <!-- signup phone number -->
          <div class="input-group input-group-lg">
            <span class="input-group-addon" id="signupUsernameAddon"><i class="fa fa-phone" aria-hidden="true"></i></span>
            <input type="tel" class="form-control" id="signupPhoneNumber" name="signupPhoneNumber" placeholder="Phone Number">
          </div>
          
          <!-- signup profile picture -->
          <div class="input-group input-group-lg">
            <input type="file" value="upload" class="form-control-lg form-control" id="signupProfilePictureBtn" name="signupProfilePictureBtn">
          </div>

          <!-- unmatching passwords alert -->
          <div id="invalidFileAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i>  Invalid picture format.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <!-- signup terms and conditions -->
          <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input form-check-input" id="termsCheckbox" name="termsCheckbox" required>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">
              I have read and agreed with the <a href="#">Terms and Conditions</a>*
            </span>
          </label>
          <small>*Required fields</small>
          <div class="text-center">
            <!-- signup submit button -->
            <button type="submit" class="btn btn-lg bgZiraf" id="signupBtn" name="signupBtn">Sign Up</button>
            <!-- signup already have an account button --><br>
            <button type="button" class="btn linkBtn" id="signupToLogin" name="singupToLogin">Already Have An Account</button>
          </div>
          
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
    <!-- JS for URI decoding -->
    <script src="../js/url.min.js"></script>
  </body>
</html>
