<?php

class topicController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getTopics($subject,$lesson){

        $data = Topic::getTopics($this->connection,$subject,$lesson);

        if($data){
            return true;
        }else{
            return false;
        }

    }



}

?>