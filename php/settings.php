<?php
  session_start();
  //import the security file
  require_once "./phpComponents/security.php";
  //check authentication
  authenticate();
  //get the user information from the database
  //create a database connection
  require_once "./phpComponents/databaseConnection.php";
  $db = createConnection();
  //get the user id
  $userId = $_SESSION['userId'];

  $query = "SELECT userName, email, socialHandle, phone FROM USERS WHERE userId = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("s", $userId);
  $stmt->execute();
  $stmt->bind_result($userName, $email, $socialHandle, $phone);
  $stmt->fetch();
  $stmt->close();
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
    <meta 

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

    <div id="wrapper" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

      <?php
        include './phpComponents/header.php';
      ?>
      
      <div id="settings">
        <h2 class="text-center">Account Settings</h2>
        <form action="./phpDirectives/updateUserSettings" method="POST" onsubmit="return submitUserData()" id="updateSettingsForm">
          <!-- settings name -->
          <div class="form-group">

            <div id="settingsFieldsAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> All required fields must be filled
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <label for="settingsName">Name*</label>
            <input type="text" class="form-control form-control-lg" id="settingsName" name="settingsName" required value=<?php echo "$userName"; ?>>
          </div>
          <!-- settings email -->
          <div class="form-group">
            <label for="settingsEmail">Email Address*</label>
            <input type="email" class="form-control form-control-lg" id="settingsEmail" name="settingsEmail" required value=<?php echo "$email"; ?>>
            <div id="settingsFieldsAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> This email address is already in use
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div id="settingsFieldsAlert" class="alert alert-success alert-dismissible fade show" role="alert">
              Please confirm your new email address
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <!-- settings password -->
          <div class="form-group">
            <label for="settingsPassword">New Password</label>
            <input type="password" class="form-control form-control-lg" id="settingsPassword" name="settingsPassword" placeholder="Enter New Password">
          </div>
          <!-- settings confirm password -->
          <div class="form-group">
          <label for="settingsConfirmPassword">Confirm New Password</label>
            <input type="password" class="form-control form-control-lg" id="settingsConfirmPassword" name="settingsConfirmPassword" placeholder="Confirm New Password">

            <div id="settingsFieldsAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> The two passwords do not match
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <!-- settings username of social handle -->
          <div class="form-group">
            <label for="settingsUsername">Username of Main Social Handle</label>
            <input type="text" class="form-control form-control-lg" id="settingsUsername" name="settingsUsername" required value=<?php echo "$socialHandle"; ?>>
          </div>
          <!-- settings phone number -->
          <div class="form-group">
            <label for="settingsPhoneNumber">Phone Number</label>
            <input type="tel" class="form-control form-control-lg" id="settingsPhoneNumber" name="settingsPhoneNumber" required value=<?php echo "$phone"; ?>>
            <small>*Required fields</small>
          </div>

          
          
          <!-- settings submit button -->
          <div class="text-center">
            <button type="submit" class="btn btn-lg bgNeutral" id="settingsBtn" name="settingsBtn">Save Changes</button>
          </div>
          
        </form>

      </div>


      </div>

      <?php
        include './phpComponents/footer.php';
      ?>
      

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
    <script src="../js/settings.js"></script>

  </body>
</html>
