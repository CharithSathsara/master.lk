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
include_once('../common/header.php');

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

include('../../controller/studentController/newSubjectsController/subjectController.php');
include('../../controller/studentController/newSubjectsController/viewCartController.php');
include('../../controller/studentController/newSubjectsController/cartController.php');
include('../../controller/studentController/dashboardController/studentSubjectController.php');
include('../../model/Student.php');
include('../../model/Subject.php');
include('../../model/Cart.php');

include_once('../common/navBar-Student.php');

$subjectController = new subjectController();
$viewCartController = new viewCartController();
$cartController = new cartController();
$studentSubjectController = new studentSubjectController();

?>

<div id="select-subjects-container">
    <div id="select-subjects">
        <b><p id="title">Select Your Subjects</p></b>

        <div class="subject-container">
            <div class="subject-description-card" id="phy-subject-description-card">
                <b><p class="sub-card-title">Physics</p></b>
                <?php

                if($studentSubjectController->hasBought("Physics")){
                    echo"
                    <div class='added-to-cart-container' id='phy-add-to-cart-container'>
                        <b><p class='added-to-cart-text'>Already Bought</p></b>
                    </div>
                    ";
                }elseif(!($cartController->existsInCart("Physics"))){
                    echo"
                    <div class='add-to-cart-container' id='phy-add-to-cart-container'>
                        <form action='../../controller/studentController/newSubjectsController/addToCartController.php' method='post'>
                            <b><button class='add-to-cart-btn' name='add-to-cart-phy' type='submit'><span><img src='../../public/icons/cart.svg' class='cart-icon'></span>Add to Cart</button></b>
                        </form>
                    </div>
                    ";
                }
                else{
                    echo"
                    <div class='added-to-cart-container' id='phy-add-to-cart-container'>
                        <b><p class='added-to-cart-text'>Added to Cart</p></b>
                    </div>
                    ";
                }

                ?>
            </div>
            <div class="subject-description">
                <p class="sub-text"><?= $subjectController->getSubjectDescription("Physics") ; ?>
                <br><br>LKR.<?= $subjectController->getSubjectPrice("Physics") ; ?>.00</p>
            </div>
        </div>
        <div class="subject-container">
            <div class="subject-description-card" id="chem-subject-description-card">
                <b><p class="sub-card-title">Chemistry</p></b>
                <?php

                if($studentSubjectController->hasBought("Chemistry")){
                    echo"
                    <div class='added-to-cart-container' id='phy-add-to-cart-container'>
                        <b><p class='added-to-cart-text'>Already Bought</p></b>
                    </div>
                    ";
                }elseif(!($cartController->existsInCart("Chemistry"))){
                    echo"
                    <div class='add-to-cart-container' id='chem-add-to-cart-container'>
                        <form action='../../controller/studentController/newSubjectsController/addToCartController.php' method='post'>
                            <b><button class='add-to-cart-btn' name='add-to-cart-chem' type='submit'><span><img src='../../public/icons/cart.svg' class='cart-icon'></span>Add to Cart</button></b>
                        </form>
                    </div>
                    ";
                }
                else{
                    echo"
                    <div class='added-to-cart-container' id='chem-add-to-cart-container'>
                        <b><p class='added-to-cart-text'>Added to Cart</p></b>
                    </div>
                    ";
                }

                ?>
            </div>
            <div class="subject-description">
                <p class="sub-text"><?= $subjectController->getSubjectDescription("Chemistry") ; ?>
                <br><br>LKR.<?= $subjectController->getSubjectPrice("Chemistry") ; ?>.00</p>

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
