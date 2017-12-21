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
      
      <div id="chat">
        <div id="chatMenuNav">
          <button type="button" id="chatMenuBtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
        </div>

        <div id="chatMenu"></div>

        <div class="chatBox">
          <!-- MESSAGE TEMPLATE -->
          <div class="messageBox myMessage float-right">
            <div class="messageHeader">
              <img src="../img/default.jpeg" alt="Pic" class="messageImage float-left">
              <p class="messageName float-left">Firstname Lastname</p>
              <p class="messageTime float-right">23:49</p>
            </div>
            <div class="clear"></div>
            <div class="messageBody">
              <p class="messageContent">Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
              </p>
            </div>
          </div>
          <div class="clear"></div>
          <!-- END OF MESSAGE TEMPLATE -->

          <div class="messageBox otherMessage float-left">
            <div class="messageHeader">
              <img src="../img/default.jpeg" alt="Pic" class="messageImage float-left">
              <p class="messageName float-left">Firstname Lastname</p>
              <p class="messageTime float-right">00:07</p>
            </div>
            <div class="clear"></div>
            <div class="messageBody">
              <p class="messageContent">Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
              </p>
            </div>
          </div>
          <div class="clear"></div>

          <div class="messageBox myMessage float-right">
            <div class="messageHeader">
              <img src="../img/default.jpeg" alt="Pic" class="messageImage float-left">
              <p class="messageName float-left">Firstname Lastname</p>
              <p class="messageTime float-right">05:45</p>
            </div>
            <div class="clear"></div>
            <div class="messageBody">
              <p class="messageContent">Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
              </p>
            </div>
          </div>
          <div class="clear"></div>

        </div>
        
        <!-- WRITING MESSAGE BOX -->
        <div id="chatMessageInputBox">
          <form action="" id="chatMessageInputForm">
            <input type="textarea" id="chatMessageInput" name="chatMessageInput" placeholder="...">
            <input type="submit" value="Send" class="btn btn-primary float-right" id="sendChatMessage" name="sendChatMessage">
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
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/74007ae870.js"></script>

    <!-- The js script for this file -->
    <script src="../js/chat.js"></script>

  </body>
</html>
