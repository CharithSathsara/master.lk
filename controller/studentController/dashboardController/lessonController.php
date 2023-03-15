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
            return true;
        }else{
            return false;
        }

    }

    public function selectLesson(){
        $lesson = mysqli_real_escape_string($this->connection,$_POST['lesson']);
        $_SESSION['current-lesson'] = $lesson;
        die();
        // redirect("", "view/student/topicsAndFeedbacks.php");
    }

}



?>