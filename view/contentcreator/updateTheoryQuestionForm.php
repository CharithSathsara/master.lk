<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/updateTheoryQuestionForm.css">
    <title>Update Theory Question Form</title>
</head>

<body>

    <div class="page-mask" id="page-mask-update-question" style="display:none;">
        <div id="update-question-form">
            <b>
                <p id="update-question-title">Update Theory Question</p>
            </b>
            <button id="close-form" class="close-form">
                <img src="../../public/icons/close.svg" class="close-icon">
            </button><br><br>
            <form
                action="../../controller/contentCreatorController/theoryQuestionController/updateTheoryQuestionController.php"
                id="update-form" method="post">

                <input type="hidden" id="question-id" name="questionId">
                <textarea id="update-question" name="update-question" rows="5" cols="50"></textarea>

                <input type="text" id="update-option1" name="update-option1">

                <input type="text" id="update-option2" name="update-option2"><br>

                <input type="text" id="update-option3" name="update-option3">

                <input type="text" id="update-option4" name="update-option4" <br>

                <input type="text" id="update-option5" name="update-option5">

                <label for="correctAnswer">Correct Answer </label>
                <select name="correctAnswer">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>



                <div id="update-question-error">
                    <?php include "../../controller/authController/message.php" ?>
                </div>

                <div style="text-align: right;">
                    <input type="submit" value="UPDATE" name="submit-update-question">
                </div>

            </form>
        </div>
    </div>

</body>

</html>