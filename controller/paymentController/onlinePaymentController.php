<?php

include('../../config/app.php');
include_once('../../model/Student.php');
include_once('../../model/Cart.php');

// Handle the POST request to create a new payment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $amount = $_POST['totalPrice'];
    $order_id = uniqid();
    $currency = "LKR";

    $hash = strtoupper(
        md5(
            MERCHANT_ID .
            $order_id .
            number_format($amount, 2, '.', '') .
            $currency .
            strtoupper(md5(MERCHANT_SECRET))
        )
    );

    $array = [];

    if (!empty($db_connection)) {

        $student = Student::getStudent($db_connection->getConnection(), $_SESSION['auth_user']['userId']);

        if($student) {

            //set student details
            $array["item"] = "Master.lK Course";
            $array["first_name"] = $student['firstName'];
            $array["last_name"] = $student['lastName'];
            $array["email"] = $student['email'];
            $array["phone"] = $student['mobile'];
            $array["address"] = $student['addLine01'];
            $array["city"] = $student['addLine02'];

            $array["merchant_id"] = MERCHANT_ID;
            $array["order_id"] = $order_id;
            $array["currency"] = $currency;
            $array["merchant_secret"] = MERCHANT_SECRET;
            $array["amount"] = $amount;
            $array["hash"] = $hash;

            $jsonObj = json_encode($array);

            echo $jsonObj;

        }
    }
}

// Update the database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment']) && $_POST['payment'] === 'success') {

    if (!empty($db_connection)) {

        $isPaymentSuccess = Student::onlinePayment($db_connection->getConnection(), $_POST['amount'], $_SESSION['auth_user']['userId']);

        if ($isPaymentSuccess) {

            $cart_details = Cart::viewCart($db_connection->getConnection());

            while ($cartRow = $cart_details->fetch_assoc()) {

                $cartId = $cartRow['cartId'];
                $subjectId = $cartRow['subjectId'];

                // give access to student
                $isGiveAccess = Student::giveSubjectAccess($db_connection->getConnection(), $_SESSION['auth_user']['userId'], $subjectId);

            }

            //clear the cart
            Student::clearCart($db_connection->getConnection(), $cartId );

        }
    }
}

?>
