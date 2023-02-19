<?php

class DatabaseConnection{

    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_password = '';
    private $db_name = 'master_db';

    private $connection;


    public function __construct(){

        $conn = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);

        if($conn->connect_error){
            die("<h1>Database Connection Failed</h1>");
        }else{
            //echo "Connection Successful";
        }

        return $this->connection = $conn;

    }

    public function getConnection(){
        return $this->connection;
    }

}

<<<<<<< HEAD
?>
=======
?>
>>>>>>> origin/master
