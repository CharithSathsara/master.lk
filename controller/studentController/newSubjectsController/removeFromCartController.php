<?php

include('../../../config/app.php');
require_once('../../../model/Subject.php');
require_once('../../../model/Cart.php');

    
    if(isset($_POST['remove-item-phy'])){

        $data = Subject::removeFromCart($db_connection->getConnection(),'Physics');

        if($data){
            redirect("Succesfully Removed from the Cart","view/student/cart.php");
            // $_SESSION['added_to_cart_phy']==false;
        }else{
            redirect("Could Not Remove from the Cart","view/student/cart.php");
        }

    }

    if(isset($_POST['remove-item-chem'])){

        $data = Subject::removeFromCart($db_connection->getConnection(),'Chemistry');

        if($data){
            redirect("Succesfully Removed from the Cart","view/student/cart.php");
            // $_SESSION['added_to_cart_chem']==false;
        }else{
            redirect("Could Not Remove from the Cart","view/student/cart.php");
        }

    }





?>