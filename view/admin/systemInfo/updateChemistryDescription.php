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
    <div class="mainDiv-updateChemistrySubject" id="mainDiv-updateChemistrySubject">
        <div class="container-update" id="container-updateChemistry">
            <div class="header-updateDescriptionSection">
                <p>Update Chemistry Description</p>
                <div class="close-Pop" id="close-updateChemistry">
                    <button onclick="closeUpdateChemistryPopBox()"><img src="../../../public/img/close.png"></button>
                </div>
            </div>

            <div class="second-updateDescription">
                <form class="update-subjectDescription-form" action="<?= base_url('controller/adminController/systemInformationController/updateSubjectDescriptionController.php') ?>" method="post">

                    <p>Description :</p>
                    <textarea class="description-details" name="ChemistryDescription" > <?= $_SESSION['chemistry']['Description']?></textarea>
                    <script>
                        const textarea = document.querySelector('textarea');
                        textarea.addEventListener("keyup",e =>{
                            textarea.style.height = '130px';
                            let Height = e.target.scrollHeight;
                            textarea.style.height = `${Height}px`;
                        } );
                    </script>
                    <p>Price :</p>
                    <input type="text" class="price-details" name="ChemistryName" value="<?= $_SESSION['chemistry']['Price']?>">

                    <div class="show-error">
                        <div class="error-message-validate" id="error-message-updateChemistryValidate">
                            <?php include '../dashboard/validationMessage.php';?>
                        </div>
                        <input type="submit" name="updateChemistryDescription" class="submitUpdateChemistry-buttonDescription" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>