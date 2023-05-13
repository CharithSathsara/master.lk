<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../public/css/updateQuestionForm.css?<?php echo time(); ?>">
    <title>Update Question Form</title>
</head>
<body>

<div class="page-mask" id="page-mask-update-question">
    <div id="update-question-form">
        <b><p id="update-photo-password-title">Update Question</p></b>
        <button onclick="closePwUpdatePopup()" class="close-button">
            <img src="../../../public/icons/close.svg" class="close-icon">
        </button><br>
        <form action="../../../controller/teacherController/questionController/updateQuestionController.php" id="update-form" method="post">

            <input type="hidden" id="question-id" name="questionId">
            <textarea id="update-question" name="update-question" rows="3" cols="30"></textarea>

            <input type="text" id="update-option1" name="update-option1">

            <input type="text" id="update-option2" name="update-option2"><br>

            <input type="text" id="update-option3" name="update-option3">

            <input type="text" id="update-option4" name="update-option4"<br>

            <input type="text" id="update-option5" name="update-option5">

            <label for="correctAnswer">Correct Answer</label>
            <select name="correctAnswer">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <textarea id="update-description" rows="2" cols="30" name="updateDescription"></textarea>

            <div id="update-question-error">
                <?php include "../../../controller/authController/message.php"?>
            </div>

            <div style="text-align: right;">
                <input type="submit" value="UPDATE" name="submit-update-question" id="submit-update-question">
            </div>

        </form>
        </form>
    </div>
</div>

</body>
</html>
