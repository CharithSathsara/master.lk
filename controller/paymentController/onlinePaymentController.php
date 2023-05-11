<?php

$merchant_id = "1223165";
$order_id = uniqid();
$currency = "LKR";
$merchant_secret = "MTQwNDc2NzIyOTEwODI1NzcyNjQyMjg3OTI1OTY4MTQwNzU2Njk2MA==";
$amount = 2000;

$hash = strtoupper(
    md5(
        $merchant_id .
        $order_id .
        number_format($amount, 2, '.', '') .
        $currency .
        strtoupper(md5($merchant_secret))
    )
);

$array = [];

$array["item"] = "Door bell wireles";
$array["first_name"] = "Saman";
$array["last_name"] = "Perera";
$array["email"] = "samanp@gmail.com";
$array["phone"] = "0771234567";
$array["address"] = "No.1, Galle Road";
$array["city"] = "Colombo";

$array["merchant_id"] = $merchant_id;
$array["order_id"] = $order_id;
$array["currency"] = $currency;
$array["merchant_secret"] = $merchant_secret;
$array["amount"] = $amount;
$array["hash"] = $hash;

$jsonObj = json_encode($array);

echo $jsonObj;

?>
