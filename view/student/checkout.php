<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
    <link rel="stylesheet" href="../../public/css/checkout.css?<?php echo time(); ?>">
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

include('../../controller/studentController/newSubjectsController/subjectController.php');
include('../../controller/studentController/newSubjectsController/viewCartController.php');
include('../../model/Subject.php');
include('../../model/Cart.php');

$subjectController = new subjectController();
$viewCartController = new viewCartController();

?>

<div id="checkout-container">
    <div id="checkout">
        <b><p id="title"><a href="../../view/student/cart.php"><span id="cart-shortcut">Cart</span></a>&nbsp;&nbsp;>&nbsp;&nbsp;Checkout</p></b>
        <br><hr><br>
        <div id="checkout-contents">
            <div id="cart-container">

                <div id="cart-body">

                    <?php 

                    $subjectController = new subjectController();

                    $price_phy = $subjectController->getSubjectPrice("Physics") ;
                    $price_chem = $subjectController->getSubjectPrice("Chemistry") ;

                    $phy = "<div class='cart-item' id='cart-item-phy'>
                            <div class='cart-subject-name'>Physics</div>
                            <div class='cart-subject-price'>LKR.";
                    $phy .= $price_phy;
                    $phy .= ".00</div></div>";

                    $chem = "<div class='cart-item' id='cart-item-chem'>
                            <div class='cart-subject-name'>Chemistry</div>
                            <div class='cart-subject-price'>LKR.";
                    $chem .= $price_chem;
                    $chem .= ".00</div></div>";


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
            </div>

            <div id="option-container">
                <p id="payment-title">Choose your payment method </p>
<!--                <a href="">-->
<!--                    <button id="card-payment-btn" class="payment-btns" onclick="paymentGateway();">-->
<!--                        Card Payment-->
<!--                    </button>-->
<!--                </a>-->
                <button id="card-payment-btn" class="payment-btns" name="online-payment" onclick="paymentGateway(<?php echo $totalPrice; ?>);">
                    Card Payment
                </button>
                <a href="./bankDeposit.php">
                    <button id="bank-deposit-btn" class="payment-btns">
                        Bank Deposit
                    </button>
                </a>
                <br>
                <img src="../../public/img/payments.svg" id="payment-img">

            </div>
        </div>

    </div>
</div>

<div class="page-mask" id="page-mask-payment-success">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/success-yellow.svg">
        <b><p id="upload-title">Payment Successfully!</p></b>
        <button onclick="closePaymentSuccessPopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <p id="upload-success-text">Your payment has been successfully.</p>
        <a href="studentDashboard.php"><button id="ok-btn" onclick="closePaymentSuccessPopup()">Go to Dashboard</button></a>
    </div>

</div>

<div class="page-mask" id="page-mask-payment-fail">

    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/delete-alert.png">
        <b><p id="upload-title">Payment failed!</p></b>
        <button onclick="closePaymentFailPopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <p id="upload-success-text">Your payment has been unsuccessfully.</p>
        <button id="ok-btn" onclick="closePaymentFailPopup()">OK</button>
    </div>

</div>

<script src="../../public/js/checkout.js"></script>

<?php

if($_GET['payment'] == 'success'){
    echo"
                <style>
                        #page-mask-payment-success {
                            display:block;
                        }
                </style>
            ";
}

if($_GET['payment'] == 'fail'){
    echo"
                <style>
                        #page-mask-payment-fail {
                            display:block;
                        }
                </style>
            ";
}

?>



<script src="../../public/js/payment-gateway.js"></script>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>
</html>