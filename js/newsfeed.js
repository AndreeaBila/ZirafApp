$(function() {
  $('#writeAnnouncement').hide();
  $('#uploadPicture').hide();
  $('#createPoll').hide();

  $('#openAnnouncementBoxBtn').click(function() {
    $('#uploadPicture').hide();
    $('#createPoll').hide();
    $('#writeAnnouncement').toggle('slide',{direction:'up'},500);
  });

  $('#openPictureBoxBtn').click(function() {
    $('#writeAnnouncement').hide();
    $('#createPoll').hide();
    $('#uploadPicture').toggle('slide',{direction:'up'},500);
  });

  $('#openPollBoxBtn').click(function() {
    $('#uploadPicture').hide();
    $('#writeAnnouncement').hide();
    $('#createPoll').toggle('slide',{direction:'up'},500);
  });
});