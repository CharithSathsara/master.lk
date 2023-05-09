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

//        User Authentication
        Authentication::userAuthentication();
//        User Authorization
        Authorization::authorizingAdmin();

    ?>
            <?php
                $allSubject = new allSubjectController();
                $subjects = $allSubject->getAllSubject();
            ?>

                        <div id="popup-update" class="popup-update">
                            <div class="popup-UpdateTeacher">
                                <div class="container">
                                        <div class="updateTeacherText">
                                            <h4>Update Teacher</h4>
                                            <button onclick="closePopTeacher()"><img src="<?= base_url('public/img/close.png') ?>" class="closeTeacher-Icon" id="close-Teacher-Icon" alt="close"></button>
                                        </div>

                                </div>
                                <!-- Teacher Update form -->
                                <div class="forms-div">

                                    <form class="UpdateTeach-form" action="<?= base_url('controller/adminController/dashboardController/updateTeacherController.php') ?>" method="POST" id="UpdateTeacher-form">
                                        <input type="text" name="fname"   id="teacher-fname" value="<?= $_SESSION['user']['firstName'] ?>" >
                                        <input type="text" name="lname"   id="teacher-lname" value="<?= $_SESSION['user']['lastName'] ?>" >
                                        <input type="text" name="address1" id="teacher-address1" value="<?= $_SESSION['user']['addLine01'] ?>">
                                        <input type="text" name="address2" id="teacher-address2" value="<?= $_SESSION['user']['addLine02'] ?>">
                                        <input type="text" name="number"   id="teacher-number" value="<?= $_SESSION['user']['mobile'] ?>">
                                        <input type="email" name="email"   id="teacher-email" value="<?= $_SESSION['user']['email'] ?>">
                                        <input type="text" name="username" id="teacher-username" >
                                        <input type="text" name="userId" id="teacher-userId" value="<?= $_SESSION['user']['userId'] ?>" >

                                        <div class="selectSub">
                                            <label id="label-selectUpdateTeacher">Select the Subject : </label>
                                            <select name="subjects" id="subject-teacher" >
                                                <option value="" disabled selected hidden>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ----- Select a Subject -----</option>
                                                <?php
                                                foreach ($subjects as $subject){
                                                    ?>
                                                    <option value="<?php echo $subject['subjectTitle'] ;?>"><?= $subject['subjectTitle']; ?></option>
                                                    <?php
                                                }
                                                   ?>
                                            </select>
                                        </div>
                                        <div class="show-updateTeacherError">
                                            <div class="error-message-up-teacher" id="error-message-up-teacher">
                                                <?php include "validationMessage.php"?>
                                            </div>
                                            <input type="submit" name="updateteacher-button" value="Save" class="sub-Update-teacher" id="updateTeacherSubmit" >
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>

</body>
</html>
