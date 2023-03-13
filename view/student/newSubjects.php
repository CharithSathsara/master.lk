<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Subjects</title>
    <link rel="stylesheet" href="../../public/css/newSubjects.css?<?php echo time(); ?>">
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
include('../../controller/studentController/newSubjectsController/cartController.php');
include('../../model/Subject.php');
include('../../model/Cart.php');

$subjectController = new subjectController();
$viewCartController = new viewCartController();
$cartController = new cartController();

?>

<div id="select-subjects-container">
    <div id="select-subjects">
        <b><p id="title">Select Your Subjects</p></b>

        <div class="subject-container">
            <div class="subject-description-card" id="phy-subject-description-card">
                <b><p class="sub-card-title">Physics</p></b>
                <?php
                if(!($cartController->existsInCart("Physics"))){
                    echo"
                    <div class='add-to-cart-container' id='phy-add-to-cart-container'>
                        <form action='../../controller/studentController/newSubjectsController/addToCartController.php' method='post'>
                            <b><button class='add-to-cart-btn' name='add-to-cart-phy' type='submit'><span><img src='../../public/icons/cart.svg' class='cart-icon'></span>Add to Cart</button></b>
                        </form>
                    </div>
                    ";

                }else{
                    echo"
                    <div class='added-to-cart-container' id='phy-add-to-cart-container'>
                        <b><p class='added-to-cart-text'>Added to Cart</p></b>
                    </div>
                    ";
                }

                ?>
            </div>
            <div class="subject-description">
                <p class="sub-text">Physics is the natural science that studies matter, its fundamental constituents, its motion and behavior through space and time, 
                    and the related entities of energy and force. In this course, you will learn the basic theory parts of Electronics and Mechanics along with related 
                    Model MCQs and Past Paper MCQs.<br><br>LKR.<?= $subjectController->getSubjectPrice("Physics") ; ?>.00</p>
            </div>
        </div>
        <div class="subject-container">
            <div class="subject-description-card" id="chem-subject-description-card">
                <b><p class="sub-card-title">Chemistry</p></b>
                <?php
                if(!($cartController->existsInCart("Chemistry"))){
                    echo"
                    <div class='add-to-cart-container' id='chem-add-to-cart-container'>
                        <form action='../../controller/studentController/newSubjectsController/addToCartController.php' method='post'>
                            <b><button class='add-to-cart-btn' name='add-to-cart-chem' type='submit'><span><img src='../../public/icons/cart.svg' class='cart-icon'></span>Add to Cart</button></b>
                        </form>
                    </div>
                    ";

                }else{
                    echo"
                    <div class='added-to-cart-container' id='chem-add-to-cart-container'>
                        <b><p class='added-to-cart-text'>Added to Cart</p></b>
                    </div>
                    ";
                }

                ?>
            </div>
            <div class="subject-description">
                <p class="sub-text">Chemistry is the scientific study of the properties and behavior of matter. It is a natural science that covers the elements that 
                    make up matter to the compounds made of atoms, molecules and ions: their composition, structure, properties, behavior and the changes they undergo 
                    during a reaction with other substances. In this course, you will learn the basic theory parts of Organic Chemistry and Inorganic Chemistry along with related 
                    Model MCQs and Past Paper MCQs.<br><br>LKR.<?= $subjectController->getSubjectPrice("Chemistry") ; ?>.00</p>

            </div>
        </div>

            <a href="./cart.php" id="view-cart-btn">
                <div id="a-div">
                    <span><img src="../../public/icons/cart-white.svg" class="cart-icon"></span>
                    <p>View Cart</p>
                </div>
            </a>

    </div>

        <!-- <div id="no-items">
            <p>No Items in the Cart</p>
        </div> -->

        </div>
        <div id="cart-total-container">
            <hr id="cart-hr">
            <p id="total-label">Total</p>
            <div id="total-price"></div>
        </div>
        <button id="checkout-btn" type="submit"><span><img src="../../public/icons/checkout.svg" class="checkout-icon"></span>Checkout</button>
    </div> -->

</div>


</body>
</html>
