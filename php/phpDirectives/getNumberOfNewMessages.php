<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();
    //create database connection
    $db = createConnection();

    $lastId = strip_tags(stripslashes($_GET['messageId']));
    $chatId = strip_tags(stripslashes($_GET['chatId']));
    //check how many messages have been added
    $query = "SELECT COUNT(*) AS total FROM MESSAGES WHERE chatId = ? AND messageId > ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $chatId, $lastId);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    echo $count;
?>