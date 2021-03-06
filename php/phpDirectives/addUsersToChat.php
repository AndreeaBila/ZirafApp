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
    $emailListString = $_POST['emailList'];
    //check that the emailList is not empty
    if($emailListString === ""){
        exit("Error");
    }
    $emailList = array();
    $emailListString = json_decode($emailListString, true);
    foreach($emailListString as $current){
        array_push($emailList, strip_tags(stripslashes($current)));
    }


    //calculate teh today date
    $date = date("Y-m-d");
    //add the current email list to the given chat
    $returnInfo = array();
    foreach($emailList as $email){
        //get the userId of the current email
        $getIdQuery = "SELECT userId, iconExtension FROM USERS WHERE email = ?";
        $stmt = $db->prepare($getIdQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId, $iconExtension);
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
            $userData['userId'] = $userId;
            $userData['email'] = $email;
            $userData['iconExtension'] = $iconExtension;
            array_push($returnInfo, $userData);
        }
    }

    echo json_encode($returnInfo);
?>