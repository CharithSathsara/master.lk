<?php

include_once('../../../config/app.php');
include('../../../model/Quiz.php');

$_SESSION['topicId'] = 2;

$studentId = $_SESSION['auth_user']['userId'];
$topicId = $_SESSION['topicId'];
$selectedArray = $_SESSION['selectedAnsArray'];

$result = Quiz::getModelQuizQuestions($topicId , $db_connection->getConnection());

if (isset($_SESSION['modelQuizPercentage'])) {
    $modelQuizScore = $_SESSION['modelQuizPercentage'];
    $result = Quiz::setModelQuizDetails( $topicId, $studentId ,$modelQuizScore, $db_connection->getConnection());
}