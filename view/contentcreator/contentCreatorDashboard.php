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

    <div class="container">
        <div class="contentecreator-container">
            <div class="title"><b>Dashboard</b></div>
            <div class="sub-elements">
                <p class="sub-title"><b>Theory Contents</b></p>
                <hr class="hr-line">
            </div>
            <div class="select">

                <form action="" class="view-form" method="POST">
                    <div class="selectSubject">Select Subject:
                        <input type="radio" value="Physics" name='radio' id='physics' />
                        <label for="physics">Physics</label>
                        <input type="radio" value="Chemistry" name='radio' id='chemistry' />
                        <label for="chemistry">Chemistry</label>
                    </div>

                    <br>
                    <div class="selectTopic">
                        <div class="selecttopic">
                            <label class="topicLabel">Select Topic:</label>
                            <select id="selecttopic" name="selectTopic">
                                <option value="Organic Introduction">Organic Introduction</option>
                                <option value="IUPAC Nomenclature">IUPAC Nomenclature</option>
                                <option value="S Block">S Block</option>
                                <option value="P Block">P Block</option>
                                <option value="Force and Motion">Force and Motion</option>
                                <option value="Work, Energy and Power">Work, Energy and Power</option>
                            </select>


                            <input type="submit" name="view-btn" value="View" id="view-btn" class="view-btn">
                        </div>

                        <br><br>
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


            <table class="content-table">

                <tr class="sectionTable">
                    <td class="sectionRow">Section No.</td>
                    <td class="row-icon"><a href="../../view/contentcreator/updateTheory.php"><img
                                src="../../public/icons/edit.png" alt="edit" id="editImg" width="16px"
                                height="16px"></a>
                    </td>

                    <td class="row-icon"><a href="#" onclick="toggle2()"><img src="../../public/icons/delete.png"
                                alt="delete" id="deleteImg" width="16px" height="16px"></a>


                    </td>

                </tr>


            </table>
            <br><br><br><br><br><br>
        </div>
    </div>
    </div>

    <div id="popup1">
        <div id="getAddTopicPopup">
            <a href="#" class="close-btn" onclick="toggle1()">&times;</a>
            <p class="popup1-title"><b>Add New Title</b></p>
            <form action="" class="addTopic-form" method="POST">
                <div class="selectSub">Select Subject:
                    <select id="select-Sub" name="select-Sub">
                        <option value="Physics">Physics</option>
                        <option value="Chemistry">Chemistry</option>
                    </select>
                </div>
                <div class="selectlesson">Select Topic:
                    <select id="selectlesson" name="selectLesson">
                        <option value="Organic Introduction">Organic Introduction</option>
                        <option value="IUPAC Nomenclature">IUPAC Nomenclature</option>
                        <option value="S Block">S Block</option>
                        <option value="P Block">P Block</option>
                        <option value="Force and Motion">Force and Motion</option>
                        <option value="Work, Energy and Power">Work, Energy and Power</option>
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
                        class="deleteTheory-No-btn">
                </div>


        </div>
    </div>



</body>

</html>