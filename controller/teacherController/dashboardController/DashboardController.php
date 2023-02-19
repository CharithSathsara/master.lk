<?php

class DashboardController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function getCountOfAllQuestions(){

<<<<<<< HEAD
        try {
            $data = Question::getCountOfAllQuestions($this->connection);
            if($data){
                return $data;
            }else{
                throw new Exception("Error: Questions not found");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while count all questions " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
=======
        $data = Question::getCountOfAllQuestions($this->connection);

        if($data){
            return $data;
>>>>>>> origin/master
        }

    }

    public function getNoOfQuestions($subject){

<<<<<<< HEAD
        try {
            $data = Question::getNoOfQuestions($this->connection, $subject);
            if($data){
                return $data;
            }else{
                throw new Exception("Error: Questions not found");
            }
        } catch(Exception $e) {
            $errorMessage = "An error occurred while count no of questions for subject $subject : " . $e->getMessage();
            echo '<script>console.error("' . $errorMessage . '")</script>';
            return false;
=======
        $data = Question::getNoOfQuestions($this->connection, $subject);

        if($data){
            return $data;
>>>>>>> origin/master
        }

    }

}

?>