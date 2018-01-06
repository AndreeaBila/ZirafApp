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

    //get the data from the clinet
    $clientData = $_GET['emails'];
    $clientData = json_decode("$clientData", true);
    foreach($clientData as $data){
        //get the cleand email
        $email = strip_tags(stripslashes($data));
        //check its validty
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //perfom the delete
            $query = "DELETE FROM USERS WHERE email = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->close();
        }
    }


?>