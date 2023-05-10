<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/addSubjectDescription.css">
    <title>Subject Description</title>
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
        <div class="mainDiv-addSubject">
            <div class="container-add" id="container-addPhysics">
               <div class="header-AddDescriptionSection">
                   <p>Add Physics Description</p>
                   <div class="close-Pop" id="close-addPhysics">
                       <button onclick="closeAddPopBox()"><img src="../../../public/img/close.png"></button>
                   </div>
               </div>

                <div class="second-addDescription">
                    <form class="add-subjectDescription-form" action="<?= base_url('controller/adminController/systemInformationController/addSubjectDescriptionController.php') ?>" method="post">

                        <p>Description :</p>
                        <textarea class="description-details" name="physicsDescription"></textarea>
                        <p>Price :</p>
                        <input type="text" class="price-details" name="physicsName">

                        <div class="show-error">
                            <div class="error-message-validate" id="error-message-validate">
                                <?php include '../dashboard/validationMessage.php';?>
                            </div>
                            <input type="submit" name="addPhysicsDescription" class="submit-buttonDescription" value="Save">
                        </div>
                    </form>
                </div>
            </div>


            <div class="container-add" id="container-addChemistry">
                <div class="header-AddDescriptionSection">
                    <p>Add Chemistry Description</p>
                    <div class="close-Pop"  id="close-addChemistry">
                        <button onclick="closeAddPopBox()"><img src="../../../public/img/close.png"></button>
                    </div>
                </div>

                <div class="second-addDescription">
                    <form class="add-subjectDescription-form" action="<?= base_url('controller/adminController/systemInformationController/addSubjectDescriptionController.php') ?>" method="post">

                        <p>Description :</p>
                        <textarea class="description-details" name="ChemistryDescription"></textarea>
                        <p>Price :</p>
                        <input type="text" class="price-details" name="ChemistryName">

                        <div class="show-error">
                            <div class="error-message-validate" id="error-message-ChemistryValidate" >
                                <?php include '../dashboard/validationMessage.php';?>
                            </div>
                            <input type="submit" name="addChemistryDescription" class="submit-buttonDescription" value="Save">
                        </div>
                    </form>
                </div>

            </div>
        </div>
</body>
</html>
