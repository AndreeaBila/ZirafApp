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

    

?>