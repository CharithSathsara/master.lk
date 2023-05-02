<?php

class BankDetails
{
        public static function getBankDetails($connection){

            $query = "SELECT * FROM bank_details";

            $data = $connection->query($query);

            if($data){
                return $data;
            }
            else{
                return false;
            }
        }

        public static function updateBankDetails($connection,$AccountNumber,$HolderName,$BankName,$BranchName){

            $query = "UPDATE bank_details
                      SET AccountNumber='$AccountNumber', HolderName='$HolderName', BankName='$BankName', BranchName='$BranchName'";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                return false;
            }
        }

        public static function addBankDetails($connection,$AccountNumber,$HolderName,$BankName,$BranchName){

            $query = "INSERT INTO bank_details (`AccountNumber`,`HolderName`,`BankName`,`BranchName`)
                      VALUES ('$AccountNumber','$HolderName','$BankName','$BranchName')";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                return false;
            }
        }
}
?>