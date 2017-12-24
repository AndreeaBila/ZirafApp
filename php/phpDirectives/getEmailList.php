<?php
    //import the database file
    require_once "../phpComponents/databaseConnection.php";
    //verify request type
    checkRequestType();

    //create a new database connection
    $db = createConnection();
    //query the database for all emails
    $query = "SELECT email FROM USERS";
    $results = $db->query($query);
    $emailList = array();
    $count = 0;
    while($row = $results->fetch_assoc()){
        $emailList[$count++] = $row['email'];
    }
    echo json_encode($emailList);
?>