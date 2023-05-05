<?php

class DatabaseConnection {

    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_password = '';
    private $db_name = 'master_db';

    private static $instance;
    private $connection;

    private function __construct(){

        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);

        if($this->connection->connect_error){
            die("<h1>Database Connection Failed</h1>");
        }
    }

    public static function getInstance(){

        if(!self::$instance){
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }

}

?>
