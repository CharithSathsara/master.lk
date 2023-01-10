<?php

class Teacher{

    public static function addQuestion($question, $answer1, $answer2, $answer3, $answer4, $answer5,
                                       $correctAnswer, $answerDescription, $type, $subject, $topicId, $teacherId, $connection){

        $query = "INSERT INTO `question` (`questionId`, `question`, `opt01`, `opt02`, `opt03`, `opt04`, `opt05`, 
                                          `correctAnswer`, `answerDescription`, `questionType`, `topicId`, `teacherId`, `subjectId`) 
                  VALUES (NULL, '$question', '$answer1', '$answer2', '$answer3', '$answer4', '$answer5', $correctAnswer, 
                          '$answerDescription', '$type', 
                          $topicId, 
                          $teacherId,
                          (SELECT subjectId From subject WHERE subjectTitle = '$subject'))";
        $data = $connection->query($query);

        return $data;

    }

    public static function deleteQuestion($connection, $question_id){

        $query = "DELETE FROM question WHERE questionId = $question_id";
        $data = $connection->query($query);

        return $data;
    }

    public static function viewQuestions($connection, $subject, $topic, $type){

        $query = "SELECT * FROM question WHERE subjectId = (SELECT subjectId From subject WHERE subjectTitle = '$subject') 
                                         AND topicId = (SELECT topicId From topic WHERE topicTitle = '$topic') 
                                         AND questionType = '$type'";

        $data = $connection->query($query);

        return $data;

    }

    public static function getTeacherSubject($connection, $teacherId){

        $query = "SELECT subjectTitle FROM subject WHERE subjectId = (SELECT subjectId FROM teacher WHERE teacherId = $teacherId)";

        $data = $connection->query($query);

        $subject = $data->fetch_assoc();

        if($subject){
            return $subject['subjectTitle'];
        }else{
            return false;
        }

    }

}