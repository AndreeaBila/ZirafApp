<?php
    session_start();
    require_once "../phpComponents/databaseConnection.php";
    $db = createConnection();

    //get the user data
    $userName = strip_tags(stripslashes($_POST['settingsName']));
    $email = strip_tags(stripslashes($_POST['settingsEmail']));
    $password = strip_tags(stripslashes($_POST['settingsPassword']));
    $socialHandle = strip_tags(stripslashes($_POST['settingsUsername']));
    $phone = strip_tags(stripslashes($_POST['settingsPhoneNumber']));

    //extrat the user id
    $userId = $_SESSION['userId'];
    //check if the user has updated the user email
    $query = "SELECT email, activationKey FROM USERS WHERE userId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $stmt->bind_result($databaseEmail, $activationKey);
    $stmt->fetch();
    $stmt->close();
    $updatedEmail = ($databaseEmail == $email) ? false : true;
    //create the update query
    //check if the password is to be updated
    if($password == ''){
        //do not update the password
        $query = "UPDATE USERS SET userName = ?, email = ?, socialHandle = ?, phone = ? WHERE userId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sssss", $userName, $email, $socialHandle, $phone, $userId);
        $stmt->execute();
        $stmt->close();
    }else{
        //update the password too
        //get the salt from the database
        $query = "SELECT salt FROM USERS WHERE userId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $stmt->bind_result($salt);
        $stmt->fetch();
        $stmt->close();

        //rehash the password
        $hashedPassword = sha1($password . $salt);

        //update
        //do not update the password
        $query = "UPDATE USERS SET userName = ?, email = ?, password = ?, socialHandle = ?, phone = ? WHERE userId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssss", $userName, $email, $hashedPassword, $socialHandle, $phone, $userId);
        $stmt->execute();
        $stmt->close();
    }

    //check if the user has updated his email
    if($updatedEmail == true){
        //deactivate the user account
        $query = "UPDATE USERS SET emailActivation = 0 WHERE userId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $stmt->close();

        //get the activation key
        $query = "SELECT activationKey FROM USERS WHERE userId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $stmt->bind_result($key);
        $stmt->fetch();
        $stmt->close();

        require_once "../phpComponents/prepareEmail.php";
        //send the actual email
        sendEmail($key, $email);

        //log the user out
        $cookie_name = 'keepLogged';
        if(isset($_COOKIE[$cookie_name])){
            unset($_COOKIE[$cookie_name]);
            // empty value and expiration one hour before
            $res = setcookie($cookie_name, '', time() - 3600, '/');
        }
        //delete the session
        session_destroy();

        //redirect the user to index
        header("Location: ../index");
    }

    //return to the settings page
    header("Location: ../settings");
?>