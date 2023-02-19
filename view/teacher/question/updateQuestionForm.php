<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Question Form</title>
</head>
<body>

    <div id="update-question-form" style="display:none;">

        <h6>Update Question</h6>
        <button id="close-form"><img src="../../../public/img/close.png" class="closeTeacher-Icon" alt="close"></button>

        <form action="../../../controller/teacherController/questionController/updateQuestionController.php" id="update-form" method="post">

            <input type="hidden" id="question-id" name="questionId">
            <textarea id="update-question" name="update-question" rows="5" cols="50"></textarea>

            <input type="text" id="update-option1" name="update-option1" >

            <input type="text" id="update-option2" name="update-option2" ><br>

            <input type="text" id="update-option3" name="update-option3" >

            <input type="text" id="update-option4" name="update-option4" ><br>

            <input type="text" id="update-option5" name="update-option5">

            <label for="correctAnswer">Correct Answer </label>
            <select name="correctAnswer">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

            <textarea id="update-description" rows="2" cols="50" name="updateDescription"></textarea>
            <input type="submit" value="UPDATE" name="submit-update-question">

        </form>
    </div>
</body>
</html>
