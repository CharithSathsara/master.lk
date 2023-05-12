<?php

include_once('../../../config/app.php');
include('../../../model/Quiz.php');

$_SESSION['topicId'] = 2;

$result = Quiz::getPpQuizQuestions($_SESSION['topicId'], $db_connection->getConnection());