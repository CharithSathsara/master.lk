<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Model Quiz Result</title>
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



    $_SESSION['topicId'] = 2;

    if (!isset($_SESSION['modelQuizScore'])) {
        $_SESSION['modelQuizScore'] = 0;
    }

    if (!isset($_SESSION['modelQuizTotalCorrectAns'])) {
        $_SESSION['modelQuizTotalCorrectAns'] = 0;
    }

    if (!isset($_SESSION['modelQuizWrongCorrectAns'])) {
        $_SESSION['modelQuizTotalWrongAns'] = 0;
    }

    if (!isset($_SESSION['modelQuizPercentage'])) {
        $_SESSION['modelQuizPercentage'] = 0;
    }



    if (isset($_POST['submit'])) {

        if (isset($_POST['choice1'])) {
            $selectedChoice1 = $_POST['choice1'];
        } else {
            // Handle the case where 'choice1' is not set
            $selectedChoice1 = 0;
        }

        if (isset($_POST['choice2'])) {
            $selectedChoice2 = $_POST['choice2'];
        } else {
            // Handle the case where 'choice2' is not set
            $selectedChoice2 = 0;
        }


        if (isset($_POST['choice3'])) {
            $selectedChoice3 = $_POST['choice3'];
        } else {
            // Handle the case where 'choice3' is not set
            $selectedChoice3 = 0;
        }

        if (isset($_POST['choice4'])) {
            $selectedChoice4 = $_POST['choice4'];
        } else {
            // Handle the case where 'choice4' is not set
            $selectedChoice4 = 0;
        }

        if (isset($_POST['choice5'])) {
            $selectedChoice5 = $_POST['choice5'];
        } else {
            // Handle the case where 'choice5' is not set
            $selectedChoice5 = 0;
        }

        if (isset($_POST['choice6'])) {
            $selectedChoice6 = $_POST['choice6'];
        } else {
            // Handle the case where 'choice6' is not set
            $selectedChoice6 = 0;
        }

        if (isset($_POST['choice7'])) {
            $selectedChoice7 = $_POST['choice7'];
        } else {
            // Handle the case where 'choice7' is not set
            $selectedChoice7 = 0;
        }

        if (isset($_POST['choice8'])) {
            $selectedChoice8 = $_POST['choice8'];
        } else {
            // Handle the case where 'choice8' is not set
            $selectedChoice8 = 0;
        }

        if (isset($_POST['choice9'])) {
            $selectedChoice9 = $_POST['choice9'];
        } else {
            // Handle the case where 'choice9' is not set
            $selectedChoice9 = 0;
        }

        if (isset($_POST['choice10'])) {
            $selectedChoice10 = $_POST['choice10'];
        } else {
            // Handle the case where 'choice10' is not set
            $selectedChoice10 = 0;
        }







        // $selectedChoice1 = $_POST['choice1'];
        // $selectedChoice2 = $_POST['choice2'];
        // $selectedChoice3 = $_POST['choice3'];
        // $selectedChoice4 = $_POST['choice4'];
        // $selectedChoice5 = $_POST['choice5'];
        // $selectedChoice6 = $_POST['choice6'];
        // $selectedChoice7 = $_POST['choice7'];
        // $selectedChoice8 = $_POST['choice8'];
        // $selectedChoice9 = $_POST['choice9'];
        // $selectedChoice10 = $_POST['choice10'];

        $selectedChoice = array($selectedChoice1, $selectedChoice2, $selectedChoice3, $selectedChoice4, $selectedChoice5, $selectedChoice6, $selectedChoice7, $selectedChoice8, $selectedChoice9, $selectedChoice10);
        $_SESSION['selectedAnsArray'] = $selectedChoice;
        //check wheather array is empty
        if (empty($_SESSION['selectedAnsArray'])) {
            echo "The session array is empty";
        } else {
            echo "The session array is not empty";
        }


        // $modelQuizController = new ModelQuizController();
        // $questions = $modelQuizController->getModelQuizQuestions($_SESSION['topicId']);
        $rows = $_SESSION['model_question_array'];



        //Get Correct Answer Array
        $correctChoice = array();

        foreach ($rows as $row) {
            $correctChoice[] = $row['correctAnswer'];
        }



        //Compare selected and correct choice
        // compare the arrays
        for ($i = 0; $i < count($selectedChoice); $i++) {
            if ($selectedChoice[$i] === $correctChoice[$i]) {
                $_SESSION['modelQuizScore'] += 1;
            } else {
                $_SESSION['modelQuizTotalWrongAns'] += 1;
            }
        }
        $_SESSION['modelQuizTotalCorrectAns'] = $_SESSION['modelQuizScore'];

        // if ($correctChoice == $selectedChoice) {

        // }

        //Check Wheather It Reached Last Question
        // if ($questionNumber == 3) {
        //     header("Location: modelQuizResult.php");
        //     exit();
        // } else {

        //Percentage Score of the student
        $_SESSION['modelQuizPercentage'] = ($_SESSION['modelQuizScore'] / 10) * 100;
    }


    ?>
    <div class="content">
        <div class="container">
            <div class="modelQuiz-container">
                <div class="title-modelQuiz"><b>Model Quiz</b>
                    <hr class="hr-line">
                </div>
                <div class="result-box custom-box ">
                    <h2>Congratulations! You have completed the model quiz...</h2>
                    <h1>Quiz Result</h1>

                    <table>
                        <tr>
                            <td>Total Questions</td>
                            <td><span class="total-question">10</span></td>
                        </tr>
                        <tr>
                            <td>Total Correct</td>
                            <td><span class="total-correct"><?php echo $_SESSION['modelQuizTotalCorrectAns']; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Wrong</td>
                            <td><span class="total-wrong"><?php echo $_SESSION['modelQuizTotalWrongAns']; ?></span></td>
                        </tr>
                        <tr>
                            <td>Percentage</td>
                            <td><span class="percentage"><?php echo $_SESSION['modelQuizPercentage']; ?></span></td>
                        </tr>
                        <tr>
                            <td>Your Total Score</td>
                            <td><span class="total-score"><?php echo $_SESSION['modelQuizScore']; ?>/10</span></td>
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
    unset($_SESSION['modelQuizScore']);
    unset($_SESSION['modelQuizPercentage']);
    unset($_SESSION['modelQuizScore']);
    unset($_SESSION['modelQuizScore']);
    ?>
</body>

</html>