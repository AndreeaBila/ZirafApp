<?php
    //import the database file
    require_once "databaseConnection.php";
    //checks if the session has been set
    function checkSession(){
        return isset($_SESSION['userId']);
    }

    //returns the value of the cookie or false if the cookie has not been set
    function checkCookie(){
        if(isset($_COOKIE['keepLogged'])){
            //create a database connection
            $db = createConnection();
            $cookie = strip_tags(stripslashes($_COOKIE['keepLogged']));
            $query = "SELECT userId FROM USERS WHERE cookieHash = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("s", $cookie);
            $stmt->execute();
            $stmt->bind_result($userId);
            $stmt->fetch();
            $stmt->close();
            $_SESSION['userId'] = $userId;
            return true;
        }else{
            return false;
        }
    }

    //perform the authentication steps
    function authenticate(){
        //check if the cookie has been set
        if(!checkCookie()){
            //if the cookie has been set to false then directly check the session
            if(!checkSession()){
                header("Location: index");
            }
        }
    }

    //check the clearance level
    function checkClearance(){
        if(!checkSession()) return false;
        //create a new database connection
        $db = createConnection();
        //create query
        $query = "SELECT clearance FROM USERS WHERE userId = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $_SESSION['userId']);
        $stmt->execute();
        $stmt->bind_result($clearance);
        $stmt->fetch();

        return ($clearance == 1);
    }
?>