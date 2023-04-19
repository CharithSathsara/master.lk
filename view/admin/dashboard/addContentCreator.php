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
                    <img src="<?= base_url('public/img/close.png') ?>" class="CloseContentPop">
                </div>
                <div class="error-message-add-content" id="error-message-add-content">
                    <?php include "validationMessage.php"?>
                </div>
                <!-- Add content creator popup form  -->
                <div class="update-contentCreatorForm">
                    <div class="forms-div">

                        <form class="UpdateContent-form" action="<?= base_url('controller/adminController/dashboardController/addContentCreatorController.php') ?>" method="POST">
                            <!--                <label class="teachrHead"><b>Add Teacher</b></label>-->
                            <input type="text" name="fname" placeholder="Full Name" >
                            <input type="text" name="lname" placeholder="Last Name" >
                            <input type="text" name="address1" placeholder="Address Line 1" >
                            <input type="text" name="address2" placeholder="Address Line 2" >
                            <input type="text" name="number" placeholder="Telephone Number" >
                            <input type="email" name="email" placeholder="Email" >
                            <input type="text" name="username" placeholder="User name" >
        <!--                    <input type="password" name="password" placeholder="Password" >-->
                            <div class="selectSub">
                                <label>Select the Subject : </label>
                                <select name="subjects" id="subjects" style="width: 6vw; border-radius: 5px; margin-left: 9vw; border: none; height: 4vh; margin-top: -60px">
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Physics">Physics</option>
                                </select>
                            </div>
                            <!-- <textarea name="qualification" placeholder="Qualification"></textarea>-->
                            <input type="submit" name="addContentCreator-button" value="Save" class="subb-add" style="color: #D9D9D9">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>