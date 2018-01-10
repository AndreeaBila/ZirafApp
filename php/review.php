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
    
    <title>Zirafers - Review</title>

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
           
      <div id="review">
        <div class="text-center row" id="goToReview">
          <button id="newReviewBtn" class="bgZiraf btn btn-lg">New Review</button>
        </div>

        <div id="reviewForm">
          <div id="nameQuestion" class="form-group">
            <label for="restaurantName" class="col-form-label-lg">What restaurant do you want to review?</label>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-addon" id="restaurantNameAddon"><i class="fa fa-cutlery" aria-hidden="true"></i></span>
              <input type="text" id="restaurantName" name="restaurantName" class="form-control form-control-lg" aria-label="Large" placeholder="Name of Place" required>
            </div>

            <div id="nameQuestionAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i>  Please insert a response
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backRestaurantName"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmRestaurantName"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>
          
          <div id="topDishesQuestion" class="form-group">
            <label for="topDishes" class="col-form-label-lg">What are the top dishes here?</label>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-addon" id="topDishesAddon"><i class="fa fa-trophy" aria-hidden="true"></i></span>
              <input type="text" id="topDishes" name="topDishes" class="form-control form-control-lg" aria-label="Large" placeholder="Name of Dish" required>
              <button type="button" class="btn bgGreen" id="addTopDish"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>

            <div id="topDishesAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i>  Please insert a response
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- Display added top dishes -->
            <div class="addedTopDishesContainer row">
              <p class="addedTopDishes col-8">Abc</p>
              <button type="button" class="removeAddedTopDishes col-4">remove &times;</button>
            </div>

            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backTopDishes"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmTopDishes"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>

          <div id="foodRatingQuestion" class="form-group">
            <label for="foodRating" class="col-form-label-lg">How would you rate the food?</label>
            <div class="input-group input-group-lg mb-3 sliderContainer">
              <input type="range" min="0" max="10" value="5" class="slider" id="foodRating">
            </div>
            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backFoodRating"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmFoodRating"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>

          <div id="ambienceRatingQuestion" class="form-group">
            <label for="ambienceRating" class="col-form-label-lg">How would you rate the ambience?</label>
            <div class="input-group input-group-lg mb-3 sliderContainer">
              <input type="range" min="0" max="10" value="5" class="slider" id="ambienceRating">
            </div>
            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backAmbienceRating"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmAmbienceRating"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>

          <div id="serviceRatingQuestion" class="form-group">
            <label for="serviceRating" class="col-form-label-lg">How would you rate the service?</label>
            <div class="input-group input-group-lg mb-3 sliderContainer">
              <input type="range" min="0" max="10" value="5" class="slider" id="serviceRating">
            </div>
            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backServiceRating"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmServiceRating"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>

          <div id="moneyValueQuestion" class="form-group">
            <label for="moneyValue" class="col-form-label-lg">Value for money</label>
            <div class="input-group input-group-lg mb-3 sliderContainer">
              <input type="range" min="0" max="10" value="5" class="slider" id="moneyValue">
            </div>
            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backMoneyValue"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmMoneyValue"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>

          <div id="reviewQuestion" class="form-group">
            <label for="review" class="col-form-label-lg">Share your food review in detail</label>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-addon" id="reviewAddon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
              <textarea type="text" id="review" name="review" class="form-control form-control-lg" aria-label="Large" placeholder="Review" required></textarea>
            </div>

            <div id="reviewAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i>  Please insert a response
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backReview"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmReview"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>

          <div id="xFactorQuestion" class="form-group">
            <label for="xFactor" class="col-form-label-lg">What is the X-Factor for this place?</label>
            <div class="input-group input-group-lg mb-3">
              <span class="input-group-addon" id="xFactorAddon"><i class="fa fa-star" aria-hidden="true"></i></span>
              <input type="text" id="xFactor" name="xFactor" class="form-control form-control-lg" aria-label="Large" placeholder="X-Factor" required>
            </div>

            <div id="xFactorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i>  Please insert a response
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backXFactor"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmXFactor"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>

          <div id="reviewPicturesQuestion" class="form-group">
            <label for="reviewPictures" class="col-form-label-lg">Pictures of the dishes or the restuarant itself.</label>
            <input type="file" value="upload" class="form-control-lg form-control" id="reviewPicturesBtn" name="reviewPicturesBtn">

            <!-- Display small previews of the pics? -->
            <div class="addedReviewPicturesContainer">
              <button type="button" class="removeAddedReviewPicture float-right">remove &times;</button>
              <img class="addedReviewPicture" src="https://placeimg.com/500/480/animals" alt="">
            </div>
            <div class="addedReviewPicturesContainer">
              <button type="button" class="removeAddedReviewPicture float-right">remove &times;</button>
              <img class="addedReviewPicture" src="https://placeimg.com/400/480/animals" alt="">
            </div>
            <div class="addedReviewPicturesContainer">
              <button type="button" class="removeAddedReviewPicture float-right">remove &times;</button>
              <img class="addedReviewPicture" src="https://placeimg.com/450/480/animals" alt="">
            </div>
            <div class="addedReviewPicturesContainer">
              <button type="button" class="removeAddedReviewPicture float-right">remove &times;</button>
              <img class="addedReviewPicture" src="https://placeimg.com/480/400/animals" alt="">
            </div>
            <div class="text-center questionButtons">
              <button type="button" class="btn bgRed confirmBtn" id="backReviewPictures"><i class="fa fa-times" aria-hidden="true"></i></button>
              <button type="button" class="btn bgGreen confirmBtn" id="confirmReviewPictures"><i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
          </div>

          <div class="text-center" id="endReviewMessage">
            <h3>Done! <i class="fa fa-smile-o" aria-hidden="true"></i></h3>
            <h3>Thank you for submitting a new review!</h3>
            <h3>You're one step closer to your next badge.</h3>
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

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

    <!-- The js script for this file -->
    <script src="../js/review.js"></script>

  </body>
</html>
