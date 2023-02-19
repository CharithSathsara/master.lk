<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Content Creator Dashboard</title>
    <link rel="stylesheet" href="../../public/css/addTheory.css">
    <?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="../../view/contentcreator/ckeditor/ckeditor.js"></script>

</head>

<body>
    <?php

include_once('../../config/app.php');
include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');

//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingContentCreator();

include_once '../common/header.php';
@include '../common/navBar-ContentCreator.php';

?>

    <div class="content">
        <div class="container">
            <div class="contentecreator-container">
                <div class="title"><b>Update Contents</b></div>
                <div class="sub-elements">
                    <p class="sub-title"><b>Theory Contents</b>
                        <hr class="hr-line">
                    </p>
                    <div>
                        <form action="" method="post">
                            <div class="selectSection">
                                <label class="sectionNo-label">Section No:</label>
                                <input type="text" id="sectionNo" name="sectionNo" required>
                            </div>
                            <div class="visibility">Visibility:
                                <input type="radio" value="Visible" name="radio-visibility" id="radio-visibility"
                                    required />
                                <label for="visible">Visible</label>
                                <input type="radio" value="Not Visisble" name="radio-visibility" id="radio-visibility"
                                    required />
                                <label for="not visible">Not Visible</label>

                            </div>

                            <div class="textContent">
                                <!-- <input type="text" id="sectionContent" name="sectionContent" -->
                                <!-- placeholder="Add Text Content Here" required> -->
                                <textarea name="editor2" id="editor2" rows="10"
                                    cols="50">Add Text Content Here</textarea>
                            </div>

                            <div class="btns">
                                <a href="contentCreatorDashboard.php" class="back-btn">Back</a>
                                <input type="submit" name="add-btn" value="Update" id="updateTheory-btn"
                                    class="updateTheory-btn">


                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
    CKEDITOR.replace('editor2');
    </script>
</body>

</html>