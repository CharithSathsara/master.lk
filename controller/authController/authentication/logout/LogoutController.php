<?php

class LogoutController{

    private $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }

    //In here we unset session values
    public function logout(){

        if(isset($_SESSION['authenticated']) === TRUE){

            if($_SESSION['auth_role'] == "TEACHER"){
                unset($_SESSION['subject']);
            }

            unset($_SESSION['authenticated']);
            unset($_SESSION['auth_user']);
            unset($_SESSION['auth_role']);
            return true;
        }else{
            return false;
        }

    }
}

?>