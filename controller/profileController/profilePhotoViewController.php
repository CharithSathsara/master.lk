<?php

class profilePhotoViewController{

public $connection;

public function __construct(){

    $db_connection = new DatabaseConnection();
    $this->connection = $db_connection->getConnection();

}


public function getProfilePhoto(){

    $data = User::getProfilePhoto($this->connection);

    if($data){
        // return $data;
        // echo 'base64_encode('.$data.')';
        // echo '<img src="data:image/jpeg;base64,'.base64_encode($data).'"/>';
        // echo '<img src="data:image/jpeg;base64,'.base64_encode($data->load()) .'" />';
        echo '<img id="profile-pic" src="data:image/jpg;base64,'.base64_encode($data).'" alt="Profile Picture"/>';
    }else{
        return false;
    }

}

}