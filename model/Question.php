<?php

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

    }

    public static function getNoOfQuestions($connection, $subject){

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

    }


}