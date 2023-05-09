<?php

include('../../../controller/studentController/quizController/modelQuizController.php');
include_once('../../../controller/authController/authentication/Authentication.php');
include_once('../../../controller/authController/authorization/Authorization.php');

//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

$total_question = 10;
echo $total_question;


// if(!isset($_SESSION ["quiz_end_time"])){
// echo "00:00:00";
// }
// else{
// $quiztime = gmdate("C",strtotime($_SESSION["quiz_end_time"]) - strtotime(date("Y-m-d H:i:s")));
//     if(strtotime($_SESSION["quiz_end_time"]) < strtotime(date("Y-m-d H:i:s"))){
//     echo "00:00:00";
//     }
//     else{
//     echo $quiztime;
//     }
// }



?>