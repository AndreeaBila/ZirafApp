<?php
  session_start();
  //import the security file
  require_once "./phpComponents/security.php";
  //check authentication
  authenticate();
  //check the clearance level
  if(!checkClearance()){
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
      
      <div id="execPanel">
        <h4>
          <!-- get number of pending posts from php? -->
          <span><strong>2</strong></span> 
          pending requests
          <!-- or there are no any pending requests -->
        </h4>
        
        <!-- BEGINNING OF SIGNUP REQUEST OULTINE -->
        <div class="signupRequests row">
          <div class="col-6">
            <div class="requestDetailsBox float-left">
              <h6><strong>Name of User</strong></h6>
              <p>Email Adress of User</p>
            </div>
          </div>
          
          <div class="col-6">
            <button type="button" class="float-right declineRequestBtn" id="declineRequestBtn1" data-toggle="modal" data-target="#confirmDeclineModal"><i class="fa fa-times" aria-hidden="true"></i></button>
            <button type="button" class="float-right confirmRequestBtn" id="confirmRequestBtn1"><i class="fa fa-plus" aria-hidden="true"></i></button>
          </div>

          <div class="clear"></div>
        </div>
        <!-- ENDING OF SIGNUP REQUEST OUTLINE -->

        <div class="signupRequests row">
          <div class="col-6">
            <div class="requestDetailsBox float-left">
              <h6><strong>Name of User</strong></h6>
              <p>Email Adress of User</p>
            </div>
          </div>
          
          <div class="col-6">
            <button type="button" class="float-right declineRequestBtn" id="declineRequestBtn2" data-toggle="modal" data-target="#confirmDeclineModal"><i class="fa fa-times" aria-hidden="true"></i></button>
            <button type="button" class="float-right confirmRequestBtn" id="confirmRequestBtn2"><i class="fa fa-plus" aria-hidden="true"></i></button>
          </div>

          <div class="clear"></div>
        </div>

        <!-- CONFIRM DECLINE REQUST MODAL -->
        <div class="modal fade" id="confirmDeclineModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeclineModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmDeclineModalLabel">Decline request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to decline this request?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="Dismiss">Close</button>
                <button type="button" class="btn btn-danger">Decline</button>
              </div>
            </div>
          </div>
        </div>

        <!-- REVOKE USER ACCESS BUTTON -->
        <div class="text-center">
          <button type="button" id="revokeAccessBtn" data-toggle="modal" data-target="#searchUserModal">Revoke User Access</button>
        </div>

        <!-- REVOKE USER ACCESS MODAL -->
        <div class="modal fade" id="searchUserModal" tabindex="-1" role="dialog" aria-labelledby="searchUserModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <form class="form-inline my-2 my-lg-0 float-left">
                  <input class="form-control mr-sm-2 float-left" type="search" placeholder="Search User" aria-label="Search">
                  <button class="my-2 my-sm-0 float-left" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>  
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Revoke Access</button>
              </div>
            </div>
          </div>
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
    <script src="../js/index.js"></script>

  </body>
</html>
