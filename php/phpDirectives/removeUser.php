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

    //check if the user removed himself
    $query = "SELECT userId FROM USERS WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    if($userId == $_SESSION['userId']){
        echo "self";
        if($chatId != 1){
            deleteAssociation($db, $email, $chatId);
        }
    }else{
        deleteAssociation($db, $email, $chatId);
        //get the number of users from the database
        $query = "SELECT COUNT(*) FROM USER_CHATS WHERE chatId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $chatId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        echo $count;
    }

    function deleteAssociation($db, $email, $chatId){
        $query = "DELETE FROM USER_CHATS WHERE userId = (SELECT userId FROM USERS WHERE email = ?) AND chatId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $email, $chatId);
        $stmt->execute();
        $stmt->close();
    }
?>