<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();
    //get the post and user dependencies
    require_once "../phpComponents/dependencies.php";
    //create database connection
    $db = createConnection();

    //get the poll data
    $pollQuestion = strip_tags(stripslashes($_POST['pollQuestion']));
    $pollOptionString = $_POST['pollOptionString'];
    $pollDescription = strip_tags(stripslashes($_POST['pollDescription']));

    $pollOptionString = json_decode($pollOptionString, true);
    //break the string into an array
    $pollOptionArray = array();
    foreach($pollOptionString as $string){
        array_push($pollOptionArray, strip_tags(stripslashes($string)));
    }
    $dateCreated = date("Y-m-d H:i:s");
    //create a new poll item in the database
    $query = "INSERT INTO POLLS VALUES(NULL, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sss", $pollQuestion, $pollDescription, $dateCreated);
    $stmt->execute();
    $stmt->close();
    
    //get the new poll id
    $query = "SELECT MAX(pollId) AS currentPollId FROM POLLS";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $pollId = $row['currentPollId'];

    //insert a user poll association
    $userId = $_SESSION['userId'];
    $query = "INSERT INTO USER_POLLS VALUES(?, $pollId)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->close();

    //get the required user data
    $query = "SELECT userName, iconExtension FROM USERS WHERE userId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->bind_result($userName, $iconExtension);
    $stmt->fetch();
    $stmt->close();

    //create a poll object
    $pollObject = new Poll($pollId, $pollQuestion, $pollDescription, 0, 0, $dateCreated, $userId, $userName, $iconExtension);
    $pollInfo = $pollObject->getPollData();
    //insert each option into the database
    foreach($pollOptionArray as $currentOption){
        $query = "INSERT INTO POLL_OPTIONS VALUES(NULL, $pollId, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $currentOption);
        $stmt->execute();
        $stmt->close();

        //get the last poll_option id
        $query = "SELECT MAX(optionId) AS currentOptionId FROM POLL_OPTIONS";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $optionId = $row['currentOptionId'];

        //create a new poll option
        $optionObject = new PollOption($optionId, $pollId, $currentOption, 0);
        $optionData = $optionObject->getPollOptionData();

        //add the new data object to the poll itself
        if(!isset($pollInfo['pollOptionArray'])){
            $pollInfo['pollOptionArray'] = array();
        }
        array_push($pollInfo['pollOptionArray'], $optionData);
    }

    echo json_encode($pollInfo);

?>