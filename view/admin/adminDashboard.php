<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
</head>
<body>

<?php

include_once('../../config/app.php');
<<<<<<< HEAD
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

=======
include('../../controller/adminController/dashboardController/AdminDashboardController.php');
include('../../model/Admin.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

>>>>>>> origin/master
//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingAdmin();

<<<<<<< HEAD
include_once('../common/header.php');
include_once('../common/navBar-Admin.php');

?>

<header>
    <nav>
        <ul>
            <?php if(isset($_SESSION['authenticated'])) : ?>
                <li>
                    <form action="../../controller/authController/authentication/login/login.php" method="post">
                        <button type="submit" name="logout"><?= $_SESSION['auth_user']['userEmail'] ?> </button>
                    </form>
                </li>
            <?php else : ?>
                <li>
                    <button><a href="<?php base_url('view/authentication/index.php') ?>"> Login </a></button>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<h1>Admin Dashboard</h1>
=======
include_once '../common/header.php';

?>

<div class="content">

    <?php include_once '../common/navBar-Teacher.php'; ?>

    <div class="main">

        <div id="dashboard-container">
            <h1>Welcome To Admin Dashboard</h1>
        </div>

    </div>
>>>>>>> origin/master

</body>
</html>
