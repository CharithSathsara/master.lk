<?php

include_once('../../config/app.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/header.css?<?php echo time(); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title></title>
</head>
<body>
    
    <div id="header-container">
        <div id="white-line"></div><br>
        <div id="blue-line">
            <!-- <form method="post" action="../../controller/authController/authentication/logout/logout.php"> -->
                <button onclick="logout_open()" id="logout">
                    <p id="logout-text">Log Out</p>
                    <img src="../../public/icons/logout.svg" id="logout-icon">
                </button>
            <!-- </form> -->
        </div>
        <img src="../../public/img/logo-header.png" alt="logo" id="header-logo">
        <div id="logout-confirm">
            <p>Are you sure you want to logout?</p>
            <form method="post" action="../../controller/authController/authentication/logout/logout.php" id="logout-form">
                <button type="submit" id="logout-yes" class="logout-confirm-buttons">Yes</button>
            </form>
            <button onclick="logout_close()" id="logout-no" class="logout-confirm-buttons">No</button>
        </div>
    </div>
    <script src="../../public/js/header.js"></script>
</body>
</html>