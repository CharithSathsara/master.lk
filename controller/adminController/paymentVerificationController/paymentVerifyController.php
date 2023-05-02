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

        public function getSlipOwner($paymentId){

            $data = slipPayment::getAllOwner($paymentId,$this->connection);
            if($data){
                return $data;
            }else{
                return false;
            }
        }

        public function getSlipImage($paymentId){

            $data = slipPayment::getSlipPhoto($paymentId,$this->connection);

            if($data){
                return true;
               // header("Location : ../../../view/admin/payment/slipImage.php");
            }else{
                return false;
            }
        }

        public function getBankDetails(){

            $data = BankDetails::getBankDetails($this->connection);

            if($data){
                return $data;
            }else{
                return false;
            }
        }

    }
 ?>