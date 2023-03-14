<?php

$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';

class paymentVerifyController
    {
        public $connection;

        public function __construct(){

            $db_connection = new DatabaseConnection();
            $this->connection = $db_connection->getConnection();

        }

        public function getAllPaymentSlip(){

            $data = slipPayment::getAllPaymentSlip($this->connection);

            if($data){
                return $data;
            }
        }

        public  function getStudentName($studentID){

            $data = Student::getStudentName($this->connection,$studentID);

            if($data){
                return $data;
            }
        }

    }