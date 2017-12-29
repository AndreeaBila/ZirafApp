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
          <button class="col-4 text-center" id="openAnnouncementBoxBtn">
            <p><i class="fa fa-bullhorn" aria-hidden="true"></i></p>
            <p>Write</p>
            <p>Announcement</p>
          </button>

          <button class="col-4 text-center" id="openPictureBoxBtn">
            <p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
            <p>Upload</p>
            <p>Picture</p>
          </button>

          <button class="col-4 text-center" id="openPollBoxBtn">
            <p><i class="fa fa-bar-chart" aria-hidden="true"></i></p>
            <p>Create</p>
            <p>Poll</p>
          </button>
        </div>

          <!-- WRITE ANNOUNCEMENT BOX -->
          <div class="newsfeedAddPost row" id="writeAnnouncement">
            <textarea name="announcementTextarea" id="announcementTextarea" placeholder="Write Announcement..." class="form-control form-control-lg"></textarea>
            <div class="col-12">
              <button type="button" class="btn btn-lg float-right" id="postAnnouncementBtn">Post</button>
            </div>
            <div class="clear"></div>
          </div>
 
          <!-- UPLOAD PICTURE BOX -->
          <div class="newsfeedAddPost row" id="uploadPicture">
            <div class="custom-file form-control-lg">
              <input type="file" class="custom-file-input" id="customFile">
              <span class="custom-file-control"></span>
              
              </label>
            </div>
            <textarea name="pictureTextarea" id="pictureTextarea" cols="30" rows="2" placeholder="Description" class="form-control form-control-lg"></textarea>
            <div class="col-12">
              <button type="button" class="float-right btn btn-lg" id="postPictureBtn">Post</button>
            </div>
            <div class="clear"></div>
          </div>

          <!-- CREATE POLL BOX -->
          <div class="newsfeedAddPost row" id="createPoll">
            <input type="text" class="form-control form-control-lg" id="pollQuestion" placeholder="Poll Question">
            <input type="text" class="form-control form-control-lg" id="pollOptionInput" placeholder="Poll Option">
            <textarea name="pictureTextarea" id="pollTextarea" cols="30" rows="2" placeholder="Description" class="form-control form-control-lg"></textarea>
            <div class="col-12">
              <button type="button" class="float-right btn btn-lg" id="postPollBtn">Post</button>
            </div>
            <div class="clear"></div>
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
        
        <!-- TEMPLATE FOR NEWSFEED POLL POSTS -->
        <div class="post">
          <div class="postHeader">
            <img src="../img/default.jpeg" alt="no" class="float-left" width="40px" height="40px">
            <p class="float-left">Name Name</p>
            <small class="float-right">date time</small>
          </div>
          <div class="clear"></div>

          <div class="postBody">
            <div class="poll">
              <h6>Poll Question????</h6>

              <!-- FORM FOR THE POLL
                   SHOULD I ADD A SUBMIT BUTTON?-->
              <form action="">

              <!-- POLL OPTION TEMPLATE -->
                <div class="pollOption">
                  <label class="custom-control custom-radio float-left">
                    <input id="radio1" name="radio" type="radio" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                  </label>
                  <div class="progress float-left">
                    <div class="progress-bar float-left" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                      <p>Option 1</p>
                    </div>
                  </div>
                  <p class="float-right">3 votes</p>
                </div>
                <div class="clear"></div>
                <!-- END OF POLL OPTION TEMPLATE -->

                <!-- MORE POLL OPTIONS -->
                <div class="pollOption">
                  <label class="custom-control custom-radio float-left">
                    <input id="radio1" name="radio" type="radio" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                  </label>
                  <div class="progress float-left">
                    <div class="progress-bar float-left" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <p>Option 2</p>
                    </div>
                  </div>
                  <p class="float-right">2 votes</p>
                </div>
                <div class="clear"></div>

                <div class="pollOption">
                  <label class="custom-control custom-radio float-left">
                    <input id="radio1" name="radio" type="radio" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                  </label>
                  <div class="progress float-left">
                    <div class="progress-bar float-left" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                      <p>Option 3</p>
                    </div>
                  </div>
                  <p class="float-right">5 votes</p>
                </div>
                <div class="clear"></div>

              </form>      
              <!-- END OF POLL FORM -->
            </div>
            
            <!-- SOME DESCRIPTION TEXT -->
            <p>Ham ham hock cow, shank beef ribs pancetta sausage. Beef cow kevin short loin ball tip spare ribs ribeye tail pig meatloaf chicken biltong prosciutto picanha. Tri-tip shankle ham chicken alcatra buffalo frankfurter salami porchetta short ribs tail shank pork chop spare ribs ground round.</p>
          </div>
          
          <footer class="postFooter">
            <button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>
            <p class="likesCount float-right">54 Likes</p>
          </footer>
          <div class="clear"></div>
        </div>
        <!-- TEMPLATE FOR POLL POSTS END -->

        <!-- TEMPLATE FOR NEWSFEED IMAGE POSTS -->
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
        <!-- TEMPLATE FOR IMAGE POSTS END -->

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
    <script src="../js/newsfeed.js"></script>

  </body>
</html>
