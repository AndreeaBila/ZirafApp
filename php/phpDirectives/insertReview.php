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
    $score = strip_tags(stripslashes($decodedData['score']));

    //sanitize the dish list array
    for($i=0;$i<count($topDishList);$i++){
        $topDishList[$i] = strip_tags(stripslashes($topDishList[$i]));
    }

    //calculate the date
    $dateCreated = date("Y-m-d");
    //insert the review in the database
    $insertReviewQuery = "INSERT INTO REVIEWS VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($insertReviewQuery);
    $stmt->bind_param("ssssssss", $name, $foodRating, $ambienceRating, $serviceRating, $valForMoney, $foodReview, $xFactor, $dateCreated);
    $stmt->execute();
    $stmt->close();

    //get the id of the view
    $query = "SELECT max(reviewId) AS currentId FROM REVIEWS";
    $result = $db->query($query);
    $result = $result->fetch_assoc();
    $reviewId = $result['currentId'];

    //insert the dish list
    foreach($topDishList as $dish){
        $insertDishQuery = "INSERT INTO DISHES VALUES(NULL, ?, ?)";
        $stmt = $db->prepare($insertDishQuery);
        $stmt->bind_param("ss", $dish, $reviewId);
        $stmt->execute();
        $stmt->close();
    }

    //create a user association with the review
    $userId = $_SESSION['userId'];
    $query = "INSERT INTO USER_REVIEWS VALUES(?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $userId, $reviewId);
    $stmt->execute();
    $stmt->close();

    //increase the user score with the increase score file
    require_once "../phpComponents/updateUserScore.php";
    update($score, $db, $userId);

    //manage the file upload
    //push the error data
    $fileError = array();
    $fileTarget = $_FILES['reviewPicturesBtn'];
    foreach($fileTarget['error'] as $elem){
        array_push($fileError, $elem);
    }
    
    //push the tmp_name data
    $fileTmpName = array();
    foreach($fileTarget['tmp_name'] as $elem){
        array_push($fileTmpName, $elem);
    }

    //push the name data
    $fileNameData = array();
    foreach($fileTarget['name'] as $elem){
        array_push($fileNameData, $elem);
    }

    
    //create a new folder for the review
    mkdir("../../img/reviews/".$reviewId);

    //iterate through every file and perform upload
    for($i=0; $i<count($fileError); $i++){
        manageFileUpload($fileError[$i], $fileTmpName[$i], $fileNameData[$i], $reviewId, $i);
    }

    //redirect the user to the review page
    header("Location: ../review");

    function manageFileUpload($error, $tmp_name, $name, $reviewId, $counter){
        try {            
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (!isset($error)) {
                throw new RuntimeException('Invalid parameters.');
            }
        
            // Check $_FILES['reviewPicturesBtn']['error'] value.
            switch ($error) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            
            // DO NOT TRUST $_FILES['reviewPicturesBtn']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($tmp_name),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }
            
            $info = pathinfo($name);
            $ext = $info['extension']; // get the extension of the files
            
            $newname = "$counter.$ext";
            $target = "../../img/reviews/$reviewId/$newname";
            // You should name it uniquely.
            // DO NOT USE $_FILES['reviewPicturesBtn']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            if (!move_uploaded_file($tmp_name, $target)) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
        } catch (RuntimeException $e) {
            die("Error");
        }
    }


?>