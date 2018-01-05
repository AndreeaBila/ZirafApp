$(function(){
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
    //========== END DESIGN ==========

    //create a poll option array which is empty at the start
    var pollOptionArray = [];
    //check if the user pressed the post button from the announcement form
    $('#postAnnouncementBtn').click(function(){
        postAnnouncement();
    });

    //check if the user pressend enter while having selected the poll option bar
    $('#pollOptionInput').keydown(function(e){
        if(e.keyCode === 13){
            //add option to the array
            var currentOption = $('#pollOptionInput').val();
            //clear the input
            $('#pollOptionInput').val('');
            //add the option to the option array
            pollOptionArray.push(currentOption);
        }
    });

    //check if the user pressed the post button from the poll form
    $('#postPollBtn').click(function(){
        //get the value of the array and send it to the poll management function
        postPoll(pollOptionArray);
        //delete the array data
        pollOptionArray.splice(0);
    });


    //show added poll options in add post menu
    $('#pollOptionInput').keydown(function(e){
        if(e.keyCode == 13){
          //get the value of the selected email
          var pollOption = $('#pollOptionInput').val();
          console.log($('#pollOptionInput').val());
          console.log($('#pollQuestion').val());
          $('#addedPollOptions').append('<div class="addedPollOptionsContainer row">' +
                                            '<p class="addedPollOptions col-8">' + pollOption + '</p>' +
                                            '<button type="button" class="removeAddedPollOption col-4">remove &times;</button>' +
                                            '</div>');
            //delete the input data
            //$('#pollOptionInput').val("");
        
        }
    });
});

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

//convert a json format into html for a post
function parsePost(post){
    return '<div class="post" id="post'+ post.postId +'">' +
                '<div class="postHeader">' +
                    '<img src="../img/userIcons/' + post.userId + '.'+ post.iconExtension +'" alt="no" class="float-left" width="40px" height="40px">' +
                    '<p class="float-left">' + post.userName + '</p>' +
                    '<small class="float-right">' + post.dateCreated + '</small>' +
                '</div>' +
                '<div class="clear"></div>' +

                '<div class="postBody">' +
                    '<p>' + post.content.replace(/\n/g, '<br>\n') + '</p>' +
                '</div>' +
                
                '<footer class="postFooter">' +
                    '<button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>' +
                    '<p class="likesCount float-right">' + post.likes + '</p>' +
                '</footer>' +
                '<div class="clear"></div>' +
            '</div>'
}

//send the poll to the database
function postPoll(pollOptionArray){
    //create the poll data object to hold all the information about a poll
    var pollData = {
        pollQuestion : $('#pollQuestion').val(),
        pollDescription : $('#pollTextarea').val(),
        pollOptionString : ''
    };
    //break the array intro a string of poll options delimited by the '^$/' character
    for(i=0;i<pollOptionArray.length;i++){
        currentOption = pollOptionArray[i];
        pollData.pollOptionString += currentOption;
        if(i < pollOptionArray.length -1){
            pollData.pollOptionString += '^$/';
        }
    }
    //send the poll to the server
    $.ajax({
        data: pollData,
        url: "../php/phpDirectives/insertPoll.php",
        type: "POST",
        success: function(response){
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
}

function parsePoll(pollInfo){
    //get the html for the options array
    var htmlOptionsArray = parsePollOption(pollInfo.pollOptionArray, pollInfo.totalVotes);
    return '<div class="post" id="poll'+ pollInfo.pollId +'">' +
                '<div class="postHeader">' +
                    '<img src="../img/userIcons/'+ pollInfo.userId +'.'+ pollInfo.iconExtension +'" alt="no" class="float-left" width="40px" height="40px">' +
                    '<p class="float-left">'+ pollInfo.userName +'</p>' +
                    '<small class="float-right">'+ pollInfo.dateCreated +'</small>' +
                '</div>' +
                '<div class="clear"></div>' +

                '<div class="postBody">' +
                    '<div class="poll">' +
                        '<h6>'+ pollInfo.pollStatement +'</h6>' +
                        htmlOptionsArray +
                    '</div>' +
                    '<div class="clear"></div>' +
                '</div>' +
                '<p>'+ pollInfo.pollDescription +'</p>' +
                '<footer class="postFooter">' +
                    '<button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>' +
                    '<p class="likesCount float-right">'+ pollInfo.likes +' Likes</p>' +
                '</footer>' +
                '<div class="clear"></div>' +
            '</div>';
}

function parsePollOption(optionsInfo, totalVotes){
    var optionsHtml = '';
    for(i=0;i<optionsInfo.length;i++){
        var currentOption = optionsInfo[i];
        //calculate the completion percentage for the poll votes
        var votePercentage = (totalVotes > 0) ? parseInt((currentOption.votes * 100) / totalVotes) : 0;
        optionsHtml += '<div class="pollOption" id="pollOption'+ currentOption.optionsId +'">' +
                            '<label class="custom-control custom-radio float-left">' +
                                '<input id="radio"'+ i +' name="radio" type="radio" class="custom-control-input">' +
                                '<span class="custom-control-indicator"></span>' +
                            '</label>' +
                            '<div class="progress float-left">' +
                                '<div class="progress-bar float-left" role="progressbar" style="width: '+ votePercentage +'%" aria-valuenow="'+ votePercentage +'%" aria-valuemin="0" aria-valuemax="100">' +
                                    '<p>'+ currentOption.content +'</p>' +
                                '</div>' +
                            '</div>' +
                            '<p class="float-right">'+ currentOption.votes +'</p>' +
                        '</div>' +
                        '<div class="clear"></div>';
    }
    return optionsHtml;
}