$('#signupContainer').hide();

$(function() {
  
  $('#loginToSignup').click(function() {
    $('#signupContainer').show(1000);
    $('#loginContainer').hide(1000);
  });

  $('#signupToLogin').click(function() {
    $('#signupContainer').hide(1000);
    $('#loginContainer').show(1000);
  });

});