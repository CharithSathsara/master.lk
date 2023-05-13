<?php

//$currentDir = __DIR__;
//
//include_once $currentDir.'\..\..\..\config\app.php';
//
//include_once ('../../../model/instituteDetails.php');
//include_once ('../../../model/BankDetails.php');
//include_once ('../../../model/Subject.php');

class systemInformationController
{
    private $connection;

    public function __construct(){

        $db_connection = DatabaseConnection::getInstance();
        $this->connection = $db_connection->getConnection();

    }

    public function getAllDetailsInstitute(){

        $result = instituteDetails::getInstituteDetails($this->connection);

        if ($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getAllDetailsBank(){

        $result = BankDetails::getBankDetails($this->connection);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getSubjectDetails($SubjectId){

        $details = Subject::getSubjectDescriptionUsingId($this->connection,$SubjectId);

        if($details){
            return $details;
        }else{
            return false;
        }
    }

    public function getSubjectPrice($subject){

        $price = Subject::getSubjectPrice($this->connection,$subject);

        if($price){
            return $price;
        }else{
            return false;
        }
    }
}