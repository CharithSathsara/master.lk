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

<div class="popup-addContentCreator">
    <div class="add-contentCreatorPop">
        <div class="update-ContentCreatorHeaderPop">
            <h4>Add New Content Creator</h4>
            <img src="../../../public/img/close.png" class="CloseContentPop">
        </div>
        <!-- Add content creator popup form  -->
        <div class="update-contentCreatorForm">
            <div class="forms-div">

                <form class="UpdateTeach-form" action="../../../controller/adminController/dashboardController/addTeacherController.php" method="POST">
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

</body>
</html>
