<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/updateSubjectDescription.css">
    <title>Update Description</title>
</head>
<body>

    <?php
        include_once('../../../controller/authController/authentication/Authentication.php');
        include_once('../../../controller/authController/authorization/Authorization.php');

        //User Authentication
        Authentication::userAuthentication();
        //User Authorization
        Authorization::authorizingAdmin();
    ?>
    <div class="mainDiv-updatePhysicsSubject" id="mainDiv-updatePhysicsSubject">
        <div class="container-update" id="container-updatePhysics">
            <div class="header-updateDescriptionSection">
                <p>Update Physics Description</p>
                <div class="close-Pop" id="close-updatePhysics">
                    <button onclick="closeUpdatePhysicsPopBox()"><img src="../../../public/img/close.png"></button>
                </div>
            </div>

            <div class="second-updateDescription">
                <form class="update-subjectDescription-form" action="<?= base_url('controller/adminController/systemInformationController/updateSubjectDescriptionController.php') ?>" method="post">

                    <p>Description :</p>
                    <textarea class="description-details" name="PhysicsDescription"><?= $_SESSION['physics']['Description']?></textarea>
                    <p>Price :</p>
                    <input type="text" class="price-details" name="PhysicsName" value="<?= $_SESSION['physics']['Price']?>">

                    <div class="show-error">
                        <div class="error-message-updatePhysicsValidate" id="error-message-updatePhysicsValidate">
                            <?php include '../dashboard/validationMessage.php';?>
                        </div>
                        <input type="submit" name="updatePhysicsDescription" class="submitUpdatePhysics-buttonDescription" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>