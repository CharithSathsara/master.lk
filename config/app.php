<?php

session_start();
include_once('DatabaseConnection.php');
$db_connection = DatabaseConnection::getInstance();

const SITE_URL = 'http://localhost/master.lk/';

function base_url($slug){
    // SITE_URL.$slug concatenating
    echo SITE_URL.$slug;
}

function validateInput($connection, $input){
    return mysqli_real_escape_string($connection, $input);
}

function esc($word){
    return addslashes($word);
}

function redirect($message, $page){

    $redirectTo = SITE_URL.$page;

    $_SESSION['message'] = "$message";
    header("Location: $redirectTo");
    exit(0);
}

function login_error_redirect($message, $page){

    $redirectTo = SITE_URL.$page;

    $_SESSION['login-error-message'] = "$message";
    header("Location: $redirectTo");
    exit(0);
}

function signup_error_redirect($message, $page){

    $redirectTo = SITE_URL.$page;

    $_SESSION['signup-error-message'] = "$message";
    header("Location: $redirectTo");
    exit(0);
}

function restrict_access_redirect($message, $page){

    $redirectTo = SITE_URL.$page;

    $_SESSION['restrict-error-message'] = "$message";
    header("Location: $redirectTo");
    exit(0);
}

function popup_redirect($message, $page){

    $redirectTo = SITE_URL.$page;

    $_SESSION['popup-message'] = "$message";
    header("Location: $redirectTo");
    exit(0);
}


function verify_email_error_redirect($message, $page){

    $redirectTo = SITE_URL.$page;

    $_SESSION['verify-email-error'] = "$message";
}

function session_expire_redirect($message, $page){

    $redirectTo = SITE_URL.$page;

    $_SESSION['session_expire_message'] = "$message";

    header("Location: $redirectTo");
    exit(0);
}

// Set the session timeout period (30 minutes)
$timeout_duration = 1800; 

// Check if the session has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout_duration)) {

    if(isset($_SESSION['authenticated']) === TRUE){
        if($_SESSION['auth_role'] == "TEACHER"){
            unset($_SESSION['subject']);
        }

        $userId = $_SESSION['auth_user']['userId'];
        $date = date('Y-m-d');

        unset($_SESSION['authenticated']);
        unset($_SESSION['auth_user']);
        unset($_SESSION['auth_role']);
        
        $sql = "SELECT * FROM daily_usage_times WHERE userId='$userId' AND date='$date'";
        $result = $db_connection->getConnection()->query($sql);
        $usage_time = $_SESSION['usage_time'];

        if (mysqli_num_rows($result) == 0) {

            // There is no existing row for this user and date, so insert a new row with the usage time
            $sql = "INSERT INTO daily_usage_times (userId, date, total_usage_time) VALUES ('$userId', '$date', $usage_time)";
            $db_connection->getConnection()->query($sql);
        } else{

            // There is an existing row for this user and date, so update the total usage time
            $row = mysqli_fetch_assoc($result);
            $total_usage_time = $row['total_usage_time'] + $usage_time;
            $sql = "UPDATE daily_usage_times SET total_usage_time='$total_usage_time' WHERE userId='$userId' AND date='$date'";
            $db_connection->getConnection()->query($sql);
        }
        session_expire_redirect("Your session has timed out. Please log in again.",'view/authentication/index.php');
    }
    
}

$_SESSION['last_activity'] = time();

// Check if the user is logged in
if (isset($_SESSION['authenticated'])) {

    $_SESSION['end_time'] = time();
    $usage_time = $_SESSION['end_time'] - $_SESSION['start_time'];
    $_SESSION['usage_time'] = $usage_time;

}

?>