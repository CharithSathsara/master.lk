<?php

class cartController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }


    public function createCart(){

        $data = Cart::createCart($this->connection);

        if($data){
            return true;
        }

    }

}

?>