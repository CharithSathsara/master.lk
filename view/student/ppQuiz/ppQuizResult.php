<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Past Paper Quiz Result</title>
    <link rel="stylesheet" href="../../../public/css/modelQuiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">



</head>

<body>
    <?php

    include('../../../controller/studentController/quizController/modelQuizController.php');
    include_once('../../../controller/authController/authentication/Authentication.php');
    include_once('../../../controller/authController/authorization/Authorization.php');



    //check user authenticated or not
    //$authentication = new Authentication();
    //$authentication->authorizingAdmin();

    //User Authentication
    Authentication::userAuthentication();
    //User Authorization
    Authorization::authorizingStudent();



    include_once '../../../view/common/header.php';
    @include '../../../view/common/navBar-Student.php';






    ?>
    <div class="content">
        <div class="container">
            <div class="modelQuiz-container">
                <div class="title-modelQuiz"><b>Past Paper Quiz</b>
                    <hr class="hr-line">
                </div>
                <div class="result-box custom-box ">
                    <h2>Congratulations! You have completed the Past Paper quiz...</h2>
                    <h1>Quiz Result</h1>

                    <table>
                        <tr>
                            <td>Total Questions</td>
                            <td><span class="total-question">10</span></td>
                        </tr>
                        <tr>
                            <td>Total Correct</td>
                            <td><span class="total-correct"><?php echo $_SESSION['ppQuizTotalCorrectAns']; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Wrong</td>
                            <td><span class="total-wrong"><?php echo $_SESSION['ppQuizTotalWrongAns']; ?></span></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><span class="percentage"><?php echo $_SESSION['ppQuizPercentage'] ?>%</span></td>
                        </tr>
                        <tr>
                            <td>Your Total Score</td>
                            <td><span class="total-score"><?php echo $_SESSION['ppQuizScore']; ?>/10</span></td>
                        </tr>
                    </table>


                    <a href="../../../view/student/ppQuiz/ppQuiz.php"><button type="button" class="quiz-btn">Try
                            Again</button></a>
                    <a href="../../../view/student/reviewQuizzes.php"><button type="button" class="quiz-btn">Review
                            Questions</button></a>
                    <a href="../../../view/student/studentDashboard.php"><button type="button" class="quiz-btn">Go to
                            Dashboard</button></a>

                </div>



            </div>
        </div>
    </div>

    <!-- <form method="post" id="ppQuizDetailForm"
        action="../../../controller/studentController/quizController/ppQuizController.php">
        <input type="hidden" name="ppQuizUser" value="" />
    </form>

    <script>
    // Send an AJAX request to submit the form
    $(document).ready(function() {
        var form = $("#ppQuizDetailForm");
        var formData = form.serialize();

        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: formData,
            success: function() {

            }
        });
    });
    </script> -->


    <?php
    // Unset the session variable to destroy it
    unset($_SESSION['ppQuizScore']);
    unset($_SESSION['ppQuizPercentage']);
    unset($_SESSION['ppQuizScore']);

    ?>
</body>

</html>