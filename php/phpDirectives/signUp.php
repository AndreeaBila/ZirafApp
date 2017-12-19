<?php
    //file needed to input the user data into the database and thus create the user account

    //create a database connection
    require_once "../phpComponents/databaseConnection.php";
    $db = createConnection();
    //get the user dependecy
    require_once "../phpComponents/dependencies.php";
    //get the user data from the client and check for xss attacks
    $userData = array("userName" => strip_tags(stripslashes($_POST['signupName'])),
                      "email" => strip_tags(stripslashes($_POST['signupEmail'])),
                      "password" => strip_tags(stripslashes($_POST['signupPassword'])),
                      "socialHandle" => strip_tags(stripslashes($_POST['signupUsername'])),
                      "description" => strip_tags(stripslashes($_POST['signupDescription'])),
                      "phone" => strip_tags(stripslashes($_POST['signupPhoneNumber'])),
                      "rank" => "Baby Zirafer",
                      "dateJoined" => date("Y-m-d"));
    //verify provided email address
    if(filter_var($userData['email'], FILTER_VALIDATE_EMAIL) === false){
        die("Error with email");
    }
    //create salt
    $userData["salt"] = sha1(time());
    //create activation key
    $userData["activationKey"] = sha1(time() . time());
    //hash password
    $userData["password"] = sha1($userData['password'] . $userData['salt']);
    //cookie hash
    $userData["cookie"] = sha1(time() . time() . time());
    //create insert statement
    $query = "INSERT INTO USERS VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 0, 0, ?, ?, 0, 0, ?, ?)";
    //create statement
    $stmt = $db->prepare($query);
    $stmt->bind_param("sssssssssss", $userData['userName'], $userData['email'], $userData['password'], $userData['socialHandle'], $userData['description'], $userData['phone'], $userData['rank'], $userData['salt'], $userData['activationKey'], $userData['cookie'], $userData['dateJoined']);
    $stmt->execute() or die("An error has occured");
    $stmt->close();

    //get the user file
    manageFileUpload($db, $userData);

    //send email to user address
    $subject = "ZirafApp activation key";
    $token = $userData['activationKey'];
    $message= "Hello, please click on the following link to activate your account: zirafers.zirafapp.com?token=$token";
    //====== REMEMBER TO ACTIVATE ======
    //mail($userData['email'], $subject, $message);

    header("Location: ../signupResult.php");


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
                    setDefaultIcon($db, $userData['email']);
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
            $ext = $info['extension']; // get the extension of the file
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
            die($e->getMessage());
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

    function setDefaultIcon($db, $userEmail){
        //get the id of the current user
        $userId = getUserId($db, $userEmail);
        //copy the default picture into userIcons
        copy('../../img/default.jpeg', '../../img/userIcons/'.$userId.'.jpeg');
    }
?>