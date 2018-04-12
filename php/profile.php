<?php
  session_start();
  //import the security file
  require_once "./phpComponents/security.php";
  //check authentication
  authenticate();
  //create database connection
  require_once "./phpComponents/databaseConnection.php";
  $db = createConnection();
  //get the user id
  $userId = $_SESSION['userId'];
  //get the user's iconExtension and tagline from the database
  $query = "SELECT iconExtension, description FROM USERS WHERE userId = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("s", $userId);
  $stmt->execute();
  $stmt->bind_result($iconExtension, $tagLine);
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
    
    <title>Zirafers - Profile</title>

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
      
      <div id="profile">
      <form action="./phpDirectives/updateProfile.php" method="POST" enctype="multipart/form-data">
        <div id="profileHeader" class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-3">
                <!-- include picture dyncamically -->
                <?php echo '<img src="../img/userIcons/'.$userId.'.'.$iconExtension.'" alt="no" class="float-left">'; ?>
              </div>
              
              <div class="col-9">
                <label for="profileDescription" id="profileDescriptionTitle">Your Tagline</label>
                <textarea name="profileDescription" id="profileDescription" class="form-control float-left"><?php echo "$tagLine"; ?></textarea>
              </div>
            </div>
          
            <div class="clear"></div>
          
            <div class="form-group float-left">
              <input type="file" value="upload" class="form-control-lg form-control" id="changeProfilePicture" name="changeProfilePicture">
            </div>
          
            <button type="submit" class="btn bgZiraf float-right">Save Changes</button>
          
            <div class="clear"></div>
          </div>
        </div>
      </form>

        <div id="profileMenu" class="row">
          <button class="col-4 text-center" id="profileRankBtn">
            <p><i class="fa fa-trophy" aria-hidden="true"></i></p>
            <p>Rank</p>
          </button>

          <button class="col-4 text-center" id="profileBadgesBtn">
            <p><i class="fa fa-shield" aria-hidden="true"></i></p>
            <p>Badges</p>
          </button>

          <button class="col-4 text-center" id="profileReviewsBtn">
            <p><i class="fa fa-file-text" aria-hidden="true"></i></p>
            <p>Reviews</p>
          </button>
        </div>

        <div id="rankTab" class="text-center">
          Coming soon!
        </div>

        <div id="badgesTab" class="text-center">
          Coming soon!
        </div>

        <div id="reviewsTab" class="text-center">
          Coming soon!
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
    <script src="../js/profile.js"></script>

  </body>
</html>
