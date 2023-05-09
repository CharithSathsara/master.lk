<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/addInstitute.css">
    <title>Add Institute</title>
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
        <div class="main-AddSection" id="main-AddSection">
            <div class="AddSecond-section">
                <div class="header-section">
                    <p>Add Institute Details</p>
                    <div class="closeAddInstitute">
                        <button id="close-addInstitute-Pop" onclick="closeAddInstitute()"><img src="../../../public/img/close.png"></button>
                    </div>
                </div>

                <div class="addInstitute-form">
                    <form class="form-add-institute" method="post" action="<?= base_url('controller/adminController/systemInformationController/addInstituteDetailsController.php') ?>">

                        <input type="text" name="instituteName" placeholder="  Institute Name">
                        <input type="email" name="email" placeholder="  Institute Email">
                        <input type="text" name="Number" placeholder="  Institute Number">
                        <input type="text" name="fax" placeholder="  Institute Fax">
                        <input type="text" name="address01" placeholder="  Institute Address Line 01">
                        <input type="text" name="address02" placeholder="  Institute Address Line 02">

                        <div class="error-div">
                            <div class="error-message-add-institute" id="error-message-add-institute">
                                <?php include "../dashboard/validationMessage.php"?>
                            </div>

                            <div class="submitButton-addInstitute">
                                <input type="submit" name="addInstitute-button" value="Add Institute">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>
