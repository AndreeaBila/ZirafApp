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

    //get the vote data
    $pollId = strip_tags(stripslashes($_GET['pollId']));
    $pollOptionId = strip_tags(stripslashes($_GET['pollOptionId']));
    $userId = $_SESSION['userId'];
    //check if the user has already voted in this poll and delete that vote
    $query = "DELETE FROM USER_VOTES WHERE userId = ? AND pollId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $userId, $pollId);
    $stmt->execute();
    $stmt->close();

    //cast the user's vote
    $query = "INSERT INTO USER_VOTES VALUES(?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sss", $userId, $pollId, $pollOptionId);
    $stmt->execute();
    $stmt->close();

    //get the total number of votes for the given poll
    //and the number of votes for each polloption

    $query = "SELECT COUNT(*) AS totalVotes FROM USER_VOTES WHERE pollId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $pollId);
    $stmt->execute();
    $stmt->bind_result($totalVotes);
    $stmt->fetch();
    $stmt->close();

    //get the option ids for every option
    $query = "SELECT optionId FROM POLL_OPTIONS WHERE pollId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $pollId);
    $stmt->execute();
    $stmt->bind_result($currentOptionId);
    $optionVotes = array();
    $optionIndexes = array();
    $resultedOptions = array();
    while($stmt->fetch()){
        array_push($optionIndexes, $currentOptionId);
    }
    $stmt->close();

    foreach($optionIndexes as $currentOptionId){
        $optionVotes['value'] = getVotesForOption($db, $pollId, $currentOptionId);
        $optionVotes['key'] = 'pollOption'.$currentOptionId;
        array_push($resultedOptions, $optionVotes);
    }

    $returnData = array("totalVotes" => $totalVotes,
                        "optionVotes" => $resultedOptions);
    echo json_encode($returnData);

    function getVotesForOption($db, $pollId, $currentOptionId){
        //get the number of votes for that option
        $query = "SELECT COUNT(*) AS votesForOption FROM USER_VOTES WHERE pollId = ? AND optionId = ?";
        $newStmt = $db->prepare($query);
        $newStmt->bind_param("ss", $pollId, $currentOptionId);
        $newStmt->execute();
        $newStmt->bind_result($result);
        $newStmt->fetch();
        $newStmt->close();

        return $result;
    }
?>