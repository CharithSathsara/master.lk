<?php

class quizReviewController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }


    public function getQuizzesList($lesson,$topic,$type){

        $data = Quiz::getQuizzesList($this->connection,$lesson,$topic,$type);

        if($data){
            return $data;
        }else{
            return false;
        }

    }

    public function getQuestions($lesson,$topic,$type,$attempt){

        $data = Quiz::getQuestions($this->connection,$lesson,$topic,$type,$attempt);

        if($data){
            return $data;
        }else{
            return false;
        }

    }


}

?>