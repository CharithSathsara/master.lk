<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Theory Content</title>
    <link rel="stylesheet" href="../../public/css/addTheory.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <style>
    .ql-editor {
        height: 160px;
    }
    </style>

    <!-- <script src="../../public/js/addTheoryContent.js"></script> -->


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
    <div class="content">
        <div class="container">
            <div class="contentecreator-container">
                <div class="title"><b>Add New Theory Contents</b></div>
                <div class="sub-elements">
                    <p class="sub-title"><b>Theory Contents&nbsp;&nbsp;&nbsp;</b>
                        <hr class="hr-line">
                    </p>
                    <div>

                        <form
                            action="../../controller/contentCreatorController/theoryContentController/addTheoryContentController.php"
                            method="post" onsubmit="addContentOnSubmit()">


                            <div class="selectSubject">
                                <p id="add_theory-heading">You can add Theory Content to <?= $_SESSION['subject']; ?>
                                    subject:</p><br>
                            </div>
                            <div class="selectTopic">
                                <label class="topic-label">Select Topic:</label>
                                <select id="selecttopic" name="topicId" style="margin-right: 8vw" required>
                                    <?php

                                $topics = $viewTheoryContentController->getAllTopics($_SESSION['subject']);
                                
                                foreach($topics as $topic){
                                    echo "<option value=\"{$topic['topicId']}\">{$topic['topicTitle']}</option>";
                                }

                                ?>

                                </select>

                            </div>
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

                            <img src="../../public/img/addTheory1.svg" id="fixed-image2">

                            <div class="textContent">
                                <input name="editor1" type="hidden" id="editor1">
                                <div id="editorcontent1"></div>
                                <!-- <textarea name="editor1" id="editor1" class="ckeditor">Add Text Content Here</textarea> -->
                            </div>

                            <div class="btns">
                                <a href="contentCreatorDashboard.php" class="back-btn">Back</a>
                                <button type="submit" name="add-btn" id="add-btn" class="add-btn">Add</button>

                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote', 'code-block'],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }], // superscript/subscript
        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent
        [{
            'direction': 'rtl'
        }], // text direction

        [{
            'size': ['small', false, 'large', 'huge']
        }], // custom dropdown
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme
        [{
            'font': []
        }],
        [{
            'align': []
        }],
        ['link', 'image'],

        ['clean'] // remove formatting button
    ];
    var options = {
        modules: {
            toolbar: toolbarOptions
        },
        debug: 'info',
        placeholder: 'Add Theory Content Here...',
        readOnly: false,
        theme: 'snow'
    };
    var container = document.getElementById("editorcontent1");
    var editor = new Quill(container, options);

    function addContentOnSubmit() {
        var addhtml = document.getElementById("editorcontent1").children[0].innerHTML;
        document.getElementById("editor1").value = addhtml;
    }
    </script>

</body>

</html>