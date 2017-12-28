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
    $messageIndex = strip_tags(stripslashes($_GET['messageIndex']));
    $query = "SELECT M.messageId, M.userId, M.chatId, M.content, M.dateCreated, U.userName, U.iconExtension FROM MESSAGES M INNER JOIN USERS U ON M.userId = U.userId WHERE chatId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $chatId);
    $stmt->execute();
    $stmt->bind_result($messageId, $userId, $chatId, $content, $dateCreated, $userName, $iconExtension);
    $messageList = array();
    while($stmt->fetch()){
        $message = new Message($messageId, $userId, $chatId, $content, $dateCreated);
        $messageData = $message->getMessageData();
        $messageData['myMessage'] = ($_SESSION['userId'] == $userId) ? true : false;
        $messageData['userName'] = $userName;
        $messageData['iconExtension'] = $iconExtension;
        array_push($messageList, $messageData);
    }
    $stmt->close();
    //take only the last twenty items
    $messageCount = 5;
    if($messageIndex == -1){
        $messageBoundry = count($messageList) - $messageCount;
    }else{
        $index = searchMessage($messageIndex, $messageList);
        array_splice($messageList, $index, count($messageList) -1);
        $messageBoundry = count($messageList) - $messageCount;
    }
    //check the length of the array
    if(count($messageList) > $messageCount){
        //slice the array
        array_splice($messageList, 0, $messageBoundry);
    }
    echo json_encode($messageList);

    function searchMessage($messageId, $messageList){
        for($i=0;$i<count($messageList);$i++){
            if($messageList[$i]['messageId'] == $messageId){
                return $i;
            }
        }
        return -1;
    }
?>