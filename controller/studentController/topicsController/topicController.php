<?php

class topicController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
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