<?php

class theoryContentController{

    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }


    public function getTheoryContent($subject,$lesson,$topic){

        $data = Theory::getTheoryContent($this->connection,$subject,$lesson,$topic);

        if($data){
            return;
        }else{
            return false;
        }

    }


}

?>