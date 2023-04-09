loadForumStudent(); // Call loadForumStudent once at the beginning

function loadForumStudent() {

    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../../../controller/q_and_a_controller/student_forum_controller.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const questions = JSON.parse(xhr.responseText);
            renderForumStudent(questions);
        } else {
            console.error('Error loading questions: ' + xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Error loading questions: ' + xhr.statusText);
    };
    xhr.send();

}

function renderForumStudent(questions) {

    const container = document.getElementById('container');
    container.innerHTML = '';

    questions.forEach(function(question) {

        // Create the question element
        const questionAnswersDiv = document.createElement('div');
        questionAnswersDiv.className = 'question-answers';

        // Create the question element
        const questionDiv = document.createElement('div');
        questionDiv.className = 'question';

        // Create the question details element
        const questionDetailsDiv = document.createElement('div');
        questionDetailsDiv.className = 'question-details';

        // Create the user image element
        const userImageDiv = document.createElement('div');
        userImageDiv.className = 'user-image';
        const userImage = document.createElement('img');
        userImage.src = '../../../public/img/default-profPic.png';
        userImageDiv.appendChild(userImage);
        questionDetailsDiv.appendChild(userImageDiv);

        // Create the details element
        const detailsDiv = document.createElement('div');
        detailsDiv.className = 'details';
        const detailsText = document.createElement('p');

        let dateObject = new Date(question.date_time);
        let options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
        let formattedDateTime = dateObject.toLocaleString('en-US', options);

        let details = "Subject : <b>" + question.subject + " </b>Lesson : <b>" + question.lesson + " </b>Topic : <b>" + question.topic + "</b><br>";
        details = details +  "By <b>" + question.student + "</b> - " + formattedDateTime;

        detailsText.innerHTML = details;
        detailsDiv.appendChild(detailsText);
        questionDetailsDiv.appendChild(detailsDiv);

        // Create the question text element
        const questionTextDiv = document.createElement('div');
        questionTextDiv.className = 'question-text';
        questionTextDiv.innerHTML = question.question_text;

        // Add the question details and question text elements to the question element
        questionDiv.appendChild(questionDetailsDiv);
        questionDiv.appendChild(questionTextDiv);

        // Add the question element to the container element
        questionAnswersDiv.appendChild(questionDiv);

        if (question.answers.length > 0) {

            const answersDiv = document.createElement('div');
            answersDiv.className = 'answers';

            question.answers.forEach(function(answer) {

                // Create the question element
                const answerDiv = document.createElement('div');
                answerDiv.className = 'answer';

                // Create the question details element
                const answerDetailsDiv = document.createElement('div');
                answerDetailsDiv.className = 'answer-details';

                // Create the user image element
                const userImageDiv = document.createElement('div');
                userImageDiv.className = 'user-image';
                const userImage = document.createElement('img');
                userImage.src = '../../../public/img/default-profPic.png';
                userImageDiv.appendChild(userImage);
                answerDetailsDiv.appendChild(userImageDiv);

                // Create the details element
                const detailsDiv = document.createElement('div');
                detailsDiv.className = 'details';
                const detailsText = document.createElement('p');

                let dateObject = new Date(answer.date_time);
                let options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
                let formattedDateTime = dateObject.toLocaleString('en-US', options);

                detailsText.innerHTML = "Teacher : <b>" + answer.teacher + "</b><br>" + formattedDateTime;

                detailsDiv.appendChild(detailsText);
                answerDetailsDiv.appendChild(detailsDiv);

                // Create the question text element
                const answerTextDiv = document.createElement('div');
                answerTextDiv.className = 'answer-text';
                answerTextDiv.innerHTML =  answer.answer_text;

                // Add the question details and question text elements to the question element
                answerDiv.appendChild(answerDetailsDiv);
                answerDiv.appendChild(answerTextDiv);

                answersDiv.appendChild(answerDiv);

            });

            questionAnswersDiv.appendChild(answersDiv);

        }
        container.appendChild(questionAnswersDiv);
    });

}

const newQuestionForm = document.getElementById('new-question-form');
newQuestionForm.addEventListener('submit', function(event) {

    event.preventDefault();
    const question = document.getElementById('new-question').value;
    const topicId = document.getElementById('dropdown').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../../controller/q_and_a_controller/student_forum_controller.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                loadForumStudent();
                document.getElementById('dropdown').selectedIndex = 0;
                document.getElementById('new-question').value = '';
            } else {
                console.error('Error creating question: ' + response.message);
            }
        }
    };

    const data = 'question=' + encodeURIComponent(question) + '&topicId=' + encodeURIComponent(topicId);
    xhr.send(data);

});

// Update the questions every 5 seconds
setInterval(loadForumStudent, 5000);
