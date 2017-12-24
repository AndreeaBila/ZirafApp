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
    //get the chat id
    $chatId = strip_tags(stripslashes($_GET['chatId']));
    $count = strip_tags(stripslashes($_GET['count']));
    //get the last messages
    $query = "SELECT M.messageId, M.userId, M.chatId, M.content, M.dateCreated, U.userName FROM MESSAGES M INNER JOIN USERS U ON M.userId = U.userId WHERE chatId = ? ORDER BY M.messageId DESC LIMIT ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $chatId, $count);
    $stmt->execute();
    $stmt->bind_result($messageId, $userId, $chatId, $content, $dateCreated, $userName);
    $messageList = array();
    while($stmt->fetch()){
        $message = new Message($messageId, $userId, $chatId, $content, $dateCreated);
        $messageData = $message->getMessageData();
        $messageData['myMessage'] = ($_SESSION['userId'] == $userId) ? true : false;
        $messageData['userName'] = $userName;
        array_push($messageList, $messageData);
    }
    $stmt->close();
    array_reverse($messageList);
    echo json_encode($messageList);
?>