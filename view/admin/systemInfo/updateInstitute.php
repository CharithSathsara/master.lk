<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/updateInstituteDetails.css">
    <title>Update Institute</title>
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

        <div class="updateInstitute-main" id="updateInstitute-main">
            <div class="UpdateSecond-section">
                <div class="header-section">
                    <p>Update Institute Details</p>
                    <div class="closeUpdateInstitute">
                        <button id="close-UpdateInstitute-Pop" onclick="closeUpdateInstitute()"><img src="../../../public/img/close.png"></button>
                    </div>
                </div>

                <div class="UpdateInstitute-form">
                    <form class="form-Update-institute" method="post" action="<?= base_url('controller/adminController/systemInformationController/updateInstituteController.php') ?>">

                        <input type="text" id="updateInstitute-name" name="instituteName" value="&nbsp;&nbsp;<?= $_SESSION['institute']['name']; ?>" >
                        <input type="email" id="updateInstitute-email" name="email" value="&nbsp;&nbsp;<?= $_SESSION['institute']['email']; ?>" >
                        <input type="text" id="updateInstitute-number" name="Number" value="&nbsp;&nbsp;<?= $_SESSION['institute']['Number']; ?>"  >
                        <input type="text" id="updateInstitute-fax" name="fax" value="&nbsp;&nbsp;<?= $_SESSION['institute']['fax']; ?>" >
                        <input type="text" id="updateInstitute-address1" name="address01" value="&nbsp;&nbsp;<?= $_SESSION['institute']['address01']; ?>" >
                        <input type="text" id="updateInstitute-address2" name="address02" value="&nbsp;&nbsp;<?= $_SESSION['institute']['address02']; ?>" >

                        <div class="error-div">
                            <div class="error-message-Update-institute" id="error-message-Update-institute">
                                <?php include "../dashboard/validationMessage.php"?>
                            </div>

                            <div class="submitButton-UpdateInstitute">
                                <input type="submit" name="UpdateInstitute-button" value="Update Institute">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>
