<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Subjects</title>
    <link rel="stylesheet" href="../../public/css/cart.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');
include_once('../common/navBar-Student.php');
include_once('../common/header.php');

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

// include('../../controller/authController/message.php');
include('../../controller/studentController/newSubjectsController/subjectController.php');
include('../../controller/studentController/newSubjectsController/viewCartController.php');
include('../../model/Subject.php');
include('../../model/Cart.php');

$subjectController = new subjectController();
$viewCartController = new viewCartController();

?>

<div id="select-subjects-container">
    <div id="select-subjects">
        <div id="cart-container">

        <div id="cart-topic-container">
            <b><p id="cart-topic">Cart</p></b>
            <a href="./newSubjects.php"><img src="../../public/icons/close.svg" id="close-icon"></a>
        </div>

        <div id="cart-body">

        <?php 

            $subjectController = new subjectController();

            $price_phy = $subjectController->getSubjectPrice("Physics") ;
            $price_chem = $subjectController->getSubjectPrice("Chemistry") ;

            $phy = "<div class='cart-item' id='cart-item-phy'>
                    <div class='cart-subject-name'>Physics</div>
                    <div class='cart-subject-price'>LKR.";
            $phy .= $price_phy;
            $phy .= ".00</div>
                    <form action='../../controller/studentController/newSubjectsController/removeFromCartController.php' class='remove-item-form' method='post'>
                        <button class='remove-item-btn' name='remove-item-phy' type='submit'>
                            <img src='../../public/icons/close-round.svg' class='close-round-icon'></div>
                        </button>
                    </form>";

            $chem = "<div class='cart-item' id='cart-item-chem'>
                    <div class='cart-subject-name'>Chemistry</div>
                    <div class='cart-subject-price'>LKR.";
            $chem .= $price_chem;
            $chem .= ".00</div>
                    <form action='../../controller/studentController/newSubjectsController/removeFromCartController.php' class='remove-item-form' method='post'>
                        <button class='remove-item-btn' name='remove-item-chem' type='submit'>
                            <img src='../../public/icons/close-round.svg' class='close-round-icon'></div>
                        </button>
                    </form>";


            $data = $viewCartController->viewCart();

            if($data){
                foreach($data as $row){

                    $title = $viewCartController->getSubjectTitle($row['subjectId']);

                        if($title ==='Physics'){
                            echo $phy;

                        }else if($title ==='Chemistry'){
                            echo $chem;
                        }
                }
            }
            else{
                $noItems = "<div id='no-items'>
                            <img src='../../public/img/emptyCart.png' id='empty-cart'>
                            <p id='empty-cart-text'>No Items</p>
                            </div>";
                echo $noItems;
            }

        ?>

        </div>
        <div id="cart-total-container">
            <hr id="cart-hr">
            <p id="total-label">Total</p>
            <div id="total-price">
                <?php 
                    $subjectController = new subjectController();

                    $price_phy = $subjectController->getSubjectPrice("Physics") ;
                    $price_chem = $subjectController->getSubjectPrice("Chemistry") ;
                    $data = $viewCartController->viewCart();

                    $totalPrice=0;
                    if($data){
                        foreach($data as $row){

                            $title = $viewCartController->getSubjectTitle($row['subjectId']);

                            if($title ==='Physics'){
                                $totalPrice = $totalPrice + $price_phy;

                            }else if($title ==='Chemistry'){
                                $totalPrice = $totalPrice + $price_chem;
                            }
                        }
                        echo "LKR.$totalPrice.00";
                    }
                    else{
                        echo "LKR.0.00";
                    }
        
                ?>
            </div>
        </div>
            <button id="checkout-btn" type="submit"><span><img src="../../public/icons/checkout.svg" class="checkout-icon"></span>Checkout</button>
        </div>
    </div>
</div>