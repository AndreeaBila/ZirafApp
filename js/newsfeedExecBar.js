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

    //check if the user pressed the post button from the announcement form
    $('#postAnnouncementBtn').click(function(){
        postAnnouncement();
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
            $('#postArea').prepend(htmlPost);
        },
        error: function(){
            alert("An error has occured while trying to add your post.");
        }
    });
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
                    '<p>' + post.content + '</p>' +
                '</div>' +
                
                '<footer class="postFooter">' +
                    '<button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>' +
                    '<p class="likesCount float-right">' + post.likes + '</p>' +
                '</footer>' +
                '<div class="clear"></div>' +
            '</div>'
}