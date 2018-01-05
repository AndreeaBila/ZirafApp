<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    //checkRequestType();
    //get the dependenceis
    require_once "../phpComponents/dependencies.php";
    //create database connection
    $db = createConnection();

    //create distinct selects for the three types of posts

    //selecting announcements
    $announcement_query = "SELECT P.postId, P.content, P.dateCreated, U.userId, U.userName, U.iconExtension, (SELECT COUNT(*) FROM USER_LIKES UL WHERE UL.postId = P.postId) AS announcementLikes ".
                          "FROM POSTS P INNER JOIN USER_POSTS UP ON P.postId = UP.postId ".
                          "INNER JOIN USERS U ON U.userId = UP.userId";

    $result = $db->query($announcement_query);
    //an array with all the announcement data
    $announcementArray = array();
    while($row = $result->fetch_assoc()){
        $announcement = new Post($row['postId'], $row['content'], $row['dateCreated'], $row['announcementLikes'], $row['userId'], $row['userName'], $row['iconExtension']);
        //fetch the object data
        $announcementData = $announcement->getPostData();
        //add the new data array to the array of posts
        array_push($announcementArray, $announcementData);
    }

    //selecting image uploads
    $imageUpload_query = "SELECT IU.imageId, IU.fileName, IU.description, IU.dateCreated, U.userId, U.userName, U.iconExtension, (SELECT COUNT(*) FROM USER_LIKES UL WHERE UL.postId = IU.imageId) AS imageUploadsLikes ".
                         "FROM IMAGE_UPLOADS IU INNER JOIN USER_IMAGES UI ON IU.imageId = UI.imageId ".
                         "INNER JOIN USERS U ON U.userId = UI.userId";

    $result = $db->query($imageUpload_query);
    //an array with all the announcement data
    $imageUploadArray = array();
    while($row = $result->fetch_assoc()){
        $image = new ImageUpload($row['imageId'], $row['fileName'], $row['description'], $row['dateCreated'], $row['imageUploadLikes'], $row['userId'], $row['userName'], $row['iconExtension']);
        //fetch the object data
        $imageData = $image->getImageUploadData();
        //add the new data array to the array of posts
        array_push($imageUploadArray, $imageData);
    }

    //selecting polls
    $poll_query = "SELECT PL.pollId, PL.pollStatement, PL.pollDescription, PL.dateCreated, U.userId, U.userName, U.iconExtension, (SELECT COUNT(*) FROM USER_LIKES UL WHERE UL.postId = PL.pollId) AS pollLikes ".
                  "FROM POLLS PL INNER JOIN USER_POLLS UPL ON PL.pollId = UPL.pollId " .
                  "INNER JOIN USERS U ON U.userId = UPL.userId";

    $result = $db->query($poll_query);
    //an array with all the announcement data
    $pollArray = array();
    while($row = $result->fetch_assoc()){
        //get all the poll options associated with the current poll
        $pollId = $row['pollId'];
        $currentPollVotes = 0;
        $pollOptions_query = "SELECT * FROM POLL_OPTIONS WHERE pollId = $pollId";
        $optionResults = $db->query($pollOptions_query);
        $pollOptionsArray = array();
        while($optionsRow = $optionResults->fetch_assoc()){
            $pollOption = new PollOption($row['optionId'], $row['pollId'], $row['content'], $row['votes']);
            $currentPollVotes += $optionsRow['votes'];
            $pollOptionsData = $pollOption->getPollOptionData();
            array_push($pollOptionsArray, $pollOptionsData);
        }

        //create the poll itself
        $poll = new Poll($row['pollId'], $row['pollStatement'], $row['pollDescription'], $currentPollVotes, $row['pollLikes'], $row['dateCreated'], $row['userId'], $row['userName'], $row['iconExtension']);
        $pollData = $poll->getPollData();
        //append the array of options
        $pollData['pollOptionArray'] = $pollOptionsArray;
        array_push($pollArray, $pollData);
    }

    //break the arrays into categories 
    
?>