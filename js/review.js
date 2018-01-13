$(function() {
  //hide alerts
  $('.alert').hide();

  //hide review form by default
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();

    
  //show the first question when review starts
  $('#newReviewBtn').click(function() {
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#goToReview').effect('slide',{direction:'up', mode:'hide'},1000);
    $('#nameQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from restaurant name question to new review page
  $('#backRestaurantName').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#goToReview').effect('slide',{direction:'up', mode:'show'},1000);
  });

  //hide name question and show top dishes question
  $('#confirmRestaurantName').click(function() {
    $('#nameQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#nameQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#topDishesQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from top dishes question to name question
  $('#backTopDishes').click(function() {
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#nameQuestion').effect('drop',{direction:'up', mode:'show'},1000);
  });

  //hide top dishes question and show food rating question
  $('#confirmTopDishes').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#topDishesQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#foodRatingQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from food rating to top dishes
  $('#backFoodRating').click(function() {
    $('#nameQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#topDishesQuestion').effect('drop',{direction:'up', mode:'show'},1000);
  });

  //hide food rating question and show ambience rating question
  $('#confirmFoodRating').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#foodRatingQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#ambienceRatingQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from ambience rating to food rating
  $('#backAmbienceRating').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#foodRatingQuestion').effect('drop',{direction:'up', mode:'show'},1000);
  });

  //hide ambience rating question and show service rating question
  $('#confirmAmbienceRating').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#ambienceRatingQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#serviceRatingQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from service rating to ambience rating
  $('#backServiceRating').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#ambienceRatingQuestion').effect('drop',{direction:'up', mode:'show'},1000);
  });
  

  //hide service rating question and show value for money question
  $('#confirmServiceRating').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#serviceRatingQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#moneyValueQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from money value to service rating
  $('#backMoneyValue').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#serviceRatingQuestion').effect('drop',{direction:'up', mode:'show'},1000);
  });

  //hide value for money question and show review question
  $('#confirmMoneyValue').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#moneyValueQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#reviewQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from review rating to money value
  $('#backReview').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#moneyValueQuestion').effect('drop',{direction:'up', mode:'show'},1000);
  });

  //hide review question and show xfactor question
  $('#confirmReview').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#reviewQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#xFactorQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from xfactor to review
  $('#backXFactor').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#reviewQuestion').effect('drop',{direction:'up', mode:'show'},1000);
  });

  //hide xfactor question and show review pictures question
  $('#confirmXFactor').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#endReviewMessage').hide();
    $('#xFactorQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#reviewPicturesQuestion').effect('drop',{direction:'down', mode:'show'},1000);
  });

  //go back from review pictures to xfactor
  $('#backReviewPictures').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#endReviewMessage').hide();
    $('#xFactorQuestion').effect('drop',{direction:'up', mode:'show'},1000);
  });

  //hide review pictures question and show review pictures question
  $('#confirmReviewPictures').click(function() {
    $('#nameQuestion').hide();
    $('#topDishesQuestion').hide();
    $('#foodRatingQuestion').hide();
    $('#ambienceRatingQuestion').hide();
    $('#serviceRatingQuestion').hide();
    $('#moneyValueQuestion').hide();
    $('#reviewQuestion').hide();
    $('#xFactorQuestion').hide();
    $('#reviewPicturesQuestion').hide();
    $('#reviewPicturesQuestion').effect('drop',{direction:'up', mode:'hide'},1000);
    $('#endReviewMessage').effect('drop',{direction:'down', mode:'show'},1000);
  });

  $('#topDishes').keydown(function(e){
    if(e.keyCode == 13){
      addTopDishes();
    }
  });

  $('#addTopDish').click(function(){
    addTopDishes();
  });

});

function addTopDishes(){
  //get the value of the selected email
    //add the selected email to the list of selected emails
    $('#topDishesToAdd').append('<div class="addedTopDishesContainer row">' +
                                   '<p class="addedTopDishes col-8">' + $('#topDishes').val() + '</p>' +
                                   '<button type="button" class="removeAddedTopDishes col-4">remove &times;</button>' +
                                   '</div>');
    //delete the input data
    $('#topDishes').val("");

    $('.removeAddedTopDishes').unbind('click');
    $('.removeAddedTopDishes').bind('click', function(){
      var deletedEmail = $(this).siblings().first().text();
      //remove the row from the modal
      $(this).parent().remove();

    });
}

// function addReviewPics(){
//   //get the value of the selected email
//     //add the selected email to the list of selected emails
//     $('#addReviewPictures').append('<div class="addedReviewPicturesContainer row">' +
//                                    '<button type="button" class="removeAddedReviewPicture">remove &times;</button>' +
//                                    '<p class="addedReviewPicture">' + $('#reviewPicturesBtn').val() + '</p>' +
                                   
//                                    '</div>');
//     //delete the input data
//     $('#reviewPicturesBtn').val("");

//     $('.removeAddedReviewPicture').unbind('click');
//     $('.removeAddedReviewPicture').bind('click', function(){
//       var deletedEmail = $(this).siblings().first().text();
//       //remove the row from the modal
//       $(this).parent().remove();

//     });
// }