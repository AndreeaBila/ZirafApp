<?php
    //import the database file
    require_once "../phpComponents/databaseConnection.php";
    //verify request type
    //checkRequestType();

    //get the user data
    $email = filter_var(strip_tags(stripslashes($_GET['email'])), FILTER_SANITIZE_EMAIL);
    //still veirfy the email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) die("Error");

    //verify the user's account
    //create database connection
    $db = createConnection();
    $query = "SELECT userId FROM USERS WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    //delete the user with the given id
    $query = "DELETE FROM USERS WHERE userId = $userId";
    $db->query($query);
    //delete the associated profile picture
    unlink("../../img/userIcons/$userId".".jpeg");

    //get the left users
    //get the number of pending requests
    $query = "SELECT count(*) AS Total FROM USERS WHERE execActivation = 0";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    echo $row['Total'];
?>