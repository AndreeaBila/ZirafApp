<?php
    function checkRequestType(){
        define('AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
        if(!AJAX_REQUEST) {die("Error");}
    }
?>