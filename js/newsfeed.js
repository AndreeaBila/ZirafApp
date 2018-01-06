$(function(){
  //insert the exsiting posts
  insertDatabaseItems();

  //check if the user pressed a voting radio button
  $(document).on('click', 'input.custom-control-input', function(){
    //process the voting
    executePollVote(this);
  });

  
    //check if the user pressed the like button for any element
    $(document).on('click', 'button.likePostBtn', function(){
      //send like signal
      likePost(this);
  });
});

//convert a json format into html for a post
function parsePost(post){
  var likeMessage = (post.likes == 1) ? '1 Like' : post.likes + ' Likes';
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
                  '<p class="likesCount float-right">' + likeMessage + '</p>' +
              '</footer>' +
              '<div class="clear"></div>' +
          '</div>'
}

function parseImage(imageElement){
  likeMessage = (imageElement.likes == 1) ? "1 Like" : imageElement.likes + " Likes";
  return '<div class="post" id="image'+ imageElement.imageId +'">' +
              '<div class="postHeader">' +
                  '<img src="../img/userIcons/'+ imageElement.userId +'.'+ imageElement.iconExtension +'" alt="no" class="float-left" width="40px" height="40px">' +
                  '<p class="float-left">'+ imageElement.userName +'</p>' +
                  '<small class="float-right">'+ imageElement.dateCreated +'</small>' +
              '</div>' +
              '<div class="clear"></div>' +

              '<div class="postBody">' +
                  '<img src="../img/imageUploads/'+ imageElement.fileName +'" alt="no">' +
                  '<p>'+ imageElement.description.replace(/\n/g, '<br>\n') +'</p>' +
              '</div>' +
              
              '<footer class="postFooter">' +
                  '<button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>' +
                  '<p class="likesCount float-right">'+ likeMessage +'</p>' +
              '</footer>' +
              '<div class="clear"></div>' +
          '</div>';
}

//parse the poll object received from the database
function parsePoll(pollInfo){
  //get the html for the options array
  var htmlOptionsArray = parsePollOption(pollInfo.pollOptionArray, pollInfo.totalVotes);
  var likeVar = (pollInfo.likes == 1) ? "1 Like" : pollInfo.likes + " Likes";
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
              '<p>'+ pollInfo.pollDescription.replace(/\n/g, '<br>\n') +'</p>' +
              '<footer class="postFooter">' +
                  '<button type="button" class="likePostBtn float-left"><img src="../img/ziraf.png" alt="">Like</button>' +
                  '<p class="likesCount float-right">'+ likeVar +'</p>' +
              '</footer>' +
              '<div class="clear"></div>' +
          '</div>';
}

//parse the list of poll options contained by the pollInfo
function parsePollOption(optionsInfo, totalVotes){
  var optionsHtml = '';
  for(i=0;i<optionsInfo.length;i++){
      var currentOption = optionsInfo[i];
      //calculate the completion percentage for the poll votes
      var votePercentage = (totalVotes > 0) ? parseInt((currentOption.votes * 100) / totalVotes) : 0;
      optionsHtml += '<div class="pollOption" id="pollOption'+ currentOption.optionId +'">' +
                          '<label class="custom-control custom-radio float-left">' +
                              '<input id="radio"'+ i +' name="radio" type="radio" class="custom-control-input">' +
                              '<span class="custom-control-indicator"></span>' +
                          '</label>' +
                          '<div class="progress float-left">' +
                              '<div class="progress-bar float-left" role="progressbar" style="width: '+ votePercentage +'%" aria-valuenow="'+ votePercentage +'%" aria-valuemin="0" aria-valuemax="100">' +
                                  '<p>'+ currentOption.content +'</p>' +
                              '</div>' +
                          '</div>' +
                          '<p class="float-right" id="pollOptionVoteIndicator">'+ currentOption.votes +'</p>' +
                      '</div>' +
                      '<div class="clear"></div>';
  }
  return optionsHtml;
}

//insert all the elements from the database into the newsfeed at load time
function insertDatabaseItems(){
  $.getJSON("../php/phpDirectives/getDatabaseItems.php", function(data){
      data.forEach(function(object){
          appendItem = '';
          if(object.type == 'announcement'){
              appendItem = parsePost(object);
          }else if(object.type == 'image'){
              appendItem = parseImage(object);
          }else if(object.type == 'poll'){
             appendItem = parsePoll(object);
          }

          $('#newsfeedPostBody').append(appendItem);
      });
  });
}

//update the number of likes for a post
function likePost(identifier){
  //get the id of the liked post
  var elementId = $(identifier).parent().parent().attr('id');
  //check the type of element
  if(elementId.includes('post')){
      //remove the identifier
      elementId = elementId.replace('post', '');
      var likedData = {
          elementId : elementId,
          elementType : 'post'
      };
  }else if(elementId.includes('image')){
      //remove the identifier
      elementId = elementId.replace('image', '');
      var likedData = {
          elementId : elementId,
          elementType : 'image'
      };
  }else if(elementId.includes('poll')){
      //remove the identifier
      elementId = elementId.replace('poll', '');
      var likedData = {
          elementId : elementId,
          elementType : 'poll'
      };
  }

  //send the data to the server
  $.ajax({
      data: likedData,
      type: 'GET',
      url: "./phpDirectives/likePost.php",
      success: function(response){
          //set the likes text
          var likesText = (response == 1) ? "1 Like" : response + " Likes";
          //update the likes counter
          $(identifier).siblings().first().text(likesText);
      },
      error: function(){
          alert("An error has occured while likeing the post.");
      }
  });
}

function executePollVote(identifier){
  //get the id of the selected poll option
  pollOptionId = $(identifier).parent().parent().attr('id').replace('pollOption', '');
  //get the id of the corresponding poll
  pollId = $(identifier).parent().parent().parent().parent().parent().attr('id').replace('poll', '');
  var pollVote = {
    pollOptionId : pollOptionId,
    pollId : pollId
  };
  //send the data to the database
  $.ajax({
    data: pollVote,
    type: "GET",
    url: "../php/phpDirectives/registerVote.php",
    success: function(response){
      data = JSON.parse(response);
      //update the vote parameters
      updateVotingParameters(data);
    },
    error: function(){

    }
  });
}

function updateVotingParameters(data){
  totalVotes = data.totalVotes;
  data.optionVotes.forEach(function(object){
    key = object.key;
    value = object.value;
    $('#'+ key +' p#pollOptionVoteIndicator').text(value);

    //adjust bar size
    percentage = parseInt((value * 100)/data.totalVotes) + '%';
    $('#'+ key +' div.progress div.progress-bar').width(percentage);
    $('#'+ key +' div.progress div.progress-bar').attr('aria-valuenow', percentage);
  });
}