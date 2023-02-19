<?php

class subjectController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }


    public function getSubjectPrice($subject){

        $data = Subject::getSubjectPrice($this->connection,$subject);

        if($data){
            return $data;
        }

    }

}

?>