
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


        <div class="update-ContentCreatorPop" id="update-ContentCreatorPop">
            <div class="updatePop-contentCreator">
                <div class="updatePop-contentCreatorHeader">
                    <h4>Update Content Creator</h4>
                    <button onclick="closeUpCreator()"><img src="../../public/img/close.png" class="CloseContentCreatorPop" ></button>
                </div>
                <div class="error-message-up-creator" id="error-message-up-creator">
                    <?php include "validationMessage.php"?>
                </div>

                <div class="update-contentCreatorForm">
                    <div class="forms-div">

                        <form class="UpdateContentCreator-form" action="<?= base_url('controller/adminController/dashboardController/updateContentCreatorController.php') ?>" method="POST">

                            <input type="text" name="fname"  id="Creator-fname" value="<?= $_SESSION['user']['firstName'] ?>">
                            <input type="text" name="lname"  id="Creator-lname"  value="<?= $_SESSION['user']['lastName'] ?>">
                            <input type="text" name="address1"  id="Creator-address1"  value="<?= $_SESSION['user']['addLine01'] ?>">
                            <input type="text" name="address2"  id="Creator-address2"  value="<?= $_SESSION['user']['addLine02'] ?>">
                            <input type="text" name="number"  id="Creator-number"  value="<?= $_SESSION['user']['mobile'] ?>">
                            <input type="email" name="email"  id="Creator-email"  value="<?= $_SESSION['user']['email'] ?>">
                            <input type="text" name="userId" id="Creator-userId" value="<?= $_SESSION['user']['userId'] ?>">

                            <div class="selectSub">
                                <label>Select the Subject : </label>
                                <select name="subjects" id="subjects" style="width: 6vw; border-radius: 5px; margin-left: 9vw; border: none; height: 4vh; margin-top: -60px">
                                    <?php
                                        foreach ($subjects as $subject){
                                            ?>
                                            <option value="<?php echo $subject['subjectTitle'] ;?>"><?= $subject['subjectTitle']; ?></option>
                                    <?php
                                        }
//                                    ?>
                                </select>
                            </div>

                            <input type="submit" name="updateContentCreator-button" value="Save" class="subb-Update" style="background-color: #0b2e5e; color: #D9D9D9; border-radius: 10px">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>

