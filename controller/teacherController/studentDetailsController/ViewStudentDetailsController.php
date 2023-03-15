<?php

include('../../../config/app.php');
include('../../../model/Teacher.php');
include('../../../model/Subject.php');

class ViewStudentDetailsController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getAllStudents(){

        try {
            $data = Teacher::getAllStudents($this->connection);
            if ($data) {
                return $data;
            } else {
                throw new Exception("No students found");
            }
        } catch (Exception $e) {
            $errorMessage = "Error in ViewStudentDetailsController::getAllStudents: " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
        }

    }

    public function getStudentSubjects($studentId){

        try {
            $data = Teacher::getStudentSubjects($this->connection, $studentId);
            if ($data) {
                return $data;
            } else {
                throw new Exception("No subjects found for student with ID $studentId");
            }
        } catch (Exception $e) {
            $errorMessage = "Error in ViewStudentDetailsController::getStudentSubjects: " . $e->getMessage();
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

}

?>