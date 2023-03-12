<?php

class ForumQuestion {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function insertQuestion($connection, $question_text, $studentId, $topicId){

        try {
            $query = "INSERT INTO `forum_question` (`question_text`, `date_time`, `studentId`, `topicId`) 
                      VALUES ('$question_text', NOW(), $studentId, $topicId)";
            $data = $connection->query($query);

            if($data){
                return true;
            }else{
                throw new Exception("Error: Unable to insert forum question");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while inserting forum question in insertQuestion(): " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getForumQuestions($connection){

        try {
            $query = "SELECT * FROM forum_question";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to fetch forum questions");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while getting forum questions in getForumQuestions(): " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getQuestionAnswers($connection, $question_id){

        try {
            $query = "SELECT * FROM forum_answer WHERE question_id = $question_id";
            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: Unable to fetch question answers");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while getting question answers in getQuestionAnswers(): " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public static function getDetails($connection, $topicId){

        try {
            $query = "SELECT Topic.topicTitle, Lesson.lessonName, Subject.subjectTitle
                      FROM Topic
                      JOIN Lesson ON Topic.lessonId = Lesson.lessonId
                      JOIN Subject ON Lesson.subjectId = Subject.subjectId
                      WHERE Topic.topicId = $topicId";
            $data = $connection->query($query);
            $details = $data->fetch_assoc();

            if($details){
                return $details;
            }else{
                throw new Exception("Error: Unable to get details for id : $topicId");
            }

        } catch (Exception $e) {
            $errorMessage = "An error occurred while getting details : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

}