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



//Set Question Number
$questionNumber = (int) $_GET['n'];
$_SESSION['topicId'] = 2;


$modelQuizController = new ModelQuizController();
$result = $modelQuizController->getModelQuizQuestions($_SESSION['topicId']);

// Initialize an empty array to store the query result
$rows = array();

// Fetch each row from the result set and add it to the array
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

$_SESSION['model_question_array'] = $rows;

$questions = $result->fetch_assoc();

?>


    