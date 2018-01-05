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

    //get the user id
    $userId = $_SESSION['userId'];
    //get the user input from the client
    $postContent = strip_tags(stripslashes($_POST['postContent']));
    //get the post date
    $postDate = date("Y-m-d H:i:s");
    //insert the new post in the database
    $query = "INSERT INTO POSTS VALUES(NULL, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $postContent, $postDate);
    $stmt->execute();
    $stmt->close();

    //get the postId
    $query = "SELECT MAX(postId) AS currentPostId FROM POSTS";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $postId = $row['currentPostId'];

    //create a user association
    $query = "INSERT INTO USER_POSTS VALUES(?, $postId)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->close();

    //get the post data from the database
    $query = "SELECT userName, iconExtension FROM USERS WHERE userId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->bind_result($userName, $iconExtension);
    $stmt->fetch();
    $stmt->close();

    //create a new post data
    $post = new Post($postId, $postContent, $postDate, 0, $userId, $userName, $iconExtension);
    $postArray = $post->getPostData();
    echo json_encode($postArray);
?>