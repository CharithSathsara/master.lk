<?php

class slipPayment
{
    public  static function getAllPaymentSlip($connection){
        $query = "SELECT * FROM payment WHERE paymentType = 'SLIP' ";

        $data = $connection->query($query);

        if($data){
            return $data;
        }
    }
}