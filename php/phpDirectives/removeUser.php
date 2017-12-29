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
    //delete the user association for the specified chat
    $email = strip_tags(stripslashes($_GET['email']));

    $query = "DELETE FROM USER_CHATS WHERE userId = (SELECT userId FROM USERS WHERE email = ?) AND chatId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $chatId);
    $stmt->execute();
    $stmt->close();
?>