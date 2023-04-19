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

    include_once('../../controller/adminController/dashboardController/AdminDashboardController.php');
    include_once('../../controller/adminController/dashboardController/allSubjectController.php');
    include_once('../../model/User.php');
    include_once('../../model/Admin.php');
    include_once ('../../model/Subject.php');
    include_once ('../../model/Teacher.php');
    include_once('../common/header.php');
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
                    <table  class="styled-table"  cellspacing="0">

                        <?php

                        $adminDashboardController = new AdminDashboardController();
                        $teachers = $adminDashboardController->getAllTeachers();

                        if($teachers){
                            foreach($teachers as $teacher){

                                $teacherId = $teacher['userId'];
                                $subject = $adminDashboardController->getTeacherSubject($teacherId);
                                ?>
                                <tr>
                                    <td class="td-1"><?= $teacher['firstName'] ." ". $teacher['lastName'] ?></td>

                                    <td class="td-1"><?= $subject ?></td>
<!--    Update teacher button   -->
                                    <td class="td-2"><button class="Update-teacher" id="but-UpdateTeacher" onclick="showUpdateTeacherForm('<?php echo $teacher['userId']; ?>','<?php echo  $teacher['firstName']; ?>','<?php echo $teacher['lastName']; ?>','<?php echo  $teacher['addLine01']; ?>','<?php echo  $teacher['addLine02']; ?>','<?php echo  $teacher['mobile']; ?>','<?php echo  $teacher['email']; ?>')"><img src="../../public/img/update.svg"></button></td>
<!-- Delete teacher button -->
                                    <td class="td-2"><button class="delete-teacher" id="but-deleteTeacher" onclick="showDeleteTeacherForm('<?php echo $teacher['userId']; ?>')" ><img src="../../public/img/delete.svg"></button></td>
                                </tr>

                                <?php
                            }
                        } else{
                            echo "No Record Found";
                        }
                               ?>
                    </table>

                    <!--   Update teacher Form-->
                    <?php include_once 'dashboard/updateTeacher.php';?>

                    <!-- Update teacher pop up js script -->
                    <script src="../../public/js/updateTeacher.js"></script>

                    <!--   Delete teacher-->
                    <?php include_once 'dashboard/deleteTeacher.php'?>

                    <!--  Delete teacher JS-->
                    <script src="../../public/js/deleteTecher.js"></script>


                    <div class="anchor-1">
                        <button class="but-teacher" id="but-AddTeacher" onclick="clickButton()">Add Teacher</button>
                    </div>
                </div>

                <!-- Add teacher page pop up box -->
                <?php include_once 'dashboard/addTeacher.php';?>

                <!-- Add Teacher pop up box js script -->
                <script src="../../public/js/addTeacher.js"></script>

<!-- Content Creators List -->

                <div class="content-1">
                    <p>Content Creator &nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="getContentCreator">
                    <table class="styled-table" cellspacing="0" style="border-radius: 10px;">
                        <tbody>
                        <?php

                        $contentCreators = $adminDashboardController->getAllContentCreators();

                        if($contentCreators){
                            foreach($contentCreators as $contentCreator){
                                ?>
                                <tr>
                                    <td class="td-1"><?= $contentCreator['firstName'] ." ". $contentCreator['lastName'] ?></td>
                                    <?php

                                    $creatorId= $contentCreator['userId'];
                                    $subject = $adminDashboardController->getContentCreatorSubject($creatorId);

                                    ?>
                                    <td class="td-1"><?= $subject ?></td>
<!--   Update content creator button  -->
                                    <td class="td-2"><button class="Update-ContentCreator" id="but-ContentCreator" onclick="showUpdateCreatorForm('<?php echo $contentCreator['userId']; ?>','<?php echo  $contentCreator['firstName']; ?>','<?php echo $contentCreator['lastName']; ?>','<?php echo  $contentCreator['addLine01']; ?>','<?php echo  $contentCreator['addLine02']; ?>','<?php echo  $contentCreator['mobile']; ?>','<?php echo  $contentCreator['email']; ?>')" ><img src="../../public/img/update.svg"></button></td>
<!--   Delete content creator button  -->
                                    <td class="td-2"><button class="Update-ContentCreator" id="but-ContentCreatorDelete" onclick="showDeleteCreatorForm('<?php echo $contentCreator['userId']; ?>')"><img src="../../public/img/delete.svg"></button></td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            echo "No Record Found";
                        }
                        ?>
                        </tbody>
                    </table>
                        <div class="anchor-2">
                             <button class="but-content" id="but-content" onclick="addCreator()">Add Content Creator</button>
                        </div>
                </div>
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


    </body>
</html>

