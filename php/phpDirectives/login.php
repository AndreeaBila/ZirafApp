<?php
    //estabkish database connection
    require_once "../phpComponents/databaseConnection";
    $db = createconnection();

    //get user data
    $email = strip_tags($_POST['loginEmail']);
    $password = strip_tags($_POST['loginPassword']);

    
?>