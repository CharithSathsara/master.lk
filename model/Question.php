<?php

<<<<<<< HEAD
class Question {

    /**
     * Author:
     * @author Charith Sathsara
     */
    public static function getCountOfAllQuestions($connection){

        try {
            $query = "SELECT COUNT(questionId) as questionCount FROM question";
            $data = $connection->query($query);
            $count = $data->fetch_assoc();

            if($count){
                return $count['questionCount'] + 1000;
            }else{
                throw new Exception("Error: Unable to count questions");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while counting questions in getCountOfAllQuestions(): " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
=======
class Question{

    public static function getCountOfAllQuestions($connection){

        $query = "SELECT COUNT(questionId) as questionCount FROM question";
        $data = $connection->query($query);
        $count = $data->fetch_assoc();

        return $count['questionCount'] + 1000;
>>>>>>> origin/master

    }

    public static function getNoOfQuestions($connection, $subject){

<<<<<<< HEAD
        try {
            $query = "SELECT COUNT(questionId) as questionCount FROM question 
                  WHERE subjectId = (SELECT subjectId From Subject WHERE subjectTitle = '$subject')";

            $data = $connection->query($query);
            $count = $data->fetch_assoc();

            if($count){
                return $count['questionCount'] + 500;
            }else{
                throw new Exception("Error: Unable to count questions");
            }
        } catch (Exception $e) {
            $errorMessage = "An error occurred while counting questions in getNoOfQuestions(): " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
=======
        $query = "SELECT COUNT(questionId) as questionCount FROM question 
                  WHERE subjectId = (SELECT subjectId From Subject WHERE subjectTitle = '$subject')";

        $data = $connection->query($query);
        $count = $data->fetch_assoc();

        return $count['questionCount'] + 500;
>>>>>>> origin/master

    }


}