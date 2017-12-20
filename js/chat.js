$(function() {
  $('#chatMenu').hide();
  $('#chatMenuBtn').click(function() {
    $('#chatMenu').toggle('slide');
    $('#chatMenuBtn').toggleClass('float-right');
  });

});