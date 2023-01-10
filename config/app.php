<?php

session_start();
include_once('DatabaseConnection.php');
$db_connection =  new DatabaseConnection();

const SITE_URL = 'http://localhost/master.lk/';

/*
meaning of slug

COMPUTING
a part of a URL which identifies a particular page on a website
in a form readable by users.
*/

function base_url($slug){

    //SITE_URL.$slug concatenating
    echo SITE_URL.$slug;
}

function validateInput($connection, $input){
    return mysqli_real_escape_string($connection, $input);
}

function redirect($message, $page){

    $redirectTo = SITE_URL.$page;

    $_SESSION['message'] = "$message";
    header("Location: $redirectTo");
    exit(0);
}

?>
