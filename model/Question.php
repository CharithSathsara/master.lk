<?php

class Question{

    public static function getCountOfAllQuestions($connection){

        $query = "SELECT COUNT(questionId) as questionCount FROM question";
        $data = $connection->query($query);
        $count = $data->fetch_assoc();

        return $count['questionCount'] + 1000;

    }

    public static function getNoOfQuestions($connection, $subject){

        $query = "SELECT COUNT(questionId) as questionCount FROM question 
                  WHERE subjectId = (SELECT subjectId From Subject WHERE subjectTitle = '$subject')";

        $data = $connection->query($query);
        $count = $data->fetch_assoc();

        return $count['questionCount'] + 500;

    }


}