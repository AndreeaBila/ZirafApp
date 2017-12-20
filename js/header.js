$(function() {
  
  $('#execPanelNav').click(function() {
    window.location = 'execPanel';
  });

  $('#settingsNav').click(function() {
    window.location = 'settings';
  });

  $('#logoutNav').click(function(){
    //delete the cookie and redirect to index
    document.cookie = "keepLogged=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    //redirect user to index page
    location.href = "index";
  });
  
});
