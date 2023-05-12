<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Past Paper Quiz Result</title>
    <link rel="stylesheet" href="../../../public/css/ppQuiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">



</head>

<body>
    <?php

    include('../../../controller/studentController/quizController/ppQuizController.php');
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



    $_SESSION['topicId'] = 2;

    if (!isset($_SESSION['ppQuizScore'])) {
        $_SESSION['ppQuizScore'] = 0;
    }


    if (isset($_POST['submit'])) {

        $selectedChoice1 = $_POST['choice1'];
        $selectedChoice2 = $_POST['choice2'];
        $selectedChoice3 = $_POST['choice3'];
        $selectedChoice4 = $_POST['choice4'];
        $selectedChoice5 = $_POST['choice5'];
        $selectedChoice6 = $_POST['choice6'];
        $selectedChoice7 = $_POST['choice7'];
        $selectedChoice8 = $_POST['choice8'];
        $selectedChoice9 = $_POST['choice9'];
        $selectedChoice10 = $_POST['choice10'];

        $selectedChoice = array($selectedChoice1, $selectedChoice2, $selectedChoice3, $selectedChoice4, $selectedChoice5, $selectedChoice6, $selectedChoice7, $selectedChoice8, $selectedChoice9, $selectedChoice10);
        // $ppQuizController = new ppQuizController();
        // $questions = $ppQuizController->getppQuizQuestions($_SESSION['topicId']);
        $rows = $_SESSION['pp_question_array'];

        //Get Correct Answer Array
        $correctChoice = array();

        foreach ($rows as $row) {
            $correctChoice[] = $row['correctAnswer'];
        }



        //Compare selected and correct choice
        // compare the arrays
        if (count($selectedChoice) == count($correctChoice) && array_diff($selectedChoice, $correctChoice) == array_diff($correctChoice, $selectedChoice)) {
            // arrays are equal, increase score
            $_SESSION['ppQuizScore'] += 1;
        }

        // if ($correctChoice == $selectedChoice) {

        // }

        //Check Wheather It Reached Last Question
        // if ($questionNumber == 3) {
        //     header("Location: ppQuizResult.php");
        //     exit();
        // } else {







    }


    ?>
    <div class="content">
        <div class="container">
            <div class="ppQuiz-container">
                <div class="title-ppQuiz"><b>pp Quiz</b>
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
                            <td>Attempt</td>
                            <td><span class="total-attempt">1</span></td>
                        </tr>
                        <tr>
                            <td>Total Correct</td>
                            <td><span class="total-correct">1</span></td>
                        </tr>
                        <tr>
                            <td>Total Wrong</td>
                            <td><span class="total-wrong">1</span></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><span class="percentage">60.00%</span></td>
                        </tr>
                        <tr>
                            <td>Your Total Score</td>
                            <td><span class="total-score"><?php echo $_SESSION['ppQuizScore']; ?>/10</span></td>
                        </tr>
                    </table>

                    <button type="button" class="quiz-btn">Try Again</button>
                    <button type="button" class="quiz-btn">Review Questions</button>
                    <button type="button" class="quiz-btn">Go to Dashboard</button>

                </div>



            </div>
        </div>
    </div>

    <?php
    // Unset the session variable to destroy it
    // unset($_SESSION['ppQuizScore']); 
    ?>
</body>

</html>