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

    //return to the settings page
    header("Location: ../settings");
?>