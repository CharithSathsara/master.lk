<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/adminDashboard.css">

    <title>Admin Dashboard</title>
</head>
    <body>

    <?php

    include_once('../../config/app.php');
    include('../../controller/adminController/dashboardController/AdminDashboardController.php');
    include('../../model/Admin.php');
    include_once('../common/header.php');
    include_once ('../common/navBar-Admin.php');
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
                        <tbody>
                        <?php

                        $adminDashboardController = new AdminDashboardController();

                        $teachers = $adminDashboardController->getAllTeachers();

                        if($teachers){
                            foreach($teachers as $teacher){
                                ?>
                                <tr>
                                    <td class="td-1"><?= $teacher['firstName'] ." ". $teacher['lastName'] ?></td>
                                    <?php

                                    $teacherId = $teacher['userId'];
                                    $subject = $adminDashboardController->getTeacherSubject($teacherId);

                                    ?>
                                    <td class="td-1"><?= $subject ?></td>
<!--    Update teacher button   -->
                                    <td class="td-2"><button class="Update-teacher" id="but-UpdateTeacher" ><img src="../../public/img/update.svg"></button></td>
<!-- Delete teacher button -->
                                    <td class="td-2"><button class="delete-teacher" id="but-deleteTeacher" ><img src="../../public/img/delete.svg"></button></td>
                                </tr>
                                    <div id="popup-update" class="popup-update">
                                        <div class="popup-UpdateTeacher">
                                            <img src="../../public/img/close.png" class="closeTeacher-Icon" alt="close">

                                            <div class="container">
                                                <div class="section1">
                                                    <div class="addTeacherText">
                                                        <h4>Update Teacher</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Teacher Update form -->
                                            <div class="forms-div">

                                                <form class="UpdateTeach-form" action="../../controller/adminController/dashboardController/updateTeacherController.php?id=<?= $teacher['userId'] ?>" method="POST" id="UpdateTeacher-form">
                                                    <!--                <label class="teachrHead"><b>Add Teacher</b></label>-->
                                                    <input type="text" name="fname" placeholder="Full Name" value=<?= $teacher['firstName'] ?> required>
                                                    <input type="text" name="lname" placeholder="Last Name" value=<?= $teacher['lastName'] ?> required>
                                                    <input type="text" name="address1" placeholder="Address Line 1" value=<?= $teacher['addLine01'] ?> required>
                                                    <input type="text" name="address2" placeholder="Address Line 2" value=<?= $teacher['addLine02'] ?> required>
                                                    <input type="text" name="number" placeholder="Telephone Number" value=<?= $teacher['mobile'] ?> required>
                                                    <input type="email" name="email" placeholder="Email" value=<?= $teacher['email'] ?> required>
                                                    <input type="text" name="username" placeholder="User name" value=<?= $teacher['userName'] ?> required>
                                                    <input type="password" name="password" placeholder="Password"  required>
                                                    <div class="selectSub">
                                                        <label>Select the Subject : </label>
                                                        <select name="subjects" id="subject" >
                                                            <!--            <option value="">Select Subject</option>-->
                                                            <option value="Chemistry">Chemistry</option>
                                                            <option value="Physics">Physics</option>
                                                        </select>
                                                    </div>
                                                    <!--                        <textarea name="qualification" placeholder="Qualification"></textarea>-->
                                                    <input type="submit" name="updateteacher-button" value="Save" class="subb-Update" id="updateTeacherSubmit">
                                                </form>
                                            </div>

                                        </div>
                                    </div>

<!--    Delete Teacher    -->
<!-- Delete confirmation box -->

                                    <div class="popup-delete" id="Delete-teacherPop">
                                        <div class="delete-teacherPop">
                                            <div class="delete-headerPop">
                                                <img src="../../public/img/important.png" id="closeDelete-popBox">
                                                <h3>Delete Confirmation</h3>
                                            </div>
                                            <div class="deletePop-teacherBody">
                                                <p>Are you sure you want to delete this Teacher?</p>
                                            </div>

                                            <div class="deletePop-teacherButton">
                                                <button class="deleteYes-button" id="deleteYes-btn">Yes</button>
                                                <button class="deleteNo-button" id="deleteNo-btn">No</button>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }
                        } else{
                            echo "No Record Found";
                        }
                               ?>
                        </tbody>
                    </table>
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

        <div class="popup">
            <div class="popup-AddTeacher">
                <img src="../../public/img/close.png" class="close-Icons" alt="close">

                <div class="container">
                    <div class="section1">
                        <div class="addTeacherText">
                            <h4>Add New Teacher</h4>
                        </div>
                    </div>
                </div>
<!-- Teacher Add form -->
                <div class="forms-div">

                    <form class="addTeach-form" action="../../controller/adminController/dashboardController/addTeacherController.php" method="POST">
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
                            <label >Select the Subject : </label>
                            <select name="subjects" id="subjects" style="margin-left: 10vw" >
                                <!--            <option value="">Select Subject</option>-->
                                <option value="Chemistry">Chemistry</option>
                                <option value="Physics">Physics</option>
                            </select>
                        </div>
                        <textarea name="qualification" placeholder="Qualification"></textarea>
                        <input type="submit" name="addteacher-button" value="Save" class="subb-button">
                    </form>
                </div>

            </div>
        </div>

<!-- Update teacher details -->







<!--  Add content creator popup box  -->
        <div class="popup-addContentCreator">
            <div class="add-contentCreatorPop">
                <div class="update-ContentCreatorHeaderPop">
                        <h4>Add New Content Creator</h4>
                        <img src="../../public/img/close.png" class="CloseContentPop">
                </div>
<!-- Add content creator popup form  -->
                <div class="update-contentCreatorForm">
                    <div class="forms-div">

                        <form class="UpdateTeach-form" action="../../controller/adminController/dashboardController/addTeacherController.php" method="POST">
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
                            <input type="submit" name="updateteacher-button" value="Save" class="subb-Update" style="color: #D9D9D9">
                        </form>
                    </div>
                </div>
            </div>
        </div>



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

<!-- Add Teacher pop up box js script -->
        <script>
            document.getElementById("but-AddTeacher").addEventListener("click",function (){
                document.querySelector(".popup").style.display ="flex";
                // document.querySelector("body").style.backgroundColor="rgba(0,0,0,0.6)";
            })

            document.querySelector(".close-Icons").addEventListener("click",function (){
                document.querySelector(".popup").style.display ="none";
            })
        </script>

<!-- Update teacher pop up js script -->

        <script>
            // document.getElementById("but-UpdateTeacher").addEventListener("click",function (){
            //     document.querySelector(".popup-update").style.display ="flex";
            //     document.querySelector("body").style.backgroundColor ="rgba(0,0,0,0.6)";
            // })
            //
            // document.querySelector(".closeIcon").addEventListener("click",function (){
            //     document.querySelector(".popup-update").style.display ="none";
            // })
            const form = document.getElementById("popup-update");
            const updateTeacherButton = document.querySelectorAll(".Update-teacher");

            // Loop through the update buttons and add a click event to each one
            updateTeacherButton.forEach(button => {
                button.addEventListener("click", () => {
                    // Toggle the form visibility
                    if (form.style.display === "none") {
                        form.style.display = "flex";
                    } else {
                        form.style.display = "none";
                    }
                });
            });

            document.querySelector(".closeTeacher-Icon").addEventListener("click",function (){
                document.querySelector(".popup-update").style.display ="none";
            });

        </script>

<!-- Delete teacher pop up js script -->

        <script>
            document.getElementById("but-deleteTeacher").addEventListener("click",function () {
                document.querySelector(".popup-delete").style.display = "flex";
                // document.querySelector("body").style.backgroundColor = "rgba(0,0,0,0.35)";
                // document.querySelector("body").style.zIndex = "100";
            })

            document.getElementById("deleteNo-btn").addEventListener("click",function (){
                document.querySelector(".popup-delete").style.display="none";
            })

            document.getElementById("deleteYes-btn").addEventListener("click",function (){
                document.querySelector(".popup-delete").style.display="none";
            })

            // const form = document.getElementById("Delete-teacherPop");
            // const updateTeacherButton = document.querySelectorAll(".delete-teacher");
            //
            // // Loop through the update buttons and add a click event to each one
            // updateTeacherButton.forEach(button => {
            //     button.addEventListener("click", () => {
            //         // Toggle the form visibility
            //         if (form.style.display === "none") {
            //             form.style.display = "flex";
            //         } else {
            //             form.style.display = "none";
            //         }
            //     });
            // });
            //
            // document.getElementById("closeDelete-popBox").addEventListener("click",function (){
            //     document.querySelector(".popup-delete").style.display ="none";
            // });
        </script>

    <!-- Add Content Creator pop up box js script -->

        <script>
            document.getElementById("but-content").addEventListener("click",function (){
                document.querySelector(".popup-addContentCreator").style.display ="flex";
                // document.querySelector("body").style.backgroundColor ="rgba(0,0,0,0.6)";
            })

            document.querySelector(".CloseContentPop").addEventListener("click",function (){
                document.querySelector(".popup-addContentCreator").style.display ="none";
            })
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
