<?php

include('../../config/app.php');
require_once('../../model/ForumQuestion.php');
require_once('../../model/User.php');

// Set the response headers to indicate that the response is JSON
header('Content-Type: application/json');

// Handle the POST request to create a new question
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the question text and topicId from the request body
    $question_text = $_POST['question'];
    $topicId = $_POST['topicId'];

    if (!empty($db_connection)) {

        $data = ForumQuestion::insertQuestion($db_connection->getConnection(), $question_text, $_SESSION['auth_user']['userId'], $topicId);

        if($data) {
            // Return successful response
            echo json_encode(array('success' => true));
        }else {
            // Return unsuccessful response
            echo json_encode(array('success' => false));
        }

    }
}

// Handle the GET request to retrieve all questions and answers
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Get all the questions and their answers from the database
    $questions = array();
    $data = ForumQuestion::getForumQuestions($db_connection->getConnection());

    while ($question = $data->fetch_assoc()) {

        $answers = array();
        $questionAnswers = ForumQuestion::getQuestionAnswers($db_connection->getConnection(), $question['question_id']);

        while ($answer = $questionAnswers->fetch_assoc()) {

            // Add the details to the answer array
            $answer['teacher'] = User::getUserName($db_connection->getConnection(), $answer['teacherId']);
            $answers[] = $answer;
        }

        // Add the details to the question array
        $question['student'] = User::getUserName($db_connection->getConnection(), $question['studentId']);

        $details = ForumQuestion::getDetails($db_connection->getConnection(), $question['topicId']);
        $question['subject'] = $details['subjectTitle'];
        $question['lesson'] = $details['lessonName'];
        $question['topic'] = $details['topicTitle'];

        $question['answers'] = $answers;
        $questions[] = $question;

    }

    // Return the questions and answers as a JSON response
    echo json_encode($questions);
}


