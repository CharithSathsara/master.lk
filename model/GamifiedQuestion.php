<?php

class GamifiedQuestion
{

    public static function getGamifiedQuestions($connection, $subject, $lesson, $topic)
    {

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data_set1 = $result1->fetch_assoc();
        $subjectId = $data_set1['subjectId'];

        $query2 = "SELECT lessonId FROM lesson WHERE lessonName='$lesson' AND subjectId='$subjectId'";
        $result2 = $connection->query($query2);
        $data_set2 = $result2->fetch_assoc();
        $lessonId = $data_set2['lessonId'];

        $query3 = "SELECT topicId FROM topic WHERE topicTitle='$topic' AND lessonId='$lessonId'";
        $result3 = $connection->query($query3);
        $data_set3 = $result3->fetch_assoc();
        $topicId = $data_set3['topicId'];

        $query4 = "SELECT * FROM gamified_question WHERE lessonId='$lessonId' AND topicId='$topicId' ORDER BY questionId ASC";
        $result4 = $connection->query($query4);

        if ($result4 && mysqli_num_rows($result4) > 0) {
            return $result4;
        } else {
            return false;
        }
    }


    public static function getNewwGamifiedQuestions($connection, $topic)
    {


        $query = "SELECT topicId,lessonId FROM topic WHERE topicTitle='$topic';";
        $data = $connection->query($query);
        $data_set = $data->fetch_assoc();

        $topicId = $data_set['topicId'];
        $lessonId = $data_set['lessonId'];


        $query1 = "SELECT * FROM gamified_question WHERE topicId='$topicId' AND lessonId = '$lessonId' ORDER BY questionId ASC;";
        $result = $connection->query($query1);

        if ($result) {
            return $result;
        }
    }

    public static function getNewGamifiedQuestions($connection, $subject, $topic)
    {

        $query1 = "SELECT subjectId FROM subject WHERE subjectTitle='$subject'";
        $result1 = $connection->query($query1);
        $data_set1 = $result1->fetch_assoc();
        $subjectId = $data_set1['subjectId'];

        $query2 = "SELECT topicId, lessonId FROM topic WHERE topicTitle='$topic'";
        $result2 = $connection->query($query2);
        $data_set2 = $result2->fetch_assoc();
        $lessonId = $data_set2['lessonId'];
        $topicId = $data_set2['topicId'];


        $query3 = "SELECT * FROM gamified_question WHERE lessonId='$lessonId' AND topicId='$topicId' ORDER BY questionId ASC";
        $result3 = $connection->query($query3);

        if ($result3 && mysqli_num_rows($result3) > 0) {
            return $result3;
        } else {
            return false;
        }
    }

    public static function viewGamifiedQuestions($connection, $topic)
    {


        $query = "SELECT topicId,lessonId FROM topic WHERE topicTitle='$topic';";
        $data = $connection->query($query);
        $data_set = $data->fetch_assoc();

        $topicId = $data_set['topicId'];
        $lessonId = $data_set['lessonId'];


        $query1 = "SELECT * FROM gamified_question WHERE topicId='$topicId' AND lessonId = '$lessonId' ORDER BY questionId ASC;";
        $result = $connection->query($query1);

        if ($result) {
            return $result;
        }
    }


    public static function updateTheoryQuestion(
        $connection,
        $questionId,
        $question,
        $answer1,
        $answer2,
        $answer3,
        $answer4,
        $answer5,
        $correctAnswer
    ) {
        $query = "UPDATE gamified_question
        SET question = '$question', opt01 = '$answer1', opt02 = '$answer2', opt03 = '$answer3', opt04 = '$answer4', 
            opt05= '$answer5', correctAnswer = '$correctAnswer'
        WHERE questionId = '$questionId'";

        $data = $connection->query($query);

        if ($data) {
            return $data;
        }
    }
}