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
                                        <div class="error-message-up-teacher" id="error-message-up-teacher">
                                            <?php include "validationMessage.php"?>
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
                                            <label>Select the Subject : </label>
                                            <select name="subjects" id="subject-teacher" style="width: 6vw; border-radius: 5px; margin-left: 9vw; border: none; height: 4vh; margin-top: -60px">
                                                <?php
                                                foreach ($subjects as $subject){
                                                    ?>
                                                    <option value="<?php echo $subject['subjectTitle'] ;?>"><?= $subject['subjectTitle']; ?></option>
                                                    <?php
                                                }
                                                   ?>
                                            </select>
                                        </div>

                                        <input type="submit" name="updateteacher-button" value="Save" class="sub-Update-teacher" id="updateTeacherSubmit" style="margin-top: -18vh; margin-left: 23.5vw">
                                    </form>
                                </div>

                            </div>
                        </div>

</body>
</html>
