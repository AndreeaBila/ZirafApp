<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();
    //get the dependenceis
    require_once "../phpComponents/dependencies.php";
    //create database connection
    $db = createConnection();

    //get the data from the client
    $userId = $_SESSION['userId'];
    $postId = strip_tags(stripslashes($_GET['elementId']));
    $postType = strip_tags(stripslashes($_GET['elementType']));

    //update the database
?>