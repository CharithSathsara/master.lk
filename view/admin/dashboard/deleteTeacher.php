<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/adminDashboard.css">

    <title>Admin Dashboard</title>
</head>
    <body>
    <?php
    include_once('../../controller/authController/authentication/Authentication.php');
    include_once('../../controller/authController/authorization/Authorization.php');

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingAdmin();
    ?>

    <?php

    $currentDir = __DIR__;
    include_once $currentDir . '\..\..\..\controller\adminController\dashboardController\deleteTeacherController.php';

    ?>



         <div class="popup-delete" id="Delete-teacherPopBox">
            <div class="delete-teacherPop">
                <div class="delete-headerPop">
                    <img src="<?= base_url('public/img/important.png') ?>" id="closeDelete-popBox">
                    <h3>Delete Confirmation</h3>
                    <div class="close-deleteTeacher">
                        <button onclick="closeDeleteTeacherPop()"><img src="<?= base_url('public/img/close.png') ?>"> </button>
                    </div>
                </div>
                <div class="deletePop-teacherBody">
                    <p>Are you sure you want to delete this Teacher?</p>
                </div>

                <div class="deletePop-teacherButton">
                    <form action="<?= base_url('controller/adminController/dashboardController/deleteTeacherController.php') ?>" method="post">
                        <input type="hidden" name="userId" id="teacherUserId">
                        <input type="submit" class="deleteYes-button" id="deleteYes-btn" value="Yes" name="DeleteTeacher-btn">
                    </form>
                    <button class="deleteNo-button" id="deleteNo-btn">No</button>
                </div>
            </div>
        </div>

    </body>
</html>





















