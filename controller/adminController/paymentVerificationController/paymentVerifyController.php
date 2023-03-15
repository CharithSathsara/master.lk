<?php

$currentDir = __DIR__;

include_once $currentDir.'\..\..\..\config\app.php';

class paymentVerifyController
    {
        private $connection;

        public function __construct(){

            $db_connection = DatabaseConnection::getInstance();
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