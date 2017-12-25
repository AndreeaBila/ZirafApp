var selectedChat = {
  chatName : "All Zirafers",
  chatId : 1
};

var messages;

$(function() {
  $('#chatMenu').hide();
  $('#chatMenuBtn').click(function() {
    $('#chatMenu').toggle('slide');
  });
  
  //load all message from the database associtaed with the given chat
  $.ajax({
    data: selectedChat,
    url: "../php/phpDirectives/getMessages.php",
    type: "GET",
    success: function(data){
      messages = JSON.parse(data);
      displayChat(messages);
    },
    error: function(){
      alert("Error");
    }
  });

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

  //check for new message every 0.5 seconds
  window.setInterval(function(){
    messageTimeout();
  }, 500);

  //check if the user pressed enter
  $('#chatMessageInput').keydown(function(e){
    //verify what key was pressed
    if(e.keyCode == 13){
      $('#sendChatMessage').click();
    }
  });
});

function displayChat(messageList){
  const MESSAGE_DISPLAY_STEP = 20;
  //display first batch of messages
  var i = 0;
  var count = 0;
  while(i < messageList.length){
    //get the message at given index
    var message = messageList[i++];
    count++;
    var messageElement = parseMessage(message);
    $('.loadLink').append(messageElement);
  }
}

function parseMessage(message){
  var messageElement = (message.myMessage) ? '<div class="messageBox myMessage float-right">' : '<div class="messageBox otherMessage float-left">'
  messageElement +=       '<div class="messageHeader">' + 
                            '<img src="../img/userIcons/'+ message.userId +'.jpeg" alt="Pic" class="messageImage float-left">' +
                            '<p class="messageName float-left">'+ message.userName +'</p>' +
                            '<p class="messageTime float-right">'+ message.dateCreated +'</p>' +
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
    url: "../php/phpDirectives/getNumberOfNewMessages.php",
    type: "GET",
    success: function(result){
      if(result > 0){
        //query the last reuslt messages
        var queryMessages = {
          count : result,
          chatId : selectedChat.chatId
        };
        $.ajax({
          data: queryMessages,
          url: "../php/phpDirectives/getLastMessages.php",
          type: "GET",
          success: function(response){
            var messageArray = JSON.parse(response);
            if(messageArray.length > 0){
              displayChat(messageArray);
              messages = messages.concat(messageArray);
            }
          }
        });
      }
    }
  });
}