<?php
    session_start();
    //get the database logic
    require_once "../phpComponents/databaseConnection.php";
    //get the post and user dependencies
    require_once "../phpComponents/dependencies.php";
    //create database connection
    $db = createConnection();

    //get the content of the description box
    $description = strip_tags(stripslashes($_POST['pictureTextarea']));
    //get the image and move it to the appropriate folder
    $fileName = manageFileUpload();

    //insert the data in the database

    //get the current date
    $dateCreated = date("Y-m-d");
    $query = "INSERT INTO IMAGE_UPLOADS VALUES(NULL, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sss", $fileName, $description, $dateCreated);
    $stmt->execute();
    $stmt->close();

    //get the image id
    $query = "SELECT MAX(imageId) AS currentImageId FROM IMAGE_UPLOADS";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $imageId = $row['currentImageId'];
    $userId = $_SESSION['userId'];

    //insert user connection
    $query = "INSERT INTO USER_IMAGES VALUES(?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $userId, $imageId);
    $stmt->execute();
    $stmt->close();

    //head back to the main page
    header("Location: ../newsfeed");


    function manageFileUpload(){
        try {
            
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['upfile']['error']) ||
                is_array($_FILES['upfile']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }
        
            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    //if no file has been sent select a new one
                    throw new RuntimeException('No file uploaded');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
        
            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['upfile']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Invalid file format.');
            }
            
            $info = pathinfo($_FILES['upfile']['name']);
            $ext = $info['extension']; // get the extension of the files
            $newname = $_SESSION['userId'] . '_' . $info['basename'];
            $target = '../../img/imageUploads/'.$newname;
            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            if (!move_uploaded_file(
                $_FILES['upfile']['tmp_name'],
                    $target
                )
            ) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            return $newname;
        } catch (RuntimeException $e) {
            die($e->getMessage());
        }
    }
?>