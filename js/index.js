$(function() {
  //hide signup form when opening ppage
  $('#signupContainer').hide();

  //hide login and show signup when "Create New Account" button is clicked
  $('#loginToSignup').click(function() {
    $('#signupContainer').show(1000);
    $('#loginContainer').hide(1000);
  });

  //hide signup and show login when "Already Have An Account" button is clicked
  $('#signupToLogin').click(function() {
    $('#signupContainer').hide(1000);
    $('#loginContainer').show(1000);
  });

});