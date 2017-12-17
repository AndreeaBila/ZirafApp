$(function() {
  
  $('#newsfeedNav').click(function() {
    window.location = 'newsfeed.php';
  });

  $('#profileNav').click(function() {
    window.location = 'profile.php';
  });

  $('#reviewNav').click(function() {
    window.location = 'review.php';
  });

  $('#chatNav').click(function() {
    window.location = 'chat.php';
  });


  if(window.location.href == 'http://localhost/WebDev/ZirafApp/php/chat.php') {
    console.log("yes");
    $('#newsfeedNav').removeClass('activeNav');
    $('#profileNav').removeClass('activeNav');
    $('#reviewNav').removeClass('activeNav');
    $('#chatNav').addClass('activeNav');
  } 

  switch(window.location.href) {
    case 'http://localhost/WebDev/ZirafApp/php/newsfeed.php':
      $('#chatNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#newsfeedNav').addClass('activeNav');
      break;

    case 'http://localhost/WebDev/ZirafApp/php/chat.php':
      $('#newsfeedNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#chatNav').addClass('activeNav');
      break;

    case 'http://localhost/WebDev/ZirafApp/php/review.php':
      $('#newsfeedNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#chatNav').removeClass('activeNav');
      $('#reviewNav').addClass('activeNav');
      break;

    case 'http://localhost/WebDev/ZirafApp/php/profile.php':
      $('#newsfeedNav').removeClass('activeNav');
      $('#chatNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#profileNav').addClass('activeNav');
      break;
  }

});