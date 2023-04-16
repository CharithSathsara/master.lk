<?php

class recommendationsController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getRecommendations(){

        $data = Student::getRecommendations($this->connection);

        if($data){
            return true;
        }else{
            return false;
        }

    }



}



?>
