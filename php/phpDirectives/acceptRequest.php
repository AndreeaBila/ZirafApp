<?php
    //import the database file
    require_once "../phpComponents/databaseConnection.php";
    //verify request type
    checkRequestType();

    //get the user data
    $email = filter_var(strip_tags(stripslashes($_GET['email'])), FILTER_SANITIZE_EMAIL);
    //still veirfy the email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) die("Error");

    //verify the user's account
    //create database connection
    $db = createConnection();
    $query = "UPDATE USERS SET execActivation = 1 WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();
    //get the number of pending requests
    $query = "SELECT count(*) AS Total FROM USERS WHERE execActivation = 0";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    echo $row['Total'];
?>