<?php

include('../../../config/app.php');
require_once('../../../model/Subject.php');
require_once('../../../model/Cart.php');
include('./cartController.php');


$cartController = new cartController();
$cartCreationStatus = $cartController->createCart() ;

if($cartCreationStatus){
    
    if(isset($_POST['add-to-cart-phy'])){

        $data = Subject::addToCart($db_connection->getConnection(),'Physics');

        if($data){
            redirect("Succesfully Added to the Cart","view/student/newSubjects.php");
            // $_SESSION["added_to_cart_phy"]=true;
        }else{
            redirect("Already in the Cart","view/student/newSubjects.php");
        }

    }

    if(isset($_POST['add-to-cart-chem'])){

        $data = Subject::addToCart($db_connection->getConnection(),'Chemistry');

        if($data){
            redirect("Succesfully Added to the Cart","view/student/newSubjects.php");
            // $_SESSION["added_to_cart_chem"]=true;
        }else{
            redirect("Already in the Cart","view/student/newSubjects.php");
        }

    }
}




?>