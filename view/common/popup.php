<?php

include_once('../../config/app.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/popup.css">

    <title></title>
</head>
<body>

    <?php
        if(isset($_SESSION['popup-message'])){
            echo"
                <div id='popup-container'>
                    <div id='img-div'>
                        <img src='../../public/icons/success.svg'>
                    </div>
                    <p>".$_SESSION['popup-message']."</p>
                </div>
            ";
            unset($_SESSION['popup-message']);
        }

    ?>

    <script src="../../public/js/popup.js"></script>
</body>
</html>