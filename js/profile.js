$(function() {

  $('#badgesTab').hide();
  $('#reviewsTab').hide();

  $('#profileRankBtn').click(function() {
    $('#badgesTab').hide();
    $('#reviewsTab').hide();
    $('#rankTab').show();
  });

  $('#profileBadgesBtn').click(function() {
    $('#rankTab').hide();
    $('#reviewsTab').hide();
    $('#badgesTab').show();
  });

  $('#profileReviewsBtn').click(function() {
    $('#badgesTab').hide();
    $('#rankTab').hide();
    $('#reviewsTab').show();
  });

  //style upload file
  $('input[type=file]').each(function()
  {
      $(this).attr('onchange',"sub(this)");
      $('<div id="changeProfilePictureBtn" class="text-center" onclick="getFile()">Change Profile Picture</div>').insertBefore(this);
      $(this).wrapAll('<div style="height: 0px;width: 0px; overflow:hidden;"></div>');
  });

});

//upload file button
function getFile(){
  $('input[type=file]').click();
}
function sub(obj){
  var file = obj.value;
  var fileName = file.split("\\");
  document.getElementById("changeProfilePictureBtn").innerHTML = fileName[fileName.length-1];
}