<?php



$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\Admin.php';



class AdminDashboardController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
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