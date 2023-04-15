<?php

class lessonController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getLessons($subject){

        $data = Lesson::getLessons($this->connection,$subject);

        if($data){
            return;
        }else{
            return false;
        }

    }

    public function selectLesson(){
        $lesson = mysqli_real_escape_string($this->connection,$_POST['lesson']);
        $_SESSION['current-lesson'] = $lesson;
        die();
    }

    // Controller to call the function which gets the completion of each lesson 

    public function getLessonCompletion($subject){

        $data = Lesson::getLessonCompletion($this->connection,$subject);

        if($data){
            return;
        }else{
            return false;
        }

    }

    public function getAllLessons($subject){

        $data = Lesson::getAllLessons($this->connection,$subject);

        if($data){
            return $data;
        }else{
            return false;
        }

    }

}



?>