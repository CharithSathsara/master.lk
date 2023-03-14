<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/adminDashboard.css">

    <title>Admin Dashboard</title>
</head>
    <body>

    <?php

    include_once ('../../config/app.php');
    include_once('../../controller/adminController/dashboardController/AdminDashboardController.php');
    include_once ('../../controller/adminController/dashboardController/allSubjectController.php');
    include_once ('../../controller/adminController/dashboardController/deleteTeacherController.php');
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
<!--                        <tbody>-->
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
                                <div class="pass-para">
                                    <label class="user-id"> <?=  $teacher['userId'] ?> </label>
                                    <label class="first-name"> <?=  $teacher['firstName'] ?> </label>
                                    <label class="last-name"><?= $teacher['lastName'] ?></label>
                                    <label class="address-1"> <?=  $teacher['addLine01'] ?> </label>
                                    <label class="address-2"> <?=  $teacher['addLine02'] ?> </label>
                                    <label class="telephone-number"> <?=  $teacher['mobile'] ?> </label>
                                    <label class="email"> <?=  $teacher['email'] ?> </label>
                                    <label class="userName"> <?=  $teacher['userName'] ?> </label>
                                </div>

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
<!--                        </tbody>-->
                    </table>



                    <!--   Update teacher Form-->
                    <?php include_once '../admin/dashboard/updateTeacher.php';?>

                    <!-- Update teacher pop up js script -->
                    <script src="../../public/js/updateTeacher.js"></script>

                    <!--   Delete teacher-->
                    <?php include_once '../admin/dashboard/deleteTeacher.php'?>

                    <!--  Delete teacher JS-->
                    <script src="../../public/js/deleteTecher.js"></script>


                    <div class="anchor-1">
                        <button class="but-teacher" id="but-AddTeacher">Add Teacher</button>
                    </div>
                </div>

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
                                    <td class="td-2"><button class="Update-ContentCreator" id="but-ContentCreator" ><img src="../../public/img/update.svg"></button></td>
                                    <td class="td-2"><button class="Update-ContentCreator" id="but-ContentCreatorDelete" onclick="hello()"><img src="../../public/img/delete.svg"></button></td>
                                </tr>
<!--    Update content creator      -->
                                    <div class="update-ContentCreatorPop">
                                        <div class="updatePop-contentCreator">
                                            <div class="updatePop-contentCreatorHeader">
                                                <h4>Update Content Creator</h4>
                                                <img src="../../public/img/close.png" class="CloseContentCreatorPop" >
                                            </div>

                                            <div class="update-contentCreatorForm">
                                                <div class="forms-div">

                                                    <form class="UpdateContentCreator-form" action="../../controller/adminController/dashboardController/addTeacherController.php" method="POST">
                                                        <!--                <label class="teachrHead"><b>Add Teacher</b></label>-->
                                                        <input type="text" name="fname" placeholder="Full Name" required>
                                                        <input type="text" name="lname" placeholder="Last Name" required>
                                                        <input type="text" name="address1" placeholder="Address Line 1" required>
                                                        <input type="text" name="address2" placeholder="Address Line 2" required>
                                                        <input type="text" name="number" placeholder="Telephone Number" required>
                                                        <input type="email" name="email" placeholder="Email" required>
                                                        <input type="text" name="username" placeholder="User name" required>
                                                        <input type="password" name="password" placeholder="Password" required>
                                                        <div class="selectSub">
                                                            <label>Select the Subject : </label>
                                                            <select name="subjects" id="subjects" >
                                                                <!--            <option value="">Select Subject</option>-->
                                                                <option value="Chemistry">Chemistry</option>
                                                                <option value="Physics">Physics</option>
                                                            </select>
                                                        </div>
                                                        <!--                        <textarea name="qualification" placeholder="Qualification"></textarea>-->
                                                        <input type="submit" name="updateContentCreator-button" value="Save" class="subb-Update" style="background-color: #0b2e5e; color: #D9D9D9; border-radius: 10px">
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!--    Delete Content creator popup Box-->

                                    <div class="popup-deleteContent" id="Delete-contentPop">
                                        <div class="delete-contentPop">
                                            <div class="delete-headerContentPop">
                                                <img src="../../public/img/important.png" id="closeDelete-popBox">
                                                <h3>Delete Confirmation</h3>
                                            </div>
                                            <div class="deletePop-contentBody">
                                                <p>Are you sure you want to delete this Teacher?</p>
                                            </div>

                                            <div class="deletePop-contentButton">
                                                <button class="deleteContentYes-button" onclick="hi()">Yes</button>
                                                <button class="deleteContentNo-button" id="deleteContentNo-btn" onclick="Bye()">No</button>
                                            </div>
                                        </div>
                                    </div>
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
                             <button class="but-content" id="but-content">Add Content Creator</button>
                        </div>
                </div>
             </div>
        </div>

    <!-- Add teacher page pop up box -->
     <?php include_once '../admin/dashboard/addTeacher.php';?>

    <!-- Add Teacher pop up box js script -->
    <script src="../../public/js/addTeacher.js"></script>


    <!--  Add content creator popup box  -->
    <?php include_once '../admin/dashboard/addContentcreator.php';?>

    <!-- Add Content Creator pop up box js script -->
    <script src="../../public/js/addContentcreator.js"></script>



<!--delete content creator popup box js script-->
        <script>
            function hello(){
                document.querySelector(".popup-deleteContent").style.display ="flex";
                // document.querySelector("body").style.backgroundColor="rgba(0,0,0,0.6)";
            }

            function hi(){
                document.querySelector(".popup-deleteContent").style.display ="none";
            }

            function Bye(){
                document.querySelector(".popup-deleteContent").style.display ="none";
            }

            //     document.querySelector(".popup-deleteContent").style.display ="none";
            // })
        </script>

<!--    update content creator popup box js script-->

        <script>
            document.getElementById("but-ContentCreator").addEventListener("click",function (){
                document.querySelector(".update-ContentCreatorPop").style.display ="flex";
                // document.querySelector("body").style.backgroundColor ="rgba(0,0,0,0.6)";
            })

            document.querySelector(".CloseContentCreatorPop").addEventListener("click",function (){
                document.querySelector(".update-ContentCreatorPop").style.display ="none";
            })
        </script>

    </body>
</html>
