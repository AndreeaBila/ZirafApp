<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //check type of access
    checkRequestType();
    //get the dependenceis
    require_once "../phpComponents/dependencies.php";
    //create database connection
    $db = createConnection();

    //get the data from the client
    $userId = $_SESSION['userId'];
    $postId = strip_tags(stripslashes($_GET['elementId']));
    $postType = strip_tags(stripslashes($_GET['elementType']));

    //update the database
    //select the appropriate table
    if($postType === "post"){
        $tableName = "USER_POSTLIKES";
        $postIdentifier = "postId";
    }elseif($postType === "image"){
        $tableName = "USER_IMAGELIKES";
        $postIdentifier = "imageId";
    }elseif($postType === "poll"){
        $tableName = "USER_POLLLIKES";
        $postIdentifier = "pollId";
    }

    //check if the user liked the post already
    $checkLiked_query = "SELECT COUNT(*) AS count FROM $tableName WHERE userId = ? AND $postIdentifier = ?";
    $stmt = $db->prepare($checkLiked_query);
    $stmt->bind_param("ss", $userId, $postId);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if($count == 0){
        //the user never liked the post
        $query = "INSERT INTO $tableName VALUES(?, ?)";
    }else{
        //the user already liked the post
        $query = "DELETE FROM $tableName WHERE userId = ? AND $postIdentifier = ?";
    }

    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $userId, $postId);
    $stmt->execute();
    $stmt->close();

    //get the count of likes for that post
    $query = "SELECT COUNT(*) AS total FROM $tableName WHERE $postIdentifier = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $postId);
    $stmt->execute();
    $stmt->bind_result($total);
    $stmt->fetch();
    $stmt->close();

    echo $total;

?>