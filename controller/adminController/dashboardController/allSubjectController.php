<?php

//$currentDir = __DIR__;
//
//include_once $currentDir . '../../../model/Subject.php';



class allSubjectController
{
    public $connection;

    public function __construct(){

        $db_connection = new DatabaseConnection();
        $this->connection = $db_connection->getConnection();

    }


    public function getAllSubject()
    {
        $subjects = Subject::getAllSubject($this->connection);

        if ($subjects){
            return $subjects;
        }


    }
}