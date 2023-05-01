<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Page Title -->
    <title>Update Theory Contents</title>

    <!-- Include Page CSS Files -->
    <link rel="stylesheet" href="../../public/css/updateTheory.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Include jQuery and Javascript Files -->
    <!-- <script src="../../public/js/updateTheoryContent.js"></script> -->

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Quill Editor Styling -->
    <style>
    .ql-editor {
        height: 286px;
    }
    </style>




</head>

<body>
    <?php

    // Include Controller Files
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
    
    // Include Header and Navigation Bar Files
    include_once '../common/header.php';
    @include '../common/navBar-ContentCreator.php';
    
     // Create an instance of the ViewTheoryContentController() Class
    $viewTheoryContentController = new ViewTheoryContentController();
    
    $id = $_GET['id'];
    
    

?>

    <div class="content">
        <div class="container">
            <div class="contentecreator-container">
                <!-- Title and SubTitle Section -->
                <div class="title"><b>Update Contents</b></div>
                <div class="sub-elements">
                    <p class="sub-title"><b>Theory Contents</b>
                        <hr class="hr-line">

                    </p>

                    <div>
                        <form action="" method="get">
                        </form>

                        <!-- Update Theory Content Form -->
                        <form
                            action="../../controller/contentCreatorController/theoryContentController/updateTheoryContentController.php?id=<?=$id?>"
                            method="post" onsubmit="addContentOnSubmit()">

                            <div class="visibility">Visibility:
                                <input type="radio" value="Visible" name="radio-visibility" id="radio-visibility"
                                    required />
                                <label for="visible">Visible</label>
                                <input type="radio" value="Not Visisble" name="radio-visibility" id="radio-visibility"
                                    required />
                                <label for="not visible">Not Visible</label>

                            </div>

                            <img src="../../public/img/update_fixed.svg" id="fixed-image3">

                            <div class="textContent">
                                <?php
                                // Get Relevant Theory Content
                                
                                
                                $content = $viewTheoryContentController->viewGivenNoContent( $id);
                                if(mysqli_num_rows($content) > 0){
                                    foreach($content as $row){
                                // ?>
                                <!-- Quill Text editor to update Theory Content -->
                                <input name="editor2" type="hidden" id="editor2">

                                <div id="editorcontent2"><?php echo $toUpdateContent =$row['content']?></div>

                                <br>

                                <?php   }
                                }
                                ?>



                            </div>


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

        <!-- Quill Text Editor -->
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
        var container = document.getElementById("editorcontent2");
        var editor = new Quill(container, options);

        function addContentOnSubmit() {
            var addhtml = document.getElementById("editorcontent2").children[0].innerHTML;
            document.getElementById("editor2").value = addhtml;
        }
        </script>


</body>

</html>