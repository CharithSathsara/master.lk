<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/adminDashboard.css">
    <script src="../../public/js/adminDashboard.js"></script>

    <title>Admin Dashboard</title>
</head>
    <body>

    <?php
    include_once('../../config/app.php');
    include_once('../../controller/authController/authentication/Authentication.php');
    include_once('../../controller/authController/authorization/Authorization.php');

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingAdmin();

    include_once('../../controller/adminController/dashboardController/AdminDashboardController.php');
    include_once('../../controller/adminController/dashboardController/allSubjectController.php');
    include_once('../../model/User.php');
    include_once('../../model/Admin.php');
    include_once ('../../model/Subject.php');
    include_once ('../../model/Teacher.php');
    include_once('../common/header.php');

    
    $_SESSION['adminNavItems-dashboard'] = array();
    array_push($_SESSION['adminNavItems-dashboard'], 'adminDashboard.php');

    $_SESSION['adminNavItems-payments'] = array();
    array_push($_SESSION['adminNavItems-payments'], 'paymentVerification.php', 'slipImage.php');

    $_SESSION['adminNavItems-systemInfo'] = array();
    array_push($_SESSION['adminNavItems-systemInfo'], 'systemInformation.php');

    $_SESSION['adminNavItems-profile'] = array();
    array_push($_SESSION['adminNavItems-profile'], 'profile.php');

    include_once('../common/navBar-Admin.php');
    ?>

        <div class="section-3">
            <div id="adminDashboardContainer">
                <div class="dashboard-text">
                    <p>Dashboard</p>
                </div>

                <div class="teacher-1">
                    <p>Teachers &nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="getTeacher">


                        <?php

                        $adminDashboardController = new AdminDashboardController();
                        $teachers = $adminDashboardController->getAllTeachers();
                        ?>
                    <div class="allTeacherSet">
                    <?php
                        if($teachers){
                            foreach($teachers as $teacher){

                                $teacherId = $teacher['userId'];
                                $subject = $adminDashboardController->getTeacherSubject($teacherId);
                                ?>
                                    <div class="oneTeacherTile">
                                        <div class="iconDiv">
                                            <button class="Update-teacher" id="but-UpdateTeacher" onclick="showUpdateTeacherForm('<?php echo $teacher['userId']; ?>','<?php echo  $teacher['firstName']; ?>','<?php echo $teacher['lastName']; ?>','<?php echo  $teacher['addLine01']; ?>','<?php echo  $teacher['addLine02']; ?>','<?php echo  $teacher['mobile']; ?>','<?php echo  $teacher['email']; ?>')"><img src="../../public/img/update.svg"></button>
                                            <button class="delete-teacher" id="but-deleteTeacher" onclick="showDeleteTeacherForm('<?php echo $teacher['userId']; ?>')" ><img src="../../public/img/delete.svg"></button>
                                        </div>
                                        <div class="profilePic">
                                            <div class="profilePicBorder">
                                                <?php
                                                $UserProfilePhoto = new profilePhotoViewController();
                                                $UserProfilePhoto->getProfilePhotoUsers($teacherId);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="userInformation">
                                            <div class="allInfo">
                                                <p class="con-tea-info">Name : <?= $teacher['firstName'] . " " . $teacher['lastName'] ?></p><br>
                                                <p class="con-tea-info">Address 01 : <?= $teacher['addLine01'] ?></p><br>
                                                <p class="con-tea-info">Address 02 : <?= $teacher['addLine02'] ?></p><br>
                                                <p class="con-tea-info">Email : <?= $teacher['email'] ; ?></p><br>
                                                <p class="con-tea-info">Number : <?= $teacher['mobile']; ?></p>
                                                <p class="con-tea-info" id="teacherViewSubject">Subject : <?= $subject ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                               ?>
                        <div class="oneTeacherTile">
                                <button  class="but-teacher" id="but-AddTeacher" onclick="clickButton()"><img src="<?= base_url('public/img/add.svg') ?>"></button>
                        </div>
                    </div>

                    <!--   Update teacher Form-->
                    <?php include_once 'dashboard/updateTeacher.php';?>

                    <!-- Update teacher pop up js script -->
                    <script src="../../public/js/updateTeacher.js"></script>

                    <!--   Delete teacher-->
                    <?php include_once 'dashboard/deleteTeacher.php'?>

                    <!--  Delete teacher JS-->
                    <script src="../../public/js/deleteTecher.js"></script>


<!--                    <div class="anchor-1">-->
<!--                        <button class="but-teacher" id="but-AddTeacher" onclick="clickButton()">Add Teacher</button>-->
<!--                    </div>-->
                </div>

                <!-- Add teacher page pop up box -->
                <?php include_once 'dashboard/addTeacher.php';?>

                <!-- Add Teacher pop up box js script -->
                <script src="../../public/js/addTeacher.js"></script>

<!-- Content Creators List -->


                <div class="content-1">
                    <p>Content Creator &nbsp;&nbsp;&nbsp;</p>
                </div>

                <?php

                $contentCreators = $adminDashboardController->getAllContentCreators();
                ?>
                <div class="allTeacherSet">
                    <?php
                    if($contentCreators){
                        foreach($contentCreators as $contentCreator){

                            $creatorId = $contentCreator['userId'];
                            $subject = $adminDashboardController->getContentCreatorSubject($creatorId);
                            ?>
                            <div class="oneTeacherTile">
                                <div class="iconDiv">

                                    <button class="Update-teacher" id="but-ContentCreator" onclick="showUpdateCreatorForm('<?php echo $contentCreator['userId']; ?>','<?php echo  $contentCreator['firstName']; ?>','<?php echo $contentCreator['lastName']; ?>','<?php echo  $contentCreator['addLine01']; ?>','<?php echo  $contentCreator['addLine02']; ?>','<?php echo  $contentCreator['mobile']; ?>','<?php echo  $contentCreator['email']; ?>')" ><img src="../../public/img/update.svg"></button>
                                    <button class="delete-teacher" id="but-ContentCreatorDelete" onclick="showDeleteCreatorForm('<?php echo $contentCreator['userId']; ?>')"><img src="../../public/img/delete.svg"></button>

                                </div>
                                <div class="profilePic">
                                    <div class="profilePicBorder">
                                        <?php
                                        $UserProfilePhoto = new profilePhotoViewController();
                                        $UserProfilePhoto->getProfilePhotoUsers($creatorId);
                                        ?>
                                    </div>
                                </div>
                                <div class="userInformation">
                                    <div class="allInfo">
                                        <p class="con-tea-info">Name : <?= $contentCreator['firstName'] . " " . $contentCreator['lastName'] ?></p><br>
                                        <p class="con-tea-info">Address 01 : <?= $contentCreator['addLine01'] ?></p><br>
                                        <p class="con-tea-info">Address 02 : <?= $contentCreator['addLine02'] ?></p><br>
                                        <p class="con-tea-info">Email : <?= $contentCreator['email'] ; ?></p><br>
                                        <p class="con-tea-info">Number : <?= $contentCreator['mobile']; ?></p>
                                        <p class="con-tea-info" id="creatorViewSubject">Subject : <?= $subject ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="oneTeacherTile">
                        <button class="but-teacher" id="but-content" onclick="addCreator()"><img src="../../public/img/add.svg"></button>
                    </div>
                </div>


    <!--    Update content creator      -->
    <?php include_once 'dashboard/updateContentCreator.php';?>

    <!--    Update content creator js-->
    <script src="../../public/js/updateContentCreator.js"></script>

    <!--    Delete Content creator popup Box-->
    <?php include_once 'dashboard/deleteContentCreator.php';?>

    <!--delete content creator popup box js script-->
    <script src="../../public/js/deleteContentCreator.js"></script>

    <!--  Add content creator popup box  -->
    <?php include_once 'dashboard/addContentCreator.php';?>

    <!-- Add Content Creator pop up box js script -->
    <script src="../../public/js/addContentCreator.js"></script>

    <?php
    if(isset($_SESSION['add_Teacher'])){
        echo"
                <style>
                        .popup{
                            display:flex;
                        }
                </style>
            ";
        unset($_SESSION['add_Teacher']);
    }
    if(isset($_SESSION['update_Teacher'])){
        echo"
                <style>
                      .popup-update{
                         display:flex;
                      }
                </style>
            ";
        unset($_SESSION['update_Teacher']);
    }

    if(isset($_SESSION['add_Creator'])){
        echo"
                <style>
                        .popup-addContentCreator{
                            display:block;
                        }
                </style>
           ";
        unset($_SESSION['add_Creator']);
    }

    if(isset($_SESSION['upp_Creator'])){
        echo"
                <style>
                        .update-ContentCreatorPop{
                            display:flex;
                        }
                </style>
           ";
        unset($_SESSION['upp_Creator']);
    }

    ?>

<!--                unset all session-->

                <?php
                unset($_SESSION['user']['firstName']);
                unset($_SESSION['user']['lastName']);
                unset($_SESSION['user']['addLine01']);
                unset($_SESSION['user']['addLine02']);
                unset($_SESSION['user']['mobile']);
                unset($_SESSION['user']['email']);
                unset($_SESSION['user']['userId']);

                
                ?>

    </body>
</html>

