<?php
    session_start();
    //file needed to input the user data into the database and thus create the user account
    //create a database connection
    require_once "../phpComponents/databaseConnection.php";
    $db = createConnection();
    //get the user dependecy
    require_once "../phpComponents/dependencies.php";
    //get the user Id
    $userId = $_SESSION['userId'];
    //update tag line
    $description = strip_tags(stripslashes($_POST['profileDescription']));
    $query = "UPDATE USERS SET description = ? WHERE userId = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $description, $userId);
    $stmt->execute();
    $stmt->close();

    //update the profile picture
    manageFileUpload($db);

    header("Location: ../profile");


    function manageFileUpload($db){
        try {            
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['changeProfilePicture']['error']) ||
                is_array($_FILES['changeProfilePicture']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }
        
            // Check $_FILES['changeProfilePicture']['error'] value.
            switch ($_FILES['changeProfilePicture']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    return;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            
            // DO NOT TRUST $_FILES['changeProfilePicture']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['changeProfilePicture']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }
            //delete previous profile picture
            $userId = $_SESSION['userId'];
            //get the extension
            $query = "SELECT iconExtension FROM USERS WHERE userId = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $userId);
            $stmt->execute();
            $stmt->bind_result($iconExtension);
            $stmt->fetch();
            $stmt->close();

            unlink("../../img/userIcons/$userId.$iconExtension");
            
            $info = pathinfo($_FILES['changeProfilePicture']['name']);
            $ext = $info['extension']; // get the extension of the files
            
            $newname = $_SESSION['userId'];
            $target = '../../img/userIcons/'.$newname.".".$ext;
            // You should name it uniquely.
            // DO NOT USE $_FILES['changeProfilePicture']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            if (!move_uploaded_file(
                $_FILES['changeProfilePicture']['tmp_name'],
                    $target
                )
            ) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            //update the icon extension
            $query = "UPDATE USERS SET iconExtension = ? WHERE userId = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("ss", $ext, $userId);
            $stmt->execute();
            $stmt->close();
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }
?>