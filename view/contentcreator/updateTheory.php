<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Content Creator Dashboard</title>
    <link rel="stylesheet" href="../../public/css/addTheory.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="../../view/contentcreator/ckeditor/ckeditor.js"></script>

</head>

<body>
    <?php


include_once('../../controller/authController/authentication/Authentication.php');
include_once('../../controller/authController/authorization/Authorization.php');
include('../../controller/contentCreatorController/theoryContentController/viewTheoryContentController.php');

//check user authenticated or not
//$authentication = new Authentication();
//$authentication->authorizingAdmin();

//User Authentication
Authentication::userAuthentication();
//User Authorization
Authorization::authorizingContentCreator();

include_once '../common/header.php';
@include '../common/navBar-ContentCreator.php';

$viewTheoryContentController = new ViewTheoryContentController();

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
                        <form action="" method="get">
                        </form>


                        <form
                            action="../../controller/contentCreatorController/theoryContentController/updateTheoryContentController.php"
                            method="post">


                            <div class="textContent">
                                <?php

                            
                                $content = $viewTheoryContentController->viewGivenNoContent( $_SESSION['contentId']);
                                if(mysqli_num_rows($content) > 0){
                                    foreach($content as $row){
                            
                                ?>
                                <textarea name="editor2" id="editor2"><?=$row['content'] ?></textarea>
                                <br>
                                <div class="visibility">Visibility:
                                    <input type="radio" value="Visible" name="radio-visibility" id="radio-visibility"
                                        required />
                                    <label for="visible">Visible</label>
                                    <input type="radio" value="Not Visisble" name="radio-visibility"
                                        id="radio-visibility" required />
                                    <label for="not visible">Not Visible</label>

                                </div>
                                <?php   }
                                }
                                
                                ?>



                            </div>
                            <br>



                            <div class="btns">
                                <a href="contentCreatorDashboard.php" class="back-btn">Back</a>
                                <input type="submit" name="update-btn" value="Update" id="updateTheory-btn"
                                    class="updateTheory-btn">
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

        <script>
        CKEDITOR.replace('editor2');
        </script>
</body>

</html>