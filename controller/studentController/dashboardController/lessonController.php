<?php

class lessonController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function getLessons($subject){

        $data = Lesson::getLessons($this->connection,$subject);

        if($data){
            return true;
        }else{
            return false;
        }

    }



}

?>