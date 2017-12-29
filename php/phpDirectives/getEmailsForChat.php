<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();
    //create database connection
    $db = createConnection();
    //get the user input
    $chatId = strip_tags(stripslashes($_GET['chatId']));
    //get all the user email associate with the given chat
    $query = "SELECT U.email, U.userId, U.iconExtension FROM USERS U INNER JOIN USER_CHATS UC ON U.userId = UC.userId WHERE UC.chatId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $chatId);
    $stmt->execute();
    $stmt->bind_result($email, $userId, $iconExtension);
    $emailList = array();
    while($stmt->fetch()){
        $userData['userId'] = $userId;
        $userData['email'] = $email;
        $userData['iconExtension'] = $iconExtension;
        array_push($emailList, $userData);
    }
    $stmt->close();
    echo json_encode($emailList);
?>