<?php

$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';
include_once $currentDir.'\..\..\..\model\Subject.php';


class allSubjectController
{
    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
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