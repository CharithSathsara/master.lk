<?php

class slipPayment
{
    public  static function getAllPaymentSlip($connection){
        $query = "SELECT * FROM slip_payment WHERE isCheck = '0' ";

        $data = $connection->query($query);

        if($data){
            return $data;
        }
    }

    public static function getAllOwner($paymentId,$connection){
            $query = "SELECT * FROM payment WHERE paymentId='$paymentId'";

            $result = $connection->query($query);

            if($result){
                return $result;
            }else{
                return false;
            }
    }

    public static function getSlipPhoto($paymentId,$connection){
        $query = "SELECT slipImage FROM slip_payment WHERE paymentId ='$paymentId'";

        $data = $connection->query($query);
        $row = $data->fetch_assoc();

        if($row['slipImage'] != null){

//            view slip image
            $to_echo = "<img id='slip-pic' src='data:image/jpg;charset=utf8;base64,";
            $to_echo .= base64_encode($row['slipImage']);
            $to_echo .= "'/>";
            echo $to_echo;

            return true;
        }else{
//            echo "<img id='profile-pic' src='../../public/img/default-profPic.png'/>";
            return false;
        }
    }

    public static function acceptPaymentSlip($paymentId, $connection){
        $userId = $_SESSION['auth_user']['userId'];

        $current_time = date('Y-m-d H:i:s');
        $query = "UPDATE slip_payment
                  SET isVerified= 1,isCheck= 1, adminId ='$userId',verifyDate=NOW(),verifyTime=TIME('$current_time')
                WHERE paymentId = '$paymentId' ";

            $data = $connection->query($query);

            if($data){
                return $data;
            }else{
                return false;
            }
    }

    public static function rejectPaymentSlip($paymentId, $connection){
        $userId = $_SESSION['auth_user']['userId'];

        $current_time = date('Y-m-d H:i:s');
        $query = "UPDATE slip_payment
                  SET isVerified= 0,isCheck= 1, adminId ='$userId',verifyDate=NOW(),verifyTime=TIME('$current_time')
                WHERE paymentId = '$paymentId' ";

        $data = $connection->query($query);

        if($data){
            return $data;
        }else{
            return false;
        }
    }


}