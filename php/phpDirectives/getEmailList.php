<?php
    session_start();
    //import the database file
    require_once "../phpComponents/databaseConnection.php";
    //verify request type
    checkRequestType();

    //create a new database connection
    $db = createConnection();
    $userId = $_SESSION['userId'];
    //query the database for all emails
    $query = "SELECT email FROM USERS WHERE userId != ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->bind_result($email);
    $emailList = array();
    while($stmt->fetch()){
        array_push($emailList, $email);
    }
    $stmt->close();
    echo json_encode($emailList);
?>