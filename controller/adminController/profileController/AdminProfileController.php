<?php

class AdminProfileController
{
    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getAdminDetails($user_id){
        $data = Admin::getAdminDetails($this->connection,$user_id);

        if($data){
            return $data;
        }
    }
}