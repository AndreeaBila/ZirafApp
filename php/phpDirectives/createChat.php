<?php    
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();
    //import dependencies
    require_once "../phpComponents/dependencies.php";
    //create database connection
    $db = createConnection();

    //get the user data
    $chatName = strip_tags(stripslashes($_POST['chatName']));
    if($chatName === ""){
        exit("Error");
    }
    $emailList = strip_tags(stripslashes($_POST['emailList']));
    $emailList = explode(",", $emailList);

    //create new chat
    $query = "INSERT INTO CHATS VALUES(NULL, ?, ?)";
    $dateCreated = date("Y-m-d");
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $chatName, $dateCreated);
    $stmt->execute();
    $stmt->close();

    //get the id of the created chat
    $query = "SELECT max(chatId) AS chat FROM CHATS";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $chatId = $row['chat'];

    //insert every user in the chat
    foreach($emailList as $email){
        //validate the email address
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //get the user id associated with the given emaik
            $query = "SELECT userId FROM USERS WHERE email = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($userId);
            $stmt->fetch();
            $stmt->close();

            if(isset($userId)){
                //create user association
                $query = "INSERT INTO USER_CHATS VALUES(?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->bind_param("sss", $userId, $chatId, $dateCreated);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    //insert the current user in the chat
    $userId = $_SESSION['userId'];
    $query = "INSERT INTO USER_CHATS VALUES(?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sss", $userId, $chatId, $dateCreated);
    $stmt->execute();
    $stmt->close();

    //return the chat data to the client
    $chatData = array("chatId" => $chatId, "chatName" => $chatName);
    echo json_encode($chatData);
?>