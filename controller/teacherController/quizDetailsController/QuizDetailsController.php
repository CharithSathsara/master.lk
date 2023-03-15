<?php

include('../../../model/Quiz.php');
include('../../../model/Topic.php');
include('../../../model/Student.php');

class QuizDetailsController {

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getNoOfAttendees(){

        try {

            $data = Quiz::getNoOfAttendees($this->connection);
            if($data){
                return $data;
            }else{
                throw new Exception("Error: can not get no of attendees for quizzes");
            }

        } catch(Exception $e) {

            $errorMessage = "An error occurred while getting no of attendees:  " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;

        }

    }

    public function getNoOfQuizAttendees($subject){

        try {

            $data = Quiz::getNoOfQuizAttendees($this->connection, $subject);
            if($data){
                return $data;
            }else{
                throw new Exception("Error: can not get no of attendees for quizzes");
            }

        } catch(Exception $e) {

            $errorMessage = "An error occurred while getting no of quiz attendees:  " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;

        }

    }

    public function getAllTopics($subject){

        try {

            $data = Topic::getAllTopics($this->connection, $subject);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: can not get all topics of $subject subject");
            }

        } catch(Exception $e) {

            $errorMessage = "An error occurred while getting all topics:  " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;

        }

    }

    public function getAllQuizDetails($topic, $type){

        try {

            $data = Quiz::getALlQuizDetails($this->connection, $topic, $type);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: can not get quiz details for topic $topic");
            }

        } catch(Exception $e) {

            $errorMessage = "An error occurred while getting quiz details for topic $topic:  " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;

        }

    }

    public function getStudentName($studentId){

        try {
            $data = Student::getStudentName($this->connection, $studentId);
            if ($data) {
                return $data;
            } else {
                throw new Exception("No student found");
            }
        } catch (Exception $e) {
            $errorMessage = "Error in ViewFeedbackController::getStudentName: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

}

?>