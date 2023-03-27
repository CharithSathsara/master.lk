
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
                    <img src="../../public/img/close.png" class="CloseContentCreatorPop" >
                </div>

                <div class="update-contentCreatorForm">
                    <div class="forms-div">

                        <form class="UpdateContentCreator-form" action="<?= base_url('controller/adminController/dashboardController/updateContentCreatorController.php') ?>" method="POST">

                            <input type="text" name="fname"  id="Creator-fname">
                            <input type="text" name="lname"  id="Creator-lname">
                            <input type="text" name="address1"  id="Creator-address1">
                            <input type="text" name="address2"  id="Creator-address2">
                            <input type="text" name="number"  id="Creator-number">
                            <input type="email" name="email"  id="Creator-email">
                            <input type="text" name="userId" id="Creator-userId">

                            <div class="selectSub">
                                <label>Select the Subject : </label>
                                <select name="subjects" id="subjects" >
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

