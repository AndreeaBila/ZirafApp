<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();
    //import dependencies
    require_once "../phpComponents/dependencies.php";
    //create database connection
    $db = createConnection();

    //get the user data
    $chatId = strip_tags(stripslashes($_POST['chatId']));
    $emailList = strip_tags(stripslashes($_POST['emailList']));
    $emailList = explode(",", $emailList);

    //calculate teh today date
    $date = date("Y-m-d");
    //add the current email list to the given chat
    foreach($emailList as $email){
        //get the userId of the current email
        $getIdQuery = "SELECT userId FROM USERS WHERE email = ?";
        $stmt = $db->prepare($getIdQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId);
        $stmt->fetch();
        $stmt->close();

        //check if the given email doesn't already exist
        $checkEmailQuery = "SELECT count(*) AS total FROM USER_CHATS WHERE userId = $userId AND chatId = ?";
        $stmt = $db->prepare($checkEmailQuery);
        $stmt->bind_param("s", $chatId);
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();
        $stmt->close();
        if($total == 0){
            //insert the association
            $insertQuery = "INSERT INTO USER_CHATS VALUES(?, ?, ?)";
            $stmt = $db->prepare($insertQuery);
            $stmt->bind_param("sss", $userId, $chatId, $date);
            $stmt->execute();
            $stmt->close();
        }
    }
?>