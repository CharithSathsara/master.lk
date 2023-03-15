<?php

class studentSubjectController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function hasBought($subject){

        $data = Student::hasBought($this->connection,$subject);

        if($data){
            return true;
        }else{
            return false;
        }

    }
}

?>