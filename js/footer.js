$(function() {
  
  $('#newsfeedNav').click(function() {
    window.location = 'newsfeed';
  });

  $('#profileNav').click(function() {
    window.location = 'profile';
  });

  $('#reviewNav').click(function() {
    window.location = 'review';
  });

  $('#chatNav').click(function() {
    window.location = 'chat';
  });

  // $('#chatNav').addClass('activeNav');


  // if(window.location.href == 'http://localhost/WebDev/ZirafApp/php/chat') {
  //   console.log("yes");
  //   $('#newsfeedNav').removeClass('activeNav');
  //   $('#profileNav').removeClass('activeNav');
  //   $('#reviewNav').removeClass('activeNav');
  //   $('#chatNav').addClass('activeNav');
  // } 

  // NEED TO CHANGE LINK WHEN MOVED ON THE SERVER
  switch(window.location.href) {
    case 'http://localhost/WebDev/ZirafApp/php/newsfeed':
      $('#chatNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#newsfeedNav').addClass('activeNav');
      break;

    case 'http://localhost/WebDev/ZirafApp/php/chat':
      $('#newsfeedNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#chatNav').addClass('activeNav');
      break;

    case 'http://localhost/WebDev/ZirafApp/php/review':
      $('#newsfeedNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#chatNav').removeClass('activeNav');
      $('#reviewNav').addClass('activeNav');
      break;

    case 'http://localhost/WebDev/ZirafApp/php/profile':
      $('#newsfeedNav').removeClass('activeNav');
      $('#chatNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#profileNav').addClass('activeNav');
      break;
    
    // for my phone
    case 'http://192.168.0.102/WebDev/ZirafApp/php/newsfeed':
      $('#chatNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#newsfeedNav').addClass('activeNav');
      break;

    case 'http://192.168.0.102/WebDev/ZirafApp/php/chat':
      $('#newsfeedNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#chatNav').addClass('activeNav');
      break;

    case 'http://192.168.0.102/WebDev/ZirafApp/php/review':
      $('#newsfeedNav').removeClass('activeNav');
      $('#profileNav').removeClass('activeNav');
      $('#chatNav').removeClass('activeNav');
      $('#reviewNav').addClass('activeNav');
      break;

    case 'http://192.168.0.102/WebDev/ZirafApp/php/profile':
      $('#newsfeedNav').removeClass('activeNav');
      $('#chatNav').removeClass('activeNav');
      $('#reviewNav').removeClass('activeNav');
      $('#profileNav').addClass('activeNav');
      break;
  }

});