<?php

class paymentVerifyController
    {
        public $connection;

        public function __construct(){

            $db_connection = new DatabaseConnection();
            $this->connection = $db_connection->getConnection();

        }

        public function getAllPaymentSlip(){

            $data = Admin::getAllPaymentSlip($this->connection);

            if($data){
                return $data;
            }
        }
    }