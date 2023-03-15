<?php

class profilePhotoViewController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }


    public function getProfilePhoto(){

        $data = User::getProfilePhoto($this->connection);

        if($data){
            return;
        }else{
            return false;
        }

    }

}

?>