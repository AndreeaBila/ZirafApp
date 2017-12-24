<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();
    //create database connection
    $db = createConnection();
    //get the user input
    $chatId = strip_tags(stripslashes($_POST['chatId']));
    $content = strip_tags(stripslashes($_POST['content']));
    $userId = $_SESSION['userId'];
    $date = date("Y-m-d");
    //insert the message
    $query = "INSERT INTO MESSAGES VALUES(NULL, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssss", $userId, $chatId, $content, $date);
    $stmt->execute();
    $stmt->close();
?>