<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    //checkRequestType();
    //create database connection
    $db = createConnection();
    //get the user input
    $chatId = strip_tags(stripslashes($_GET['chatId']));
    //get all the user email associate with the given chat
    $query = "SELECT email FROM USERS WHERE email NOT IN (SELECT U.email FROM USERS U INNER JOIN USER_CHATS UC ON U.userId = UC.userId WHERE UC.chatId = ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $chatId);
    $stmt->execute();
    $stmt->bind_result($email);
    $emailList = array();
    while($stmt->fetch()){
        array_push($emailList, $email);
    }
    $stmt->close();
    echo json_encode($emailList);
?>