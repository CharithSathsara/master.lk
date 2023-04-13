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
//    include ('../../../config/app.php');

    $currentDir = __DIR__;
    include_once $currentDir . '\..\..\..\controller\adminController\dashboardController\allSubjectController.php';

    $allSubject = new allSubjectController();
    $subjects = $allSubject->getAllSubject();
?>

    <div class="popup">
        <div class="popup-AddTeacher">
            <img src="<?= base_url('public/img/close.png') ?>" class="close-Icons" alt="close">

            <div class="container">
                <div class="section1">
                    <div class="addTeacherText">
                        <h4>Add New Teacher</h4>
                    </div>

                </div>
            </div>
            <!-- Teacher Add form -->
            <div class="forms-div">
                <form class="addTeach-form" action="<?= base_url('controller/adminController/dashboardController/addTeacherController.php') ?>" method="POST">
                    <input type="text" name="fname" placeholder="Full Name" required>
                    <input type="text" name="lname" placeholder="Last Name" required>
                    <input type="text" name="address1" placeholder="Address Line 1" required>
                    <input type="text" name="address2" placeholder="Address Line 2" required>
                    <input type="text" name="number" placeholder="Telephone Number" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="username" placeholder="User name" required>

                    <div class="selectSub">
                        <label >Select the Subject : </label>
                        <select style="width: 6vw; border-radius: 5px; margin-left: 7vw; border: none; height: 4vh" name="subjects" id="subjects" >
                            <?php
                            foreach ($subjects as $dat){
                                ?>
                                <option value="<?php echo $dat['subjectTitle'] ?>"><?php echo $dat['subjectTitle'] ?></option>
                          <?php  } ?>
                        </select>
                    </div>
                    <textarea name="qualification" placeholder="Qualification"></textarea>
                    <input type="submit" name="addteacher-button" value="Save" class="subb-button">
                </form>
            </div>

        </div>
    </div>

</body>
</html>
