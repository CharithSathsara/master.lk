<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Model Quiz</title>
    <link rel="stylesheet" href="../../../public/css/modelQuiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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


$_SESSION['topicId'] = 2;

if(!isset($_SESSION['modelQuizScore'])){
$_SESSION['modelQuizScore'] = 0;
}

if(!isset($_SESSION['questionNo'])){
    $_SESSION['questionNo'] = 1;
    }

if($_POST){
$questionNumber = $_POST['questionNumber'];
$selectedChoice = $_POST['choice'];
$next = $_SESSION['questionNo']+1;


// $modelQuizController = new ModelQuizController();
// $questions = $modelQuizController->getModelQuizQuestions($_SESSION['topicId']);
$rows = $_SESSION['model_question_array'];

$questions =  $rows[$_SESSION['questionNo']-1];


$correctChoice = $questions['correctAnswer'];


//Compare selected and correct choice
if($correctChoice == $selectedChoice){
    $_SESSION['modelQuizScore'] += 1;
}

//Check Wheather It Reached Last Question
if($questionNumber == 3){
header("Location: modelQuizResult.php");
exit();
}
else{
?>
    <script>
    $.ajax({
        url: "modelQuizStarted.php",
        type: "GET",
        success: function() {
            window.location.href = "modelQuizStarted.php";
        }
    });
    </script>



    <?php
}

}


?>





</body>

</html>