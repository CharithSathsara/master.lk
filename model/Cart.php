<?php

class Cart{


    public static function createCart($connection){

        $userId = $_SESSION['auth_user']['userId'];
        $query = "SELECT studentId FROM cart WHERE studentId='$userId' limit 1";
        $result = $connection->query($query);
        if(!($result && mysqli_num_rows($result) > 0)){
            $query1 = "INSERT into cart (studentId) VALUES ('$userId')";
            $result = $connection->query($query1);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }

    }

    public static function viewCart($connection){

        $userId = $_SESSION['auth_user']['userId'];

        $query1 = "SELECT * FROM cart WHERE studentId='$userId' limit 1";
        $result = $connection->query($query1);

        if($result && mysqli_num_rows($result) > 0){

            $data_set1 = $result->fetch_assoc();
            $cartId = $data_set1['cartId'];

            $query2 = "SELECT * FROM cart_subject WHERE cartId='$cartId'";
            $result2 = $connection->query($query2);

            if($result2 && mysqli_num_rows($result2) > 0){

                return $result2;
                
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

}