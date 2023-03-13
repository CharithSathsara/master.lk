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

    public function existsInCart($subject){

        $data = Cart::existsInCart($this->connection,$subject);

        if($data){
            return true;
        }else{
            return false;
        }

    }



}

?>