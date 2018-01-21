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
    //email the user to inform about the exec activation
    $subject = "ZirafApp Executive Activation";
    $message = "Dear Zirafer, <br> We would like to inform you that you email has been verified by a member of the executive team. If you have verified your email address, you can sign in at every moment!";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($email, $subject, $message, $headers) or doNothing();
    //get the number of pending requests
    $query = "SELECT count(*) AS Total FROM USERS WHERE execActivation = 0";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    echo $row['Total'];

    function doNothing(){}
?>