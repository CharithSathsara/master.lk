<?php

class gamifiedQuestionsController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }


    public function getGamifiedQuestions($subject,$lesson,$topic){

        $data = GamifiedQuestion::getGamifiedQuestions($this->connection,$subject,$lesson,$topic);

        if($data){
            return $data;
        }else{
            return false;
        }

    }


}

?>