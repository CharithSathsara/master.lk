<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Content Creator Dashboard</title>
    <link rel="stylesheet" href="../../public/css/contentCreatorDashboard.css">
    <link rel="stylesheet" href="../../public/css/addTopic.css">
    <link rel="stylesheet" href="../../public/css/deleteTheory.css">
    <script src="../../public/js/addTopic.js"></script>
    <script src="../../public/js/deleteTheory.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">


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

$viewTheoryContentController = new ViewTheoryContentController();

include_once '../common/header.php';
@include '../common/navBar-ContentCreator.php';

?>

    <div class="container">
        <div class="contentecreator-container">
            <div class="title"><b>Dashboard</b></div>
            <div class="sub-elements">
                <p class="sub-title"><b>Theory Contents&nbsp;&nbsp;&nbsp;</b></p>
                <hr class="hr-line">
            </div>
            <div class="select">

                <form action="" class="view-form" method="get">
                    <div class="selectSubject">
                        <p id="add_theory-heading">You Can View Theory Content of the <?= $_SESSION['subject']; ?>
                            subject:</p>
                    </div>


                    <div class="selectTopic">
                        <div class="selecttopic">
                            <label class="topicLabel">Select Topic:</label>
                            <select id="selecttopic" name="selectTopic" style="margin-right: 8vw" required>
                                <?php

                                $topics = $viewTheoryContentController->getAllTopics($_SESSION['subject']);
                                
                                foreach($topics as $topic){
                                    echo "<option value=\"{$topic['topicId']}\">{$topic['topicTitle']}</option>";
                                }
                                
                                ?>
                            </select>


                            <input type="submit" name="view-btn" value="View" id="view-btn" class="view-btn">
                        </div>

                        <br>
                    </div>
                    <div class="add-btns">
                        <ul class="btn-list">
                            <li><a href="#" onclick="toggle1()" class="add-btn-topic" id="add-btn-topic">Add New
                                    Topic</a></li>
                            <li><a href="addTheory.php" class="add-btn-content">Add New Content</a></li>

                        </ul>
                    </div>



                </form>

            </div>


            <img src="../../public/img/fixed-img1.svg" id="fixed-image1">



            <table class="content-table">
                <?php

            if(isset($_GET['view-btn'])){
                $content = $viewTheoryContentController->viewTheoryContents( $_GET['selectTopic']);
                if(mysqli_num_rows($content) > 0){
                foreach($content as $row){
            ?>

                <tr class="sectionTable" <?php $_SESSION['contentId'] = $row['contentId'];
                        ?>>
                    <td class="sectionRow" style="font-size: 14px;"><b>Section
                            No.<?=$row['contentId'];;?></b><br><?=$row['content']?><br>

                        <i style="font-size:12px;">Published at
                            <?=$row['date_published']?> by <?=$row['firstName']?> <?=$row['lastName']?></i>
                    </td>
                    <form action="" method="get">


                        <td class="row-icon"><a href="../../view/contentcreator/updateTheory.php"><img
                                    src="../../public/img/update.svg" alt="edit" id="editImg" name="editImg"
                                    width="24px" height="24px"></a>
                        </td>
                    </form>

                    <td class="row-icon"><a href="#" onclick="toggle2()"><img src="../../public/img/delete.svg"
                                alt="delete" id="deleteImg" width="24px" height="24px"></a>


                    </td>

                </tr>
                <?php   }
                    }
            }
                ?>

            </table>
            <br><br><br><br>
        </div>
    </div>
    </div>

    <div id="popup1">
        <div id="getAddTopicPopup">
            <a href="#" class="close-btn" onclick="toggle1()">&times;</a>
            <p class="popup1-title"><b>Add New Title</b></p>
            <form action="" class="addTopic-form" method="POST">
                <div class="selectSub">
                    <p id="add_theory-heading">You Can Add Topics to <?= $_SESSION['subject']; ?>
                        Subject:</p>
                </div>
                <div class="selectlesson">Select Lesson:
                    <select id="selectlesson" name="selectLesson">
                        <?php

                    $lessons = $viewTheoryContentController->getAllLessons($_SESSION['subject']);
                    
                    foreach($lessons as $lesson){
                        echo "<option value=\"{$lesson['lessonId']}\">{$lesson['lessonName']}</option>";
                    }

                    ?>
                    </select>
                </div>
                <div class="topic-title">Topic Title :
                    <input type="text" id="topicTitle" placeholder="Add new topic title here" required>
                </div>

                <input type="submit" name="addNewTopic-btn" value="Add" id="add-NewTopic-btn" class="add-NewTopic-btn">
        </div>


    </div>

    <!-- Delete Theory Content Confirmation Popup -->
    <div id="setDeleteTheoryPopup">
        <div id="popup2">

            <a href="#" class="close-btn" onclick="toggle2()">&times;</a>
            <img src="../../public/icons/delete-alert.png" width="30px" height="35px" alt="Delete Alert"
                class="delete-alert">
            <p class="popup1-title"><b>Delete Confirmation</b></p>
            <form
                action="../../controller/contentCreatorController/theoryContentController/deleteTheoryContentController.php"
                class="deleteTheory-form" method="POST">
                <p>Are you sure you want to Delete this Section? </p>
                <div class="delete-confirmation-btns">
                    <input type="submit" name="deleteTheory-Yes-btn" value="Yes" id="deleteTheory-Yes-btn"
                        class="deleteTheory-Yes-btn">
                    <input type="submit" name="deleteTheory-No-btn" value="No" id="deleteTheory-No-btn"
                        class="deleteTheory-No-btn" onclick="toggle2()">
                </div>
            </form>

        </div>
    </div>



</body>

</html>