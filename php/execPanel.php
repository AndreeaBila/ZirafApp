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
    
    <title>Zirafers - Exec Panel</title>

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

    <div id="wrapper" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

      <?php
        include './phpComponents/header.php';
      ?>
      
      <div id="execPanel">
        <?php
          //script that cheks and displays any pending signup request

          //load database files
          require_once "phpComponents/databaseConnection.php";
          $db = createConnection();

          //query the database for any pending requests
          $getPendingRequests = "SELECT userName, email FROM USERS WHERE execActivation = 0";
          $pendingRequests = $db->query($getPendingRequests);
          $count = 0;
          $displayMessage = ($pendingRequests->num_rows > 1) ? 'pending requests' : 'pending request';
          //dislpay the number of pending requests
          echo '<h4  id="numRequests">
                  <!-- get number of pending posts from php? -->
                  <span><strong>'.$pendingRequests->num_rows.'</strong></span> 
                  '.$displayMessage.'
                  <!-- or there are no any pending requests -->
                </h4>';
          while($row = $pendingRequests->fetch_assoc()){
            echo '<div class="signupRequests row" id="row'.$count++.'">
            <div class="col-6">
              <div class="requestDetailsBox float-left">
                <h6><strong>'.$row['userName'].'</strong></h6>
                <p>'.$row['email'].'</p>
              </div>
            </div>
            
            <div class="col-6">
              <button type="button" class="float-right bgRed declineRequestBtn" data-toggle="modal" data-target="#confirmDeclineModal"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="float-right bgGreen confirmRequestBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
  
            <div class="clear"></div>
          </div>';
          }
        ?>

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
                <button type="button" class="btn bgNeutral" id="closeModalBtn" data-dismiss="Dismiss">Close</button>
                <button type="button" class="btn bgRed" id="confirmDeleteBtn">Decline</button>
              </div>
            </div>
          </div>
        </div>

        <div id="execErrorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> An error has occured
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- REVOKE USER ACCESS BUTTON -->
        <div class="text-center">
          <button type="button" id="revokeAccessBtn" class="bgZiraf" data-toggle="modal" data-target="#searchUserModal">Revoke User Access</button>
        </div>

        <!-- REVOKE USER ACCESS MODAL -->
        <div class="modal fade" id="searchUserModal" tabindex="-1" role="dialog" aria-labelledby="searchUserModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="searchUserModalLabel">Revoke User Access</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Search User Email</label>
                  <div class="searchBar input-group mb-3">
                    <input type="text" onkeyup="getSuggestions()" id="selectUserEmailsToRevoke" class="form-control form-control-lg">
                    <button type="button" class="btn plusBtn bgGreen" id="selectEmailForRevoke"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  </div>
                  <div id="dropDownList" class="dropDownList"></div>

                  <!-- AFTER YOU SELECT A MEMBER IT SHOULD APPEAR UNDER THE INPUT LIKE THIS -->
                  <div id="addedMembersToRevoke"></div>
                  <!-- ADDED MEMEBER TEMPLATE END -->
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn bgNeutral" id="closeUserRevokeModalBtn" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn bgRed" id="confirmUserRevokeModalBtn">Revoke Access</button>
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
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/74007ae870.js"></script>

    <!-- The js script for this file -->
    <script src="../js/execPanel.js"></script>
  </body>
</html>
