<?php
    session_start();
    //estabkish database connection
    require_once "../phpComponents/databaseConnection.php";
    //check type of request
    checkRequestType();
    //create connection
    $db = createconnection();
    //get user data
    $email = strip_tags(stripslashes($_POST['loginEmail']));
    //check email security
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        die("Error with email");
    }

    $password = strip_tags(stripslashes($_POST['loginPassword']));

    //attemt to extract the token
    if(isset($_POST['token'])){
        $token = strip_tags(stripslashes($_POST['token']));
        //check if the given token matches the one in the database and update info
        checkActivation($db, $token, $email);
    }

    //check if the user has activated his email account
    $query = "SELECT emailActivation, execActivation, password, salt, userId, cookieHash FROM USERS WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($emailActivation, $execActivation, $storedPwd, $salt, $userId, $cookieHash);
    $stmt->fetch();
    $stmt->close();

    //hash the given password
    $hashedPwd = sha1($password . $salt);
    //check if the two hashes match
    if($hashedPwd !== $storedPwd){
        exit("loginInfo");
    }

    if($emailActivation == 0){
        //the account has not been activated
        exit("email");
    }

    //check if the account has been verified by the exec
    if($execActivation == 0){
        //the account has not been verified by an exec memeber
        exit("exec");
    }

    //indicate success
    echo "success";
    //set the user session information
    $_SESSION['userId'] = $userId;
    //verify if the keep me logged in box has been checked
    $keepLogged = isset($_POST['keepLogged']);
    if($keepLogged){
        //set the cookie
        setcookie("keepLogged", $cookieHash, time() + 86400, "/");
    }

    function checkActivation($db, $token, $email){
        //get the database activation key
        $query = "SELECT activationKey FROM USERS WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($activationKey);
        $stmt->fetch();
        $stmt->close();

        if($activationKey == $token){
            //update the activation state
            $query = "UPDATE USERS SET emailActivation = 1 WHERE email = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->close();
        }
    }
?>