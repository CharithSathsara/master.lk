<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>403 Error</title>

    <link rel="stylesheet" href="../../public/css/unauthorizedAccess.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>
<body>

    <?php

    include_once('../../config/app.php');

    ?>

    <div id="header">
        <img src="../../public/img/FullMasterLogo.svg" id="logo">
    </div>

    <div id="error-page">
        <img src="../../public/img/403 Error Forbidden-amico.svg" id="error-img">
        <p id="no-access-text">403 - Access Denied!</p>
        <p id="reason"><?=$_SESSION['restrict-error-message']?></p>
        <button id="back-btn" onclick="history.back()"><b>Go Back</b></button>
    </div>

</body>
</html>
