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
    $query = "SELECT userId, iconExtension FROM USERS WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $iconExtension);
    $stmt->fetch();
    $stmt->close();

    //delete the user with the given id
    $query = "DELETE FROM USERS WHERE userId = $userId";
    $db->query($query);
    //inform the user
    $subject = "ZirafApp Executive Activation";
    $message = "Dear Zirafer, <br> We would like to inform you that you account has been deleted by a member of the executive team. Unfortunately you will no longer be able to access your account.";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($email, $subject, $message, $headers) or doNothing();

    //delete the associated profile picture
    unlink("../../img/userIcons/$userId".".".$iconExtension);

    //get the left users
    //get the number of pending requests
    $query = "SELECT count(*) AS Total FROM USERS WHERE execActivation = 0";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    echo $row['Total'];

    function doNothing(){}
?>