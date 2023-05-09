<?php

class subjectController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }


    public function getSubjectPrice($subject){

        $data = Subject::getSubjectPrice($this->connection,$subject);

        if($data){
            return $data;
        }

    }

    public function getSubjectDescription($subject){

        $data = Subject::getSubjectDescription($this->connection,$subject);

        if($data){
            return $data;
        }

    }

}

?>