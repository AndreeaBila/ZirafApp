$(function(){
    //create a poll option array which is empty at the start
    var pollOptionArray = [];

    //manage the design of the exec bar
    //========== DESIGN ==========
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

    //style upload file
    $('input[type=file]').each(function(){
        $(this).attr('onchange',"sub(this)");
        $('<div id="uploadPicBtn" onclick="getFile()">Choose a Picture to Upload</div>').insertBefore(this);
        $(this).wrapAll('<div style="height: 0px;width: 0px; overflow:hidden;"></div>');
    });
    //========== END DESIGN ==========

    //check if the user pressed the post button from the announcement form
    $('#postAnnouncementBtn').click(function(){
        postAnnouncement();
    });

    //check if the user pressend enter while having selected the poll option bar
    $('#pollOptionInput').keydown(function(e){
        if(e.keyCode === 13){
            $('#addPollOptionBtn').click();
        }
    });

    //check if the user tried to enter a new poll option by clicking the plus button
    $('#addPollOptionBtn').click(function(){
        //add option to the array
        var currentOption = $('#pollOptionInput').val();
        //clear the input
        $('#pollOptionInput').val('');
        //add the option to the option array
        pollOptionArray.push(currentOption);
        lastIndex = pollOptionArray.length - 1;
        //display the added user
        $('#addedPollOptions').append('<div class="addedPollOptionsContainer row" id="pollOptionRow'+ lastIndex +'">' +
                                            '<p class="addedPollOptions col-8">' + currentOption + '</p>' +
                                            '<button type="button" class="removeAddedPollOption col-4">remove &times;</button>' +
                                      '</div>');
    });

    //check if the user pressed the post button from the poll form
    $('#postPollBtn').click(function(){
        //get the value of the array and send it to the poll management function
        postPoll(pollOptionArray);
        //delete the array data
        pollOptionArray.splice(0);
    });

    //check if the user tried to remove an added poll option
    $(document).on('click', 'button.removeAddedPollOption', function(){
        //get the id of the row to be removed
        var index = $(this).parent().attr('id');
        //extract the index only
        index = index.replace('pollOptionRow', '');
        //remove the element from the array
        pollOptionArray.splice(index, 1);
        //remove the acutal element frm the page
        $(this).parent().remove();
    });
});

//upload file button
function getFile(){
    $('input[type=file]').click();
  }
  function sub(obj){
     var file = obj.value;
     var fileName = file.split("\\");
     document.getElementById("uploadPicBtn").innerHTML = fileName[fileName.length-1];
  }

//manage the post operation of a post

function postAnnouncement(){
    //get the text from the textarea
    var post = {postContent : $('#announcementTextarea').val()};
    //send the post to the database
    $.ajax({
        data: post,
        url: "../php/phpDirectives/insertPost.php",
        type: "POST",
        success: function(response){
            var returnedPost = JSON.parse(response);
            //parse the post into the corresponding html code
            var htmlPost = parsePost(returnedPost);
            //apend the post to the body
            $('#newsfeedPostBody').prepend(htmlPost);
        },
        error: function(){
            alert("An error has occured while trying to add your post.");
        }
    });
    //clear the text area
    $('#announcementTextarea').val('');
}

//send the poll to the database
function postPoll(pollOptionArray){
    //create the poll data object to hold all the information about a poll
    var pollData = {
        pollQuestion : $('#pollQuestion').val(),
        pollDescription : $('#pollTextarea').val(),
        pollOptionString : []
    };
    //break the array intro a string of poll options delimited by the '^$/' character
    for(i=0;i<pollOptionArray.length;i++){
        currentOption = pollOptionArray[i];
        pollData.pollOptionString.push(currentOption);
    }

    pollData.pollOptionString = JSON.stringify(pollData.pollOptionString);
    //send the poll to the server
    $.ajax({
        data: pollData,
        url: "../php/phpDirectives/insertPoll.php",
        type: "POST",
        success: function(response){
            console.log(response);
            var pollInfo = JSON.parse(response);
            //convert the poll to the appropriate poll html code
            var htmlPoll = parsePoll(pollInfo);
            console.log(htmlPoll);
            //add the new poll to the newsfeed page
            $('#newsfeedPostBody').prepend(htmlPoll);
        },
        error: function(){
            alert("An error has occured while uploading the post");
        }
    });

    //clear the input fields of the form
    $('#pollQuestion').val('');
    $('#pollTextarea').val('');
    $('#addedPollOptions').empty();
}