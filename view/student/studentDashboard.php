<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>

<?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingStudent();

include_once '../common/header.php';

?>

<div class="content">

    <?php include_once '../common/navBar-Teacher.php'; ?>

    <div class="main">

        <div id="dashboard-container">
            <h1>Welcome To Student Dashboard</h1>
        </div>

    </div>

</body>
</html>
