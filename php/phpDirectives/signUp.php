<?php
    session_start();
    //file needed to input the user data into the database and thus create the user account

    //create a database connection
    require_once "../phpComponents/databaseConnection.php";
    $db = createConnection() or terminateSignup("Unable to connect to database");
    //get the user dependecy
    require_once "../phpComponents/dependencies.php";
    //get the user data from the client and check for xss attacks
    $userData = array("userName" => strip_tags(stripslashes($_POST['signupName'])),
                      "email" => strip_tags(stripslashes($_POST['signupEmail'])),
                      "password" => strip_tags(stripslashes($_POST['signupPassword'])),
                      "socialHandle" => strip_tags(stripslashes($_POST['signupUsername'])),
                      "description" => strip_tags(stripslashes($_POST['signupDescription'])),
                      "phone" => strip_tags(stripslashes($_POST['signupPhoneNumber'])),
                      "rank" => "Newbie",
                      "dateJoined" => date("Y-m-d"));
    //verify provided email address
    if(!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)){
        terminateSignup("The provided email address is not correct");
    }
    //create salt
    $userData["salt"] = sha1(time());
    //create activation key
    $userData["activationKey"] = sha1(time() . time());
    //hash password
    $userData["password"] = sha1($userData['password'] . $userData['salt']);
    //cookie hash
    $userData["cookie"] = sha1(time() . time() . time());

    
    require_once "../phpComponents/prepareEmail.php";
    $keyContainer = $userData['activationKey'];
    $emailContainer = $userData['email'];
    sendEmail($keyContainer, $emailContainer);

    //get the user file
    manageFileUpload($db, $userData);

    //insert user into the default chat: All Zirafers
    //create a new record in the user_chats table between the current user and the all zirafers chat
    //get the userId of the current user
    $userId = getUserId($db, $userData['email']);
    $date = date("Y-m-d");
    $insertRecord = "INSERT INTO USER_CHATS VALUES(?, 1, ?)";
    $stmt = $db->prepare($insertRecord);
    $stmt->bind_param("ss", $userId, $date);
    $stmt->execute();
    $stmt->close();
    //don't execute the statemetn now and wait for the file upload
    terminateSignup("<h4 style='margin-bottom: 20px;'>Thank you for joining our zirafers team! Once you confirm your email address (by clicking the link in the email we sent you) and your account is approved by an exec team member, you will be able to login. </h4><small>*If a long time passes and your account is not approved, please contact an exec team member</small><br><small>*The confirmation email sometimes ends up in the spam folder, so be sure to check it out.</small>");


    function manageFileUpload($db, $userData){
        try {            
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['signupProfilePictureBtn']['error']) ||
                is_array($_FILES['signupProfilePictureBtn']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }
        
            // Check $_FILES['signupProfilePictureBtn']['error'] value.
            switch ($_FILES['signupProfilePictureBtn']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    //if no file has been sent select a new one
                    setDefaultIcon($db, $userData['email'], $userData);
                    return;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            
            // DO NOT TRUST $_FILES['signupProfilePictureBtn']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['signupProfilePictureBtn']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }
            
            $info = pathinfo($_FILES['signupProfilePictureBtn']['name']);
            $ext = $info['extension']; // get the extension of the files
            //create insert statement
            $query = "INSERT INTO USERS VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 0, 0, ?, ?, ?, 0, 0, ?, ?)";
            //create statement
            $stmt = $db->prepare($query);
            $stmt->bind_param("ssssssssssss", $userData['userName'], $userData['email'], $userData['password'], $userData['socialHandle'], $userData['description'], $userData['phone'], $userData['rank'], $ext, $userData['salt'], $userData['activationKey'], $userData['cookie'], $userData['dateJoined']);
            $stmt->execute() or terminateSignup("Error occured while saving the data");
            $stmt->close();
            $newname = getUserId($db, $userData['email']).'.'.$ext;
            $target = '../../img/userIcons/'.$newname;
            // You should name it uniquely.
            // DO NOT USE $_FILES['signupProfilePictureBtn']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            if (!move_uploaded_file(
                $_FILES['signupProfilePictureBtn']['tmp_name'],
                    $target
                )
            ) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
        } catch (RuntimeException $e) {
            terminateSignup($e->getMessage());
        }
    }

    function getUserId($db, $userEmail){
        $query = "SELECT max(userId) FROM USERS WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        return $result;
    }

    function setDefaultIcon($db, $userEmail, $userData){
        //create insert statement
        $query = "INSERT INTO USERS VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 0, 0, ?, ?, ?, 0, 0, ?, ?)";
        $ext = "jpeg";
        //create statement
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssssssssss", $userData['userName'], $userData['email'], $userData['password'], $userData['socialHandle'], $userData['description'], $userData['phone'], $userData['rank'], $ext, $userData['salt'], $userData['activationKey'], $userData['cookie'], $userData['dateJoined']);
        $stmt->execute() or die("Error occured while saving the data");
        $stmt->close();
        //get the id of the current user
        $userId = getUserId($db, $userEmail);
        //copy the default picture into userIcons
        copy('../../img/default.jpeg', '../../img/userIcons/'.$userId.'.jpeg');
    }

    function terminateSignup($exitMessage){
        //cache the message
        $_SESSION['exitMessage'] = $exitMessage;
        //redirect the user
        header("Location: ../signupResult");
    }
?>