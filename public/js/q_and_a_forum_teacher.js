let refreshInterval = setInterval(loadForumTeacher, 5000);
loadForumTeacher(); // Call loadForumTeacher once at the beginning

function loadForumTeacher() {

    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../../../controller/q_and_a_controller/teacher_forum_controller.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const questions = JSON.parse(xhr.responseText);
            renderForumTeacher(questions);
        } else {
            console.error('Error loading questions: ' + xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Error loading questions: ' + xhr.statusText);
    };
    xhr.send();

}

function renderForumTeacher(questions) {

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

        // Add reply button to question
        const replyButton = document.createElement('button');
        replyButton.className = 'reply-button';
        replyButton.innerHTML = 'Give Your Answer';
        // const replyIcon = document.createElement('img');
        // replyIcon.className = 'reply-icon';
        // replyIcon.src = '../../../public/icons/reply-solid.svg';
        // replyIcon.alt = 'Reply';
        // replyButton.appendChild(replyIcon);

        replyButton.addEventListener('click', function() {
            // Toggle the display of the reply form
            const replyForm = questionDiv.getElementsByClassName('reply-form')[0];
            replyForm.style.display = (replyForm.style.display === 'none') ? 'block' : 'none';
            // Set focus on the reply input field
            replyForm.getElementsByTagName('input')[0].focus();
        });
        questionDiv.appendChild(replyButton);

        // Add the question element to the container element
        questionAnswersDiv.appendChild(questionDiv);

        // Add reply form to question
        const replyForm = document.createElement('form');
        replyForm.className = 'reply-form';
        replyForm.id = 'reply-form';
        replyForm.style.display = 'none';

        const replyInput = document.createElement('input');
        replyInput.type = 'text';
        replyInput.name = 'answer_text';
        replyInput.id = 'answer_text';
        replyInput.placeholder = 'Enter your answer here';
        replyForm.appendChild(replyInput);

        // Add focus and blur event listeners to reply input
        replyInput.addEventListener('focus', function() {
            clearInterval(refreshInterval);
        });
        replyInput.addEventListener('blur', function() {
            refreshInterval = setInterval(loadForumTeacher, 5000);
        });

        const sendButton = document.createElement('button');
        sendButton.innerHTML = 'Send';
        sendButton.className = 'reply-submit';
        sendButton.type = 'submit';

        replyForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const answer = document.getElementById('answer_text').value;
            console.log(answer);
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../../../controller/q_and_a_controller/teacher_forum_controller.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        loadForumTeacher();
                        document.getElementById('answer_text').value = '';
                    } else {
                        console.error('Error creating answer: ' + response.message);
                    }
                }
            };


            const data = 'question_id=' + encodeURIComponent(question.question_id) + '&answer_text=' + encodeURIComponent(replyInput.value);
            xhr.send(data);

            return false; // Prevent default form submission behavior
        });

        replyForm.appendChild(sendButton);
        questionDiv.appendChild(replyForm);

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

