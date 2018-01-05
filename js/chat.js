var selectedChat = {
  chatName : "All Zirafers",
  chatId : 1
};

var messages = [];

$(function() {
  $('#chatMenu').hide();
  $('#chatSettings').hide();
  $('.alert').hide();

  $('#chatMenuBtn').click(function() {
    $('#chatMenu').toggle('slide',{direction:'left'},500);
    $('#chatMessageInputBox').effect('slide',{direction:'down', mode:'toggle'},500);
    $('#chatSettings').hide();
  });

  $('#chatSettingsBtn').click(function() {
    $('#chatSettings').toggle('slide',{direction:'right'},500);
    $('#chatMessageInputBox').effect('slide',{direction:'down', mode:'toggle'},500);
    $('#chatMenu').hide();
  });

  // if($('#chatMenu').hasClass('opened') || $('#chatSettings').hasClass('opened')) {
  //   $('#chatMessageInputBox').effect('slide',{direction:'down', mode:'hide'},500);
  // } else {
  //   $('#chatMessageInputBox').effect('slide',{direction:'up', mode:'show'},500);
  // }
  
  //append the url paramter
  //window.history.pushState(null, null, "?chatId=");
  //append the proper chatID
  //updateURLChatId();

  initializeMessages();

  //check if the user pressed the send button
  $('#sendChatMessage').click(function(){
    //get the value of the message box
    var sentMessage = $('#chatMessageInput').val();
    var messageData = {
      content: sentMessage,
      chatId: selectedChat.chatId
    };
    //check if the message is not empty
    if(sentMessage !== ''){
      //make an ajax request and send the message
      $.ajax({
        data: messageData,
        url: "../php/phpDirectives/insertMessage.php",
        type: "POST",
        error: function(){
          alert("error occured");
        }
      });
      //clear the value of the text box
      $('#chatMessageInput').val("");
      $("html, body").animate({ scrollTop: $(document).height() }, 1000);
    }
  });

  //check if the user pressed enter
  $('#chatMessageInput').keydown(function(e){
    //verify what key was pressed
    if(e.keyCode == 13){
      $('#sendChatMessage').click();
    }
  });

  //check if user clicked load more
  $('.loadLink').click(function(){
    //create payload to select 20 messages from this chat
    linkPayload = selectedChat;
    //get the present messages as an array of children
    var currentMessages = $(".chatBox").children();
    //check the length of the children
    if(currentMessages.length > 1){
      linkPayload['messageIndex'] = currentMessages.first().next().attr('id');
      //load all message from the database associtaed with the given chat
      $.ajax({
        data: linkPayload,
        url: "../php/phpDirectives/getMessages.php",
        type: "GET",
        success: function(data){
          response = JSON.parse(data);
          displayPreviousMessages(response);
        },
        error: function(){
          $('#messageErrorAlert').show();
        }
      });
    }
  });

  //check if an option for creating a new group has been created
  $('#selectUserEmails').keydown(function(e){
    if(e.keyCode == 13){
      //get the value of the selected email
      var selectedEmail = $('#selectUserEmails').val();
      //get the list of all options
      var allOptions = $('#chatCreator').children();
      if(checkOptionValue(allOptions, selectedEmail)){
        //add the selected email to the list of selected emails
        $('#addedMembers').append('<div class="members row">' +
                                  '<p class="emails col-8">' + selectedEmail + '</p>' +
                                  '<button type="button" class="removeMemberBtn col-4">remove &times;</button>' +
                                  '</div>');
        //delete the input data
        $('#selectUserEmails').val("");
        //delete the selected email from the list of available options
        $('#chatCreator option[value="'+ selectedEmail +'"]').remove();
         //chekc if a row from the selected emails list has been deleted
        $('.removeMemberBtn').unbind('click');
        $('.removeMemberBtn').bind('click', function(){
          var deletedEmail = $(this).siblings().first().text();
          //add the email back to the select
          $('#chatCreator').append('<option value="'+ deletedEmail +'">');
          $(this).parent().remove();
        });
      }
    }
  });

  //check if an option for creating a new group has been created
  $('#selectUserEmailsToAdd').keydown(function(e){
    if(e.keyCode == 13){
      //get the value of the selected email
      var selectedEmail = $('#selectUserEmailsToAdd').val();
      //get the list of all options
      var allOptions = $('#addUsers').children();
      if(checkOptionValue(allOptions, selectedEmail)){
        //add the selected email to the list of selected emails
        $('#addedMembersToAdd').append('<div class="members row">' +
                                       '<p class="emails col-8">' + selectedEmail + '</p>' +
                                       '<button type="button" class="removeMemberBtnToAdd removeMemberBtn col-4">remove &times;</button>' +
                                       '</div>');
        //delete the input data
        $('#selectUserEmailsToAdd').val("");
        //delete the selected email from the list of available options
        $('#addUsers option[value="'+ selectedEmail +'"]').remove();
        //chekc if a row from the selected emails list has been deleted
        $('.removeMemberBtnToAdd').unbind('click');
        $('.removeMemberBtnToAdd').bind('click', function(){
          var deletedEmail = $(this).siblings().first().text();
          //add the email back to the select
          $('#addUsers').append('<option value="'+ deletedEmail +'">');
          $(this).parent().remove();
        });
      }
    }
  });

  //check if the user pressed the create chat button
  $('#createChatBtn').click(function(){
    var selectedOptions = $('#addedMembers').children();
    var chatName = $('#chatNameInput').val();
    //check if the chatName has been specified
    if(chatName === ""){
      $('#chatNameAlert').show();
      return;
    }
    //clear the two inputs
    $('#selectUserEmails').val('');
    $('#chatNameInput').val('');
    $('#addedMembers').empty();
    var chatEmails = {
      chatName : chatName,
      emailList : ""
    };
    for(var i=0;i<selectedOptions.length;i++){
      chatEmails.emailList += selectedOptions[i].childNodes[0].innerHTML + ",";
    }
    chatEmails.emailList = chatEmails.emailList.slice(0, -1);
    //send the chat data
    $.ajax({
      data: chatEmails,
      url: "../php/phpDirectives/createChat.php",
      type: "POST",
      success: function(result){
        if(result === "Error") return;
        var parsedResult = JSON.parse(result);
        //close the modal
        $('#closeModalBtn').click();
        //append the newly created chat
        $('#chatsList').append('<li class="chats" id="chat' + parsedResult.chatId +'"><i class="fa fa-comments-o" aria-hidden="true"></i>'+ parsedResult.chatName +'</li>');
        //bind the new element to the existing selector function
        $('#chatsList li#chat' + parsedResult.chatId).bind("click", function(){
          switchChat(this);
        });
        //reload the data
        $('#chatsList li#chat' + parsedResult.chatId).click();
      },
      error: function(){
        $('#createChatErrorAlert').show();
      }
    }); 
  });

  //check if the user pressed the add button
  $('#addBtn').click(function(){
    var membersToAdd = $('#addedMembersToAdd').children();
    $('#selectUserEmailsToAdd').val('');
    $('#addedMembersToAdd').empty();

    var addEmails = {
      chatId : selectedChat.chatId,
      emailList : ""
    };

    for(var i=0;i<membersToAdd.length;i++){
      addEmails.emailList += membersToAdd[i].childNodes[0].innerHTML + ",";
    }
    if(addEmails.emailList === ""){
      $('#addMembersAlert').show();
      return;
    }
    addEmails.emailList = addEmails.emailList.slice(0, -1);
    //send the chat data
    $.ajax({
    data: addEmails,
    url: "../php/phpDirectives/addUsersToChat.php",
    type: "POST",
    success: function(result){
      if(result === "Error") return;
      var userArray = JSON.parse(result);
      for(var i=0;i<userArray.length;i++){
        $('#membersList').append(parseUserData(userArray[i]));
      }
      $('#addUserModal').modal('toggle');
      //get the current number of messages
      var currentMessages = parseInt($('#participantCount').text()[0]);
      var sum = currentMessages + userArray.length;
      //update the result
      if(sum == 1){
        $('#participantCount').text("1 participant");
      }else{
        $('#participantCount').text(sum + " participants");
      }
      $('#chatSettingsBtn').click();
    },
    error: function(){
      $('#addMembersErrorAlert').show();
    }
    });

  });

  //check if the user has selected another chat
  $('#chatsList li').click(function(){
    switchChat(this);
  });

  //check if the user oppend the chek settings tab
  $('#chatSettingsBtn').click(function(){
    //empty the list of emails
    $('#membersList').empty();
    //get every user from teh database
    $.getJSON("../php/phpDirectives/getEmailsForChat.php?chatId=" + selectedChat.chatId, function(data){
      //change the count of total user emails
      if(data.length == 1){
        $('#participantCount').text("1 participant");
      }else{
        $('#participantCount').text(data.length + " participants");
      }
      //append the emails to the email list
      for(var i=0;i<data.length;i++){
        $('#membersList').append(parseUserData(data[i]));
        $('.removeUser').unbind('click');
        $('.removeUser').bind('click', function(){
          deletedUser = $(this).siblings().first().next().text();
          previousRow = this;
          //check the confirm opeartion
          $('#removeUserBtn').click(function(){
            if(selectedChat.chatId === 1){
              alert("You cannot remove yourself or anybody else from the All Zirafers chat.");
              location.reload();
              return;
            }
            //delete the user from the database
            var deleteData = {
              chatId : selectedChat.chatId,
              email : deletedUser
            };
            $.ajax({
              data: deleteData,
              url: "../php/phpDirectives/removeUser.php",
              type: "GET",
              success: function(count){
                if(count === 'self'){
                  location.reload();
                }else{
                  $(previousRow).parent().remove();
                  $('#removeUserModal').modal('toggle');
                  //update count
                  if(count == 1){
                    $('#participantCount').text("1 participant");
                  }else{
                    $('#participantCount').text(count + " participants");
                  }
                }
              },
              error: function(){
                alert("An error has occured");
              }
            });
          });
          //check if the user has cancelled the removal operation and elete the data
          $('#closeModalUserRemovalBtn').click(function(){
            //delete the associated user data
            if(typeof deletedUser !== 'undefined' && typeof previousRow !== 'undefined'){
              delete deletedUser;
              delete previousRow;
            }
          });
        });
      }
    });
  });

  //check if the leave chat button has been clicked
  $('#leaveChatBtn').click(function(){
    //check if the chatId is 1
    if(selectedChat.chatId === 1){
      alert("You cannot leave the All Zirafers chat.");
      return;
    }
    $.ajax({
      data: selectedChat,
      url: "../php/phpDirectives/leaveChat.php",
      type: "get",
      success: function(){
        location.reload();
      },
      error: function(){
        alert("Error occured");
      }
    });
  });
});

function displayChat(messageList){
  //display first batch of messages
  for(var i=0;i<messageList.length;i++){
    //get the message at given index
    var message = messageList[i];
    var messageElement = parseMessage(message);
    $('.chatBox').append(messageElement);
  }
}

function displayPreviousMessages(messageList){
  for(var i=messageList.length - 1;i>=0;i--){
    var message = messageList[i];
    var messageElement = parseMessage(message);
    $(messageElement).insertAfter('.loadLink');
  }
}

function parseMessage(message){
  var messageElement = (message.myMessage) ? '<div class="messageBox myMessage float-right" id="'+ message.messageId +'">' : '<div class="messageBox otherMessage float-left" id="'+ message.messageId +'">'
  messageElement +=       '<div class="messageHeader">' + 
                            '<img src="../img/userIcons/'+ message.userId + '.' + message.iconExtension + '" alt="Pic" class="messageImage float-left">' +
                            '<p class="messageName float-left">'+ message.userName +'</p>' +
                            '<p class="messageTime float-right">'+ message.dateCreated.slice(0, -3) +'</p>' +
                          '</div>' +
                          '<div class="clear"></div>' +
                          '<div class="messageBody">' +
                            '<p class="messageContent">'+ message.content +'</p>' +
                          '</div>' +
                        '</div>' +
                        '<div class="clear"></div>';
  return $.parseHTML(messageElement);

}

function messageTimeout(){
  //check if there are any new messages
  if(messages.length === 0){
    var lastMessage = {
      messageId : 0,
      chatId : selectedChat.chatId
    };
  }else{
    var lastMessage = {
      messageId : messages[messages.length - 1].messageId,
      chatId : selectedChat.chatId
    };
  }
  //check if there are any new messages and get the number of messages
  $.ajax({
    data: lastMessage,
    url: "../php/phpDirectives/getLastMessages.php",
    type: "GET",
    success: function(response){
      if(response === 'undefined'){
        return;
      }
      var messageArray = JSON.parse(response);
      if(messageArray.length > 0){
        displayChat(messageArray);
        messages = messages.concat(messageArray);
        $("html, body").animate({ scrollTop: $(document).height() }, 1000);
      }
    }
  });
}

function checkOptionValue(options, value){
  for(var i=0;i<options.length;i++){
    if(options[i].value == value){
      return true;
    }
  }
  return false;
}

function initializeMessages(){
  //remove the event listener
  window.clearInterval(messageTimeout);
  //delete the already loaded elements if they exist
  messages.splice(0);
  //delete all messages that currently exist
  $(".chatBox").children().filter(":not(.loadLink)").remove();
  //change the chat title
  $('#chatTitle').text(selectedChat.chatName);
  //create payload to select 20 messages from this chat
  dataPayload = selectedChat;
  dataPayload['messageIndex'] = -1;
  //load all message from the database associtaed with the given chat
  $.ajax({
    data: dataPayload,
    url: "../php/phpDirectives/getMessages.php",
    type: "GET",
    success: function(data){
      messages = JSON.parse(data);
      displayChat(messages);
      $("html, body").animate({ scrollTop: $(document).height() }, 1000);
      //now start listening for new messages
      //check for new message every 0.5 seconds
      window.setInterval(messageTimeout, 500);
    },
    error: function(){
      alert("Error");
    }
  });
}

function switchChat(current){
  //get the selected chat's data
  var newName = $(current).text();
  var newId = $(current).attr('id').replace('chat', '');
  //update the current chat data
  selectedChat.chatId = newId;
  selectedChat.chatName = newName;
  //update the url
  //updateURLChatId();
  //reslide the chat selector
  $('#chatMenuBtn').click();
  //delete all messages from the page
  $(".chatBox").children().filter(":not(.loadLink)").remove();
  //load all new messages
  initializeMessages();
}

function parseUserData(data){
  return '<div class="memberBox">' +
            '<img src="../img/userIcons/'+ data.userId +'.'+ data.iconExtension +'" alt="no" class="float-left">' +
            '<p class="float-left">'+ data.email +'</p>' +
            '<button class="float-right removeUser" data-toggle="modal" data-target="#removeUserModal">remove &times;</button>' +
          '</div>' +
          '<div class="clear"></div>';
}

function updateURLChatId(){
  //append the chat id to the url for later detection
  var url = selectedChat.chatId;
  //update the url
  window.history.pushState(null, null, url);
}