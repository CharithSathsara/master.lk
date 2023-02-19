<?php

include('../../../config/app.php');
include('../../../model/Teacher.php');
include('../../../model/Topic.php');

class ViewQuestionsController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function viewQuestions($subject, $topic, $type){

        try {
            $data = Teacher::viewQuestions($this->connection, $subject, $topic, $type);

            if($data){
                return $data;
            }else{
                throw new Exception("Error: can not get questions of $subject subject : topic $topic : type $type");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while getting questions of $subject subject : topic $topic : type $type:  " . $e->getMessage();
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


}

?>