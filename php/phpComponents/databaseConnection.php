<?php
    function createConnection(){
        //initialize the database information
        define('SERVERNAME', "localhost");
        define('USERNAME', "root");
        define('PASSWORD', "");
        define('DATABASENAME', "zirafapp_zirafers");

        // Create connection
        $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASENAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            //return the connection for later use
            return $conn;
        }
    }

    function checkRequestType(){
        define('AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
        if(!AJAX_REQUEST) {die("Error");}
    }
?>