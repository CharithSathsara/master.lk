function paymentGateway(totalPrice) {

    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
        if(xhttp.readyState === 4 && xhttp.status === 200) {

            const response = JSON.parse(xhttp.responseText);

            // Payment completed. It can be a successful failure.
            payhere.onCompleted = function onCompleted(orderId) {

                // Send a POST request to update the database
                const xhr = new XMLHttpRequest();
                const url = "../../controller/paymentController/onlinePaymentController.php";
                xhr.open("POST", url, true);
                // Set the content type of the request to x-www-form-urlencoded
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = () => {

                    if(xhr.readyState === 4 && xhr.status === 200) {
                        window.location.href = "../../view/student/checkout.php?payment=success";
                    }else {
                        window.location.href = "../../view/student/checkout.php?payment=fail";
                    }
                }

                const params = 'payment=' + encodeURIComponent("success") + '&amount=' + encodeURIComponent(totalPrice);
                xhr.send(params);

            };

            // Payment window closed
            payhere.onDismissed = function onDismissed() {
                // Note: Prompt user to pay again or show an error page
                console.log("Payment dismissed");
            };

            // Error occurred
            payhere.onError = function onError(error) {
                // Note: show an error page
                console.log("Error:"  + error);
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": response["merchant_id"],    // Replace your Merchant ID
                "return_url": "http://localhost/master.lk/view/student/checkout.php?payment=success",    // Important, Redirect when success
                "cancel_url": "http://localhost/master.lk/view/student/checkout.php?payment=fail",   // Important, Redirect when cancel
                "notify_url": "http://sample.com/notify",
                "order_id": response["order_id"],
                "items": response["item"],
                "amount": response["amount"],
                "currency": response["currency"],
                "hash": response["hash"], // *Replace with generated hash retrieved from backend
                "first_name": response["first_name"],
                "last_name": response["last_name"],
                "email": response["email"],
                "phone": response["phone"],
                "address": response["address"],
                "city": response["city"],
                "country": "Sri Lanka",
            };

            payhere.startPayment(payment);

        }
    }

    xhttp.open("POST", "../../controller/paymentController/onlinePaymentController.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const data = 'totalPrice=' + encodeURIComponent(totalPrice);
    xhttp.send(data);

}