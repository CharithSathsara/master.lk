<?php

//$currentDir = __DIR__;
//
//include_once('../../config/app.php');
//include_once ('../../model/Teacher.php');
//include_once ('../../model/Admin.php');
//include_once ('../../model/Subject.php');


//// Get the absolute path of the current directory
//$currentDir = __DIR__;
//
//// Include the files using the dynamic path
//include_once $currentDir . '../../../config/app.php';
//include_once $currentDir . '../../../model/Teacher.php';
//include_once $currentDir . '../../../model/Admin.php';
//



class AdminDashboardController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    public function getAllTeachers(){

        $data = Admin::getAllTeachers($this->connection);

        if($data){
            return $data;
        }

    }

    public function getTeacherSubject($teacherId){

        $subject = Admin::getTeacherSubject($this->connection, $teacherId);

        if($subject){
            return $subject;
        }

    }

    public function getAllContentCreators(){

        $data = Admin::getAllContentCreators($this->connection);

        if($data){
            return $data;
        }

    }

    public function getContentCreatorSubject($creatorId){

        $subject = Admin::getContentCreatorSubject($this->connection, $creatorId);

        if($subject){
            return $subject;
        }

    }


}

?>