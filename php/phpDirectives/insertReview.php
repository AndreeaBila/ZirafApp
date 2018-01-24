<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //get the dependncies
    require_once "../phpComponents/dependencies.php";
    //create database connection
    $db = createConnection();
    //get the data from the fron-end
    $jsonData = $_POST['hiddenData'];
    $decodedData = json_decode($jsonData, true);
    //break the data into items
    $name = strip_tags(stripslashes($decodedData['name']));
    $topDishList = $decodedData['topDishArray'];
    //$topDishList = json_decode($topDishList, false);
    $foodRating = strip_tags(stripslashes($decodedData['foodRating']));
    $ambienceRating = strip_tags(stripslashes($decodedData['ambienceRating']));
    $serviceRating = strip_tags(stripslashes($decodedData['serviceRating']));
    $valForMoney = strip_tags(stripslashes($decodedData['valForMoney']));
    $foodReview = strip_tags(stripslashes($decodedData['foodReview']));
    $xFactor = strip_tags(stripslashes($decodedData['xFactor']));

    //sanitize the dish list array
    for($i=0;$i<count($topDishList);$i++){
        $topDishList[$i] = strip_tags(stripslashes($topDishList[$i]));
    }

    //create the review
    
?>