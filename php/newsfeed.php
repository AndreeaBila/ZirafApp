<?php
  session_start();
  //import the security file
  require_once "./phpComponents/security.php";
  //check authentication
  authenticate();
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

      <!-- Newsfeed content -->
      <div id="newsfeed">
        <!-- ONLY VISIBLE FOR EXEC -->
        <div id="newsfeedMenu" class="row">
          <button class="col-4 text-center">
            <p><i class="fa fa-bullhorn" aria-hidden="true"></i></p>
            <p>Write</p>
            <p>Announcement</p>
          </button>

          <button class="col-4 text-center">
            <p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
            <p>Upload</p>
            <p>Picture</p>
          </button>

          <button class="col-4 text-center">
            <p><i class="fa fa-bar-chart" aria-hidden="true"></i></p>
            <p>Create</p>
            <p>Poll</p>
          </button>
        </div>

        <!-- TEMPLATE FOR NEWSFEED ANOUNCEMENT POSTS -->
        <div class="post">
          <div class="postHeader">
            <img src="../img/default.jpeg" alt="no" class="float-left" width="40px" height="40px">
            <p class="float-left">Name Name</p>
            <small class="float-right">date time</small>
          </div>
          <div class="clear"></div>

          <div class="postBody">
            <p>Bacon ipsum dolor amet pork short loin shankle flank, pig pastrami frankfurter tenderloin. Drumstick leberkas beef ribs, tenderloin fatback frankfurter buffalo pork loin shankle sausage picanha hamburger pastrami tri-tip. Bresaola jowl filet mignon alcatra, pancetta pork loin boudin swine ham. Jerky ham cupim swine, andouille boudin kevin. Drumstick pancetta hamburger capicola short loin ribeye ground round, swine tail fatback.</p>
          </div>
          
          <footer class="postFooter">
            <button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>
            <p class="likesCount float-right">123 Likes</p>
          </footer>
          <div class="clear"></div>
        </div>
        <!-- TEMPLATE FOR ANOUNCEMENT POSTS END -->

        <!-- TEMPLATE FOR NEWSFEED IMAGE POSTS -->
        <div class="post">
          <div class="postHeader">
            <img src="../img/default.jpeg" alt="no" class="float-left" width="40px" height="40px">
            <p class="float-left">Name Name</p>
            <small class="float-right">date time</small>
          </div>
          <div class="clear"></div>

          <div class="postBody">
            <img src="http://placekitten.com/450/300" alt="no">
            <p>Salami short ribs ham pig, prosciutto tri-tip strip steak sirloin.</p>
          </div>
          
          <footer class="postFooter">
            <button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>
            <p class="likesCount float-right">54 Likes</p>
          </footer>
          <div class="clear"></div>
        </div>
        <!-- TEMPLATE FOR ANOUNCEMENT POSTS END -->
        
        <!-- TEMPLATE FOR NEWSFEED ANOUNCEMENT POSTS -->
        <div class="post">
          <div class="postHeader">
            <img src="../img/default.jpeg" alt="no" class="float-left" width="40px" height="40px">
            <p class="float-left">Name Name</p>
            <small class="float-right">date time</small>
          </div>
          <div class="clear"></div>

          <div class="postBody">
          <form action="">
            <!-- <div class="custom-control custom-radio">
              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio1">
              <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              </label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio2">Or toggle this other custom radio</label>
            </div> -->
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="customCheck1">
              <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
            </div>
          </form>
            
            
            <p>Ham ham hock cow, shank beef ribs pancetta sausage. Beef cow kevin short loin ball tip spare ribs ribeye tail pig meatloaf chicken biltong prosciutto picanha. Tri-tip shankle ham chicken alcatra buffalo frankfurter salami porchetta short ribs tail shank pork chop spare ribs ground round. Doner turducken sausage, turkey sirloin corned beef chicken burgdoggen capicola jowl. Strip steak rump pancetta capicola beef ribs drumstick alcatra tri-tip sirloin corned beef burgdoggen. Pastrami ham bresaola, tri-tip burgdoggen ball tip beef ribs shoulder.</p>
          </div>
          
          <footer class="postFooter">
            <button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>
            <p class="likesCount float-right">54 Likes</p>
          </footer>
          <div class="clear"></div>
        </div>
        <!-- TEMPLATE FOR ANOUNCEMENT POSTS END -->

        <!-- TEMPLATE FOR NEWSFEED ANOUNCEMENT POSTS -->
        <div class="post">
          <div class="postHeader">
            <img src="../img/default.jpeg" alt="no" class="float-left" width="40px" height="40px">
            <p class="float-left">Name Name</p>
            <small class="float-right">date time</small>
          </div>
          <div class="clear"></div>

          <div class="postBody">
            <img src="http://placekitten.com/450/520" alt="no">
            <p>Filet mignon porchetta alcatra beef leberkas chicken burgdoggen picanha ham shoulder. Turducken pancetta strip steak hamburger buffalo. Prosciutto doner spare ribs turkey, pastrami alcatra drumstick flank tongue sausage landjaeger ribeye buffalo short loin shankle. Picanha t-bone salami turkey. Kevin pig pastrami, ribeye pork belly sirloin shank hamburger. Bacon pork belly turkey pork chop, t-bone boudin turducken alcatra tri-tip prosciutto capicola short ribs pig.</p>
          </div>
          
          <footer class="postFooter">
            <button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>
            <p class="likesCount float-right">97 Likes</p>
          </footer>
          <div class="clear"></div>
        </div>
        <!-- TEMPLATE FOR ANOUNCEMENT POSTS END -->

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
    <script src="../js/newsfeed.js"></script>

  </body>
</html>
