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

    public static function viewCartSubject($connection,$userId){


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

    public static function existsInCart($connection,$subject){

        $userId = $_SESSION['auth_user']['userId'];
        
        $query = "SELECT studentId FROM cart WHERE studentId='$userId' limit 1";
        $result2 = $connection->query($query);

        if($result2 && mysqli_num_rows($result2) > 0){

            $query1 = "SELECT cartId from cart where studentId = '$userId' limit 1 ";
            $data = $connection->query($query1);
            $data_set1 = $data->fetch_assoc();

            $cartId = $data_set1['cartId'];

            $query2 = "SELECT subjectId from subject where subjectTitle = '$subject' limit 1 ";
            $data = $connection->query($query2);
            $data_set2 = $data->fetch_assoc();

            $subjectId = $data_set2['subjectId'];

            $query3 = "SELECT * from cart_subject where cartId='$cartId' AND subjectId='$subjectId' limit 1";
            $result = $connection->query($query3);

            if($result && mysqli_num_rows($result) > 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public static function getCardId($connection,$userId){

        $query = "SELECT cartId FROM cart WHERE studentId = '$userId' LIMIT 1";

        $result = $connection->query($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }


}