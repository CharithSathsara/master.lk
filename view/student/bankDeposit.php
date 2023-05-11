<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout-Bank Deposit</title>
    <link rel="stylesheet" href="../../public/css/bankDeposit.css">
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
        <b><p id="title"><a href="../../view/student/cart.php"><span id="cart-shortcut">Cart</span></a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="../../view/student/checkout.php"><span id="cart-shortcut">Checkout</span></a>&nbsp;&nbsp;>&nbsp;&nbsp;Bank Deposit Payment</p></b>
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
                <p id="payment-title">After the bank transfer to the below account, upload the payment slip to verify the payment.</p>
                <b><p>Bank Details:</p></b>

                <!-- get these details from the database -->
                <pre>
                
    Bank : Commercial Bank PLC
    Branch : Kandy
    Account Holder's Name : Master.lk(Pvt) Ltd
    Account Number : 200089768
                </pre>
                <!-- upto here -->

                <div id="upload-slip-sec">
                     <form action="../../controller/paymentController/slipPaymentController.php" method="post" enctype="multipart/form-data" id="slip-upload-form">
                        <label for="images" class="drop-container">
                            <span class="drop-title">Drop files here</span>
                            or
                            <input type="file" name="image" id="upload-photo-space" oninput="inputChange()">
                        </label>
                         <div id="slip-upload-error">
                             <?php include "../../controller/authController/message.php"?>
                         </div>
                         <input type="text" name="totalAmount" value=<?php echo $totalPrice ?> hidden>
                        <button type="submit" name="slip-upload-submit" id="slip-upload-submit">Upload</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="page-mask" id="page-mask-slip-upload-success">
    <div id="upload-success-popup">
        <img id="success-icon" src="../../public/icons/success-yellow.svg">
        <b><p id="upload-title">Uploaded Successfully!</p></b>
        <button onclick="closeUploadSuccessPopup()" class="close-button">
            <img src="../../public/icons/close.svg" class="close-icon">
        </button>
        <p id="upload-success-text">Slip has been successfully uploaded. Verification updates by the Administration will reach you soon.</p>
        <button id="ok-btn" onclick="closeUploadSuccessPopup()">OK</button>
        
    </div>
</div>

<script src="../../public/js/bankDeposit.js"></script>

<?php

if(isset($_SESSION['slip-upload-success'])){
    echo"
                <style>
                        #page-mask-slip-upload-success{
                            display:block;
                        }
                </style>
            ";
    unset($_SESSION['slip-upload-success']);
}

?>

</body>
</html>