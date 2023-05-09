<?php

class progressController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function hasStarted($lesson){

        $data = Lesson::hasStarted($this->connection,$lesson);

        if($data){
            return $data;
        }else{
            return false;
        }

    }

    public function getTopicsOfLesson($lesson){

        $data = Topic::getTopicsOfLesson($this->connection,$lesson);

        if($data){
            return $data;
        }else{
            return false;
        }

    }

    public function getLessonProgress($lesson,$type){

        $data = Lesson::getLessonProgress($this->connection,$lesson,$type);

        if($data){
            return true;
        }else{
            return false;
        }

    }



}



?>
