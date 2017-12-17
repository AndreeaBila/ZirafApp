<?php
    //get database functionality
    require_once "../phpComponents/databaseConnection.php";
    //check type of request
    checkRequestType();
    //create database connection
    $db = createConnection();

    //get user data
    $email = strip_tags($_POST['loginEmail']);

    //create query
    $query = "SELECT emailActivation FROM USERS WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();

    echo $result;
?>