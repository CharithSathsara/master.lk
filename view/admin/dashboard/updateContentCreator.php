
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
    include_once('../../controller/authController/authentication/Authentication.php');
    include_once('../../controller/authController/authorization/Authorization.php');

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingAdmin();
    ?>

    <?php
        $allSubject = new allSubjectController();
        $subjects = $allSubject->getAllSubject();
    ?>


        <div class="update-ContentCreatorPop" id="update-ContentCreatorPop">
            <?php
            if(isset($_SESSION['upp_Creator'])){ ?>

                <div class="updatePop-contentCreator">
                    <div class="updatePop-contentCreatorHeader">
                        <h4>Update Content Creator</h4>
                        <div class="close-updateCreator">
                            <button onclick="closeUpCreator()"><img src="../../public/img/close.png" class="CloseContentCreatorPop" ></button>
                        </div>
                    </div>

                    <div class="update-contentCreatorForm">
                        <div class="forms-div">

                            <form class="UpdateContentCreator-form" action="<?= base_url('controller/adminController/dashboardController/updateContentCreatorController.php') ?>" method="POST">

                                <input type="text" name="fname"   value="<?= $_SESSION['user']['firstName'] ?>">
                                <input type="text" name="lname"    value="<?= $_SESSION['user']['lastName'] ?>">
                                <input type="text" name="address1"    value="<?= $_SESSION['user']['addLine01'] ?>">
                                <input type="text" name="address2"    value="<?= $_SESSION['user']['addLine02'] ?>">
                                <input type="text" name="number"    value="<?= $_SESSION['user']['mobile'] ?>">
                                <input type="email" name="email"    value="<?= $_SESSION['user']['email'] ?>">
                                <input type="text" name="userId"  class="Creator-userId" value="<?= $_SESSION['user']['userId'] ?>">

                                <div class="selectSub">
                                    <label id="select-subjectCreator" >Select the Subject : </label>
                                    <select name="subjects" id="subjects-creator" >
                                        <option value="" disabled selected hidden>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ----- Select a Subject -----</option>
                                        <?php
                                        foreach ($subjects as $subject){
                                            ?>
                                            <option value="<?php echo $subject['subjectTitle'] ;?>"><?= $subject['subjectTitle']; ?></option>
                                            <?php
                                        }
                                        //                                    ?>
                                    </select>
                                </div>

                                <div class="show-errorUpdateCreator">
                                    <div class="error-message-up-creator" id="error-message-up-creator">
                                        <?php include "validationMessage.php"?>
                                    </div>
                                    <input type="submit" name="updateContentCreator-button" value="Save" class="sub-UpdateContent" >
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

         <?php
                unset($_SESSION['user']['firstName']);
                unset($_SESSION['user']['lastName']);
                unset($_SESSION['user']['addLine01']);
                unset($_SESSION['user']['addLine02']);
                unset($_SESSION['user']['mobile']);
                unset($_SESSION['user']['email']);
                unset($_SESSION['user']['userId']);

            }else{ ?>


                <div class="updatePop-contentCreator">
                    <div class="updatePop-contentCreatorHeader">
                        <h4>Update Content Creator</h4>
                        <div class="close-updateCreator">
                            <button onclick="closeUpCreator()"><img src="../../public/img/close.png" class="CloseContentCreatorPop" ></button>
                        </div>
                    </div>

                    <div class="update-contentCreatorForm">
                        <div class="forms-div">

                            <form class="UpdateContentCreator-form" action="<?= base_url('controller/adminController/dashboardController/updateContentCreatorController.php') ?>" method="POST">

                                <input type="text" name="fname"  id="Creator-fname" value="">
                                <input type="text" name="lname"  id="Creator-lname"  value="">
                                <input type="text" name="address1"  id="Creator-address1"  value="">
                                <input type="text" name="address2"  id="Creator-address2"  value="">
                                <input type="text" name="number"  id="Creator-number"  value="">
                                <input type="email" name="email"  id="Creator-email"  value="">
                                <input type="text" name="userId" id="Creator-userId" value="">

                                <div class="selectSub">
                                    <label id="select-subjectCreator" >Select the Subject : </label>
                                    <select name="subjects" id="subjects-creator" >
                                        <option value="" disabled selected hidden>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ----- Select a Subject -----</option>
                                        <?php
                                        foreach ($subjects as $subject){
                                            ?>
                                            <option value="<?php echo $subject['subjectTitle'] ;?>"><?= $subject['subjectTitle']; ?></option>
                                            <?php
                                        }
                                        //                                    ?>
                                    </select>
                                </div>

                                <div class="show-errorUpdateCreator">
                                    <div class="error-message-up-creator" id="error-message-up-creator">
                                        <?php include "validationMessage.php"?>
                                    </div>
                                    <input type="submit" name="updateContentCreator-button" value="Save" class="sub-UpdateContent" >
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

        <?php    }

            ?>
        </div>
    </body>
</html>

