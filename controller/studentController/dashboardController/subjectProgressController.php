<?php

class subjectProgressController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function getSubjectProgress($subject){

        $data = Student::getSubjectProgress($this->connection,$subject);

        if($data){
            return $data;
        }else{
            return false;
        }

    }
}

?>