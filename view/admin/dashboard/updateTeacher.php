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

                        <div id="popup-update" class="popup-update">
                            <div class="popup-UpdateTeacher">
                                <img src="<?= base_url('public/img/close.png') ?>" class="closeTeacher-Icon" id="closeTeacher-Icon" alt="close">

                                <div class="container">
                                    <div class="section1">
                                        <div class="addTeacherText">
                                            <h4>Update Teacher</h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- Teacher Update form -->
                                <div class="forms-div">

                                    <form class="UpdateTeach-form" action="<?= base_url('controller/adminController/dashboardController/updateTeacherController.php') ?>" method="POST" id="UpdateTeacher-form">
                                        <input type="text" name="fname"   id="teacher-fname" >
                                        <input type="text" name="lname"   id="teacher-lname" >
                                        <input type="text" name="address1" id="teacher-address1">
                                        <input type="text" name="address2" id="teacher-address2">
                                        <input type="text" name="number"   id="teacher-number">
                                        <input type="email" name="email"   id="teacher-email">
                                        <input type="text" name="username" id="teacher-username" >
                                        <input type="text" name="userId" id="teacher-userId" >

                                        <div class="selectSub">
                                            <label>Select the Subject : </label>
                                            <select name="subjects" id="subject" >
                                                    <option value="">Select Subject</option>
                                                <option value="Chemistry">Chemistry</option>
                                                <option value="Physics">Physics</option>
                                            </select>
                                        </div>

                                        <input type="submit" name="updateteacher-button" value="Save" class="subb-Update" id="updateTeacherSubmit">
                                    </form>
                                </div>

                            </div>
                        </div>

</body>
</html>
