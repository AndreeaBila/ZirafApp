<?php
    //send email to user address
    $subject = "ZirafApp activation key";
    $token = $userData['activationKey'];
    $message= "Hello, please click on the following link to activate your account: <a href='http://zirafers.zirafapp.com/php/index?token=$token' target='_blank'>http://zirafers.zirafapp.com</a>";
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($userData['email'], $subject, $message, $headers) or doNothing();

    function doNothing(){}
?>