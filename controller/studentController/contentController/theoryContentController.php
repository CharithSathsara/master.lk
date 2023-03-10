<?php

class theoryContentController{

    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
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