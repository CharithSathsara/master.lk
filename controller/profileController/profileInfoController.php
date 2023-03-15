<?php

class profileInfoController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }


    public function getProfileData($req_data){

        $data = User::getProfileData($this->connection,$req_data);

        if($data){
            return $data;
        }else{
            return false;
        }

    }

    public function getProfileDataStudent(){

        $data = Student::getProfileDataStudent($this->connection);

        if($data){
            return $data;
        }else{
            return false;
        }

    }

}

?>