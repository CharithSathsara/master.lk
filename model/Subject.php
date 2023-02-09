<?php

class Subject{

    public static function getSubjectPrice($connection,$subject){

        $query = "SELECT * from subject where subjectTitle = '$subject' limit 1 ";
        $data = $connection->query($query);
        $price = $data->fetch_assoc();

        return $price['price'];

    }


    public static function getSubjectTitle($connection, $subjectId){

        $query = "SELECT subjectTitle from subject where subjectId = '$subjectId'";

        $data = $connection->query($query);

        $subject = $data->fetch_assoc();

        return $subject['subjectTitle'];

    }

    public static function addToCart($connection,$subject){

        $userId = $_SESSION['auth_user']['userId'];

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

        if(!($result && mysqli_num_rows($result) > 0)){
            $query4 = "INSERT into cart_subject (cartId,subjectId) VALUES ('$cartId','$subjectId')";
            $data = $connection->query($query4);
            return true;
        }else{
            return false;
        }
    }

    public static function removeFromCart($connection,$subject){

        $userId = $_SESSION['auth_user']['userId'];

        $query1 = "SELECT cartId from cart where studentId = '$userId' limit 1 ";
        $data = $connection->query($query1);
        $data_set1 = $data->fetch_assoc();

        $cartId = $data_set1['cartId'];

        $query2 = "SELECT subjectId from subject where subjectTitle = '$subject' limit 1 ";
        $data = $connection->query($query2);
        $data_set2 = $data->fetch_assoc();

        $subjectId = $data_set2['subjectId'];

        $query3 = "DELETE FROM cart_subject WHERE cartId='$cartId' AND subjectId = '$subjectId'";
        $result = $connection->query($query3);

        if($result){
            return true;
        }else{
            return false;
        }
    }


}