<?php

class timeUsageController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getTimes(){

        $data = Student::getTimes($this->connection);

        if($data){
            return true;
        }else{
            return false;
        }

    }



}



?>
