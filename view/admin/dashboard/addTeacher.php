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
  //  include ('../../../config/app.php');
   // session_start();

    $currentDir = __DIR__;
    include_once $currentDir . '\..\..\..\controller\adminController\dashboardController\allSubjectController.php';

    $allSubject = new allSubjectController();
    $subjects = $allSubject->getAllSubject();
?>

    <div class="popup">
        <div class="popup-AddTeacher">
            <div class="add-teacher-header">
                <h4>Add New Teacher</h4>
                <img src="<?= base_url('public/img/close.png') ?>" id="close-add" alt="close">
            </div>
            <div class="error-message-add-teacher" id="error-message-add-teacher">
                <?php include "validationMessage.php"?>
            </div>
            <!-- Teacher Add form -->
            <div class="forms-div">
                <form class="addTeach-form" action="<?= base_url('controller/adminController/dashboardController/addTeacherController.php') ?>" method="POST">
                    <input type="text" name="fname" placeholder="Full Name" >
                    <input type="text" name="lname" placeholder="Last Name" >
                    <input type="text" name="address1" placeholder="Address Line 1" >
                    <input type="text" name="address2" placeholder="Address Line 2" >
                    <input type="text" name="number" placeholder="Telephone Number" >
                    <input type="email" name="email" placeholder="Email" >
                    <input type="text" name="username" placeholder="User name" >

                    <div class="selectSub">
                        <label >Select the Subject : </label>
                        <select style="width: 6vw; border-radius: 5px; margin-left: 10vw; border: none; height: 4vh; margin-top: -60px" name="subjects" id="subjects" >
                            <?php
                            foreach ($subjects as $dat){
                                ?>
                                <option value="<?php echo $dat['subjectTitle'] ?>"><?php echo $dat['subjectTitle'] ?></option>
                          <?php  } ?>
                        </select>
                    </div>
                    <textarea name="qualification" placeholder="Qualification" style="margin-top: -10px"></textarea>
                    <input type="submit" name="addteacher-button" value="Save"  id="add-teacherButton">
                </form>
            </div>

        </div>
    </div>

</body>
</html>
