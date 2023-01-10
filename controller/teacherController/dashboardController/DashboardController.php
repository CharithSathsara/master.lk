<?php

class DashboardController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function getCountOfAllQuestions(){

        $data = Question::getCountOfAllQuestions($this->connection);

        if($data){
            return $data;
        }

    }

    public function getNoOfQuestions($subject){

        $data = Question::getNoOfQuestions($this->connection, $subject);

        if($data){
            return $data;
        }

    }

}

?>