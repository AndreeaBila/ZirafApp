<?php
  session_start();
  //import the security file
  require_once "./phpComponents/security.php";
  //check authentication
  authenticate();
?>
<!--Main Page that will include all the other smaller sections (header, presentation, portofolio, about, contact, footer-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title>Zirafers - Chat</title>

    <meta name="description" content="The platform for zirafers to interact, find news and leave reviews">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" 
    integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    
    <!--Google Fonts for this project-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300|Roboto:300" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--media="screen, handheld">-->
    <!--<link rel="stylesheet" type="text/css" href="enhanced.css" media="screen  and (min-width: 40.5em)" /> -->

    <!-- Icon -->
    <link rel="shortcut icon" href="../img/zirafSmall.png"> 

    <!--Capcha-->
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- [if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif] -->        
  </head>
  <body id='bodyID'>

    <div id="wrapper" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

      <?php
        include './phpComponents/header.php';
      ?>
      
      <div id="chat">
        <div id="chatMenuNav">
          <div class="row text-center">
            <button type="button" id="chatMenuBtn" class="col-3"><i class="fa fa-bars" aria-hidden="true"></i></button>
            <h3 class="col-6 text-center" id="chatTitle">Chat Title</h3>
            <button type="button" id="chatSettingsBtn" class="col-3"><i class="fa fa-cogs" aria-hidden="true"></i></button>
          </div>
        </div>

        <div id="chatMenu">
          <!-- list all chats from the database -->

          <!-- Template start - What is should look like -->
          <!-- Nu stiu cum sa integrez asta in ce ai scris tu in php... -->
          <p id="yourChats">Your Chats</p>
          <ul id="chatsList">
            <?php
              //create database connection
              require_once "phpComponents/databaseConnection.php";
              $db = createConnection();
              //query all the chats for this user
              $query = "SELECT chatName, C.chatId FROM CHATS C INNER JOIN USER_CHATS UC ON C.chatId = UC.chatId WHERE(userId = ?)";
              $stmt = $db->prepare($query);
              $stmt->bind_param("s", $_SESSION['userId']);
              $stmt->execute();
              $stmt->bind_result($chatList, $chatId);
              while($stmt->fetch()){
                echo '<li class="chats" id="chat'.$chatId.'"><i class="fa fa-comments-o" aria-hidden="true"></i> '.$chatList.'</li>';
              }
              $stmt->close();
            ?>
          </ul>
          
          <button type="button" id="createNewChat" class="text-center float-right bgZiraf" data-toggle="modal" data-target="#createChatModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
          <div class="clear"></div>
        </div>

        <!-- Chat settings side menu -->
        <div id="chatSettings">
          
          <div id="membersListTitleBox">
            <p id="membersListTitle">Members</p>
            <!-- number of participants -->
            <small id="participantCount"></small>
          </div>
        
          <!-- List of chat participants -->
          <div id="membersList">
          </div>

          <button type="button" id="addMembers" class="col-12" data-toggle="modal" data-target="#addUserModal">Add Members</button>
          <button type="button" id="leaveChat" class="col-12" data-toggle="modal" data-target="#leaveChatModal">Leave Chat</button>

        </div>
        
        <div class="chatBox">
          <p class="loadLink">Load More</p>
        </div>
        
        <!-- WRITING MESSAGE BOX -->
        <div id="chatMessageInputBox">
          <!-- <form id="chatMessageInputForm"> this is causing a reload effect so I commented out = delete it --> 
            <input type="textarea" id="chatMessageInput" name="chatMessageInputs">
            <input type="button" value="Send" class="btn btn-primary float-right" id="sendChatMessage" name="sendChatMessage">
          <!-- </form> -->
        </div>

        <div id="messageErrorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> An error has occured
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

      </div>

      <!-- CREATE NEW GROUP MODAL -->
      <div class="modal fade" id="createChatModal" tabindex="-1" role="dialog" aria-labelledby="createChatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createChatModalLabel">Create New Chat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- <form action="" method="" id="createChatForm"> -->
                <div class="form-group">
                  <label for="exampleInputEmail1">Chat Name</label>
                  <input type="email" class="form-control form-control-lg" id="chatNameInput" aria-describedby="emailHelp" placeholder="Enter name">
                  
                  <div id="chatNameAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> You have to specify a chat name
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>

                

                <div class="form-group">
                  <label for="exampleInputEmail1">Add Members</label>
                  <div class="searchBar input-group mb-3">
                    <input type="text" onkeyup="getSuggestionsNewChat()" class="form-control form-control-lg" id="selectUserEmails">
                    <button type="button" class="btn plusBtn bgGreen" id="addUserToNewGroupBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  </div>
                  <div id="dropDownList_newChat" class="dropDownList"></div>
                  
                  <div id="createChatErrorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> An error occured
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  

                  <!-- AFTER YOU SELECT A MEMBER IT SHOULD APPEAR UNDER THE INPUT LIKE THIS -->
                  <div id="addedMembers">
                  </div>
                </div>
                <!-- ADDED MEMEBER TEMPLATE END -->

                <div class="modal-footer">
                  <button type="button" class="btn bgNeutral" id="closeModalBtn" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn bgGreen" id="createChatBtn">Create Chat</button>
                </div>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>

      <!-- ADD USER TO EXISTING CHAT MODAL -->
      <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addUserModalLabel">Add Users</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Search User Email</label>
                <div class="searchBar input-group mb-3">
                  <input type="text" onkeyup="getSuggestionsAddMember()" id="selectUserEmailsToAdd" class="x form-control form-control-lg">
                  <button type="button" class="btn plusBtn bgGreen" id="addUsertToExistingGroupBtn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
                <div id="dropDownList_addMember" class="dropDownList"></div>

                <div id="addMembersAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> You must select at least one user to add
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div id="addMembersErrorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle fa-lg " aria-hidden="true"></i> An error has occured
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>                

                <!-- AFTER YOU SELECT A MEMBER IT SHOULD APPEAR UNDER THE INPUT LIKE THIS -->
                <div id="addedMembersToAdd"></div>
                <!-- ADDED MEMEBER TEMPLATE END -->
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn bgNeutral" id="closeModalBtn" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn bgGreen" id="addBtn">Add</button>
            </div>
          </div>
        </div>
      </div>

      <!-- LEAVE CHAT MODAL -->
      <div class="modal fade" id="leaveChatModal" tabindex="-1" role="dialog" aria-labelledby="leaveChatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="leaveChatModalLabel">Leave Chat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to leave this chat?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bgNeutral" id="closeModalBtn" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn bgRed" id="leaveChatBtn">Leave</button>
            </div>
          </div>
        </div>
      </div>

      <!-- REMOVE USER FROM CHAT MODAL -->
      <div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-labelledby="removeUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="removeUserModalLabel">Remove user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to remove this user from the chat?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bgNeutral" id="closeModalUserRemovalBtn" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn bgRed" id="removeUserBtn">Remove</button>
            </div>
          </div>
        </div>
      </div>

      <?php
        include './phpComponents/footer.php';
      ?>
      

    </div>

    <!-- JS/jQuery for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" 
    integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" 
    integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/74007ae870.js"></script>

    <!-- The js script for this file -->
    <script src="../js/chat.js"></script>
  </body>
</html>
