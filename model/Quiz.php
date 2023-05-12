<?php

class Quiz
{

    /**
     * Author:
     * @author Charith Sathsara
     */

    public static function getNoOfAttendees($connection)
    {

        try {

            $query = "SELECT COUNT(DISTINCT studentId) as studentCount FROM quiz_details";
            $data = $connection->query($query);
            $attendees = $data->fetch_assoc();

            if ($attendees) {
                return $attendees['studentCount'] + 1000;
            } else {
                throw new Exception("Error: No quiz details found");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching no of attendees: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
    }

    public static function getNoOfQuizAttendees($connection, $subject)
    {

        try {

            $query01 = "SELECT lessonId FROM lesson
                  WHERE subjectId = (SELECT subjectId FROM subject WHERE subjectTitle = '$subject')";

            $data01 = $connection->query($query01)->fetch_assoc();
            $lessonIds = $data01['lessonId'];

            $query02 = "SELECT COUNT(DISTINCT studentId) as studentCount FROM quiz_details 
                  WHERE topicId IN (SELECT topicId FROM topic WHERE lessonId IN ($lessonIds))";

            $data02 = $connection->query($query02);
            $attendeesCount = $data02->fetch_assoc();

            if ($attendeesCount) {
                return $attendeesCount['studentCount'] + 500;
            } else {
                throw new Exception("Error: No quiz details found");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching quiz details : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
    }

    public static function getALlQuizDetails($connection, $topic, $type)
    {

        try {

            $query = "SELECT * FROM quiz_details WHERE quizType = '$type' 
                      AND topicId = (SELECT topicId From topic WHERE topicTitle = '$topic')";
            $data = $connection->query($query);

            if ($data) {
                return $data;
            } else {
                throw new Exception("Error: No quiz details found");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while fetching quiz details: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
    }

    public static function getModelQuizQuestions($topicId, $connection)
    {

        $sql = "SELECT * FROM question WHERE topicId = '$topicId' AND questionType = 'MODELQUESTION' ORDER BY RAND() LIMIT 10";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Create an empty array to store the data
            // $questions = $result->fetch_assoc();

            // Initialize an empty array to store the query result
            $rows = array();

            // Fetch each row from the result set and add it to the array
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }

            $_SESSION['model_question_array'] = $rows;

            return $result;
        }
    }

    public static function setUserModelQuizChoices($selectedChoice, $modelQuizId, $connection)
    {

        $insert = "INSERT INTO `quiz_answers`(`quizId`, `answer01`, `answer02`, `answer03`, `answer04`, `answer05`, `answer06`, `answer07`, `answer08`, `answer09`, `answer10`) VALUES ('$modelQuizId','$selectedChoice[0]','$selectedChoice[1]','$selectedChoice[2]','$selectedChoice[3]','$selectedChoice[4]','$selectedChoice[5]','$selectedChoice[6]','$selectedChoice[7]','$selectedChoice[8]','$selectedChoice[9]')";
        $data = $connection->query($insert);

        return $data;
    }

    public static function setUserModelQuizQuestions($modelQuizQuestions, $modelQuizId, $connection)
    {
        $question = array_column($modelQuizQuestions, 0);

        $insert = "INSERT INTO `quiz_questions`(`quizId`, `questionId1`, `questionId2`, `questionId3`, `questionId4`, `questionId5`, `questionId6`, `questionId7`, `questionId8`, `questionId9`, `questionId10`) VALUES ('$modelQuizId','$question[0]','$question[1]','$question[2]','$question[3]','$question[4]','$question[5]','$question[6]','$question[7]','$question[8]','$question[9]')";
        $data = $connection->query($insert);

        return $data;
    }

    public static function setModelQuizDetails($topicId, $studentId, $modelQuizScore, $connection)
    {
        //Check the attempt of the User
        $sql = "SELECT attempts FROM quiz_details  WHERE topicId = '$topicId' AND questionType = 'MODELQUESTION' AND  studentId = '$studentId'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $num_rows = mysqli_num_rows($result);
            $num_rows += 1;
        } else {
            $num_rows = 1;
        }


        $insert = "INSERT INTO `quiz_details`(`quizId`, `score`, `date`, `time`, `quizType`, `attempts`, `studentId`, `topicId`) 
        VALUES ('','$modelQuizScore',NOW(),NOW(),'MODELPAPER','$num_rows','$studentId','$topicId')
        ";
        $data = $connection->query($insert);

        if ($data) {
            $sqlSelect = "SELECT quizId FROM quiz_details  WHERE attempts =1 AND studentId = '$studentId'";
            $dataSelect = $connection->query($sqlSelect);

            $modelQuizId =  $dataSelect['quizId'];

            $selectedChoice = $_SESSION['selectedAnsArray'];
            $results = Quiz::setUserModelQuizChoices($selectedChoice, $modelQuizId, $connection);

            $modelQuizQuestions = $_SESSION['model_question_array'];
            $results = Quiz::setUserModelQuizQuestions($modelQuizQuestions, $modelQuizId, $connection);
        }
        return $data;
    }

    public static function getPpQuizQuestions($topicId, $connection)
    {

        $sql = "SELECT * FROM question WHERE topicId = '$topicId' AND questionType = 'PASTQUESTION' ORDER BY RAND() LIMIT 10";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Create an empty array to store the data
            // $questions = $result->fetch_assoc();

            // Initialize an empty array to store the query result
            $rows = array();

            // Fetch each row from the result set and add it to the array
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }

            $_SESSION['pp_question_array'] = $rows;

            return $result;
        }
    }




    //Function to get all the quizzes done by the current user of the given type of the given lesson

    public static function getQuizzesList($connection, $lesson, $topic, $type)
    {

        $userId = $_SESSION['auth_user']['userId'];

        $query2 = "SELECT lessonId FROM lesson WHERE lessonName='$lesson'";
        $result2 = $connection->query($query2);
        $data_set2 = $result2->fetch_assoc();
        $lessonId = $data_set2['lessonId'];

        $query3 = "SELECT topicId FROM topic WHERE topicTitle='$topic' AND lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        $data_set3 = $result3->fetch_assoc();
        $topicId = $data_set3['topicId'];

        $query1 = "SELECT quiz_details.* FROM quiz_details INNER JOIN topic ON quiz_details.topicId=topic.topicId
                WHERE topic.lessonId='$lessonId' AND quiz_details.topicId='$topicId' AND quiz_details.studentId='$userId' AND quiz_details.quizType='$type'
                ORDER BY quiz_details.quizId ASC";
        $result1 = $connection->query($query1);

        if (mysqli_num_rows($result1) > 0) {
            return $result1;
        } else {
            return false;
        }
    }

    //Function to get the questions,answers and descriptions of the given quiz

    public static function getQuestions($connection, $lesson, $topic, $type, $attempt)
    {

        $userId = $_SESSION['auth_user']['userId'];

        $query2 = "SELECT lessonId FROM lesson WHERE lessonName='$lesson'";
        $result2 = $connection->query($query2);
        $data_set2 = $result2->fetch_assoc();
        $lessonId = $data_set2['lessonId'];

        $query3 = "SELECT topicId FROM topic WHERE topicTitle='$topic' AND lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        $data_set3 = $result3->fetch_assoc();
        $topicId = $data_set3['topicId'];

        $query1 = "SELECT quiz_details.* FROM quiz_details INNER JOIN topic ON quiz_details.topicId=topic.topicId
                WHERE topic.lessonId='$lessonId' AND quiz_details.topicId='$topicId' AND quiz_details.studentId='$userId' AND quiz_details.quizType='$type'
                AND quiz_details.attempts='$attempt'";
        $result1 = $connection->query($query1);
        $data_set1 = $result1->fetch_assoc();
        $quizId = $data_set1['quizId'];

        //Get answers of the questions

        $query6 = "SELECT * FROM quiz_answers WHERE quizId='$quizId'";
        $result6 = $connection->query($query6);
        $data_set6 = $result6->fetch_assoc();

        $answers = array();

        for ($i = 1; $i < 11; $i++) {
            $index = 'answer' . $i;
            $answers[] = $data_set6[$index];
        }

        $_SESSION['quiz_answers'] = $answers;

        //Get questions relavant to the given quiz

        $query4 = "SELECT * FROM quiz_questions WHERE quizId='$quizId'";
        $result4 = $connection->query($query4);
        $data_set4 = $result4->fetch_assoc();

        $questionIdList = array();

        for ($i = 1; $i < 11; $i++) {
            $q = 'questionId' . $i;
            $questionIdList[] = $data_set4[$q];
        }

        $idList = implode(',', $questionIdList);

        $query5 = "SELECT * FROM question WHERE questionId IN ($idList)";
        $result5 = $connection->query($query5);

        if ($result5 && mysqli_num_rows($result5) > 0) {
            return $result5;
        } else {
            return false;
        }
    }
}