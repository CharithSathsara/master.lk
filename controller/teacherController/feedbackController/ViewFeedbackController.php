<?php

include('../../../config/app.php');
include('../../../model/Teacher.php');
include('../../../model/Student.php');
include('../../../model/Subject.php');
include('../../../model/Lesson.php');

class ViewFeedbackController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getAllFeedbacks(){

        try {
            $data = Teacher::getAllFeedbacks($this->connection);
            if ($data) {
                return $data;
            } else {
                throw new Exception("No feedbacks found");
            }
        } catch (Exception $e) {
            $errorMessage = "Error in ViewFeedbackController::getAllFeedbacks: " . $e->getMessage();
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

    public function getLesson($lessonId){

        try {
            $data = Lesson::getLesson($this->connection, $lessonId);
            if($data){
                return $data;
            }else{
                throw new Exception("Error: Lesson not found for lesson ID: " . $lessonId);
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while fetching lesson : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
    }

    public function getSubjectTitle($subjectId){

        try {
            $data = Subject::getSubjectTitle($this->connection, $subjectId);
            if($data){
                return $data;
            }else{
                throw new Exception("Error: Subject title not found for subject ID: " . $subjectId);
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while fetching subject title: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }
    }

    public function getDateTimeDifference($insertedTime){

        try {

            date_default_timezone_set('Asia/Colombo');
            $currentTime = strtotime(date('Y-m-d H:i:s'));
            $insertedTime = strtotime($insertedTime);
            $timeDiff = $currentTime - $insertedTime;

            if ($timeDiff < 0) {
                throw new Exception("Error: Inserted time is in the future.");
            }

            $days = floor($timeDiff / 86400);
            $hours = floor(($timeDiff % 86400) / 3600);

            // return DateTimeDifference as a string
            if ($days > 0) {
                return "[ ".$days." Days Ago ]";
            } else {
                if ($hours == 0) {
                    return "[ Recently ]";
                }
                return "[ ".$hours." Hours Ago ]";
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}

?>