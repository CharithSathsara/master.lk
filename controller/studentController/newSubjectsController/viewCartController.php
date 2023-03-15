<?php


class viewCartController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }


    public function viewCart(){

        $data = Cart::viewCart($this->connection);

        if($data){
            return $data;
        }else{
            return false;
        }

    }

    public function getSubjectTitle($subjectId){

        $data = Subject::getSubjectTitle($this->connection, $subjectId);

        if($data){
            return $data;
        }else{
            exit();
        }

    }

}





?>