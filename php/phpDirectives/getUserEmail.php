<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();

    //create database connection
    $db = createConnection();
    //get the current user's email address
    $userId = $_SESSION['userId'];
    $query = "SELECT email FROM USERS WHERE userId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    echo json_encode($email);

?>