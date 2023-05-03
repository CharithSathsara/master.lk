const questionNumber = document.querySelector(".question-number");
const questionText = document.querySelector(".question-text");
const optionContainer = document.querySelector(".option-container");
const sliderIndicatorContainer = document.querySelector(".slider-indicator");
const homeBox = document.querySelector(".home-box");
const quizBox = document.querySelector(".quiz-box");
const resultBox = document.querySelector(".result-box");


let questionCounter = 0;
let currentQuestion;
let availableQuestions = [];
let availableOptions = [];
let correctAnswers = 0;
let attempt = 0;

function setAvailableQuestions() {
    const totalQuestion = model_quiz.length;
    for (let i = 0; i < totalQuestion; i++) {
        availableQuestions.push(model_quiz[i])
    }
}

function getNewQuestion() {
    //set question number
    questionNumber.innerHTML = "Question " + (questionCounter + 1) + " of " + model_quiz.length;

    //set question
    const questionIndex = availableQuestions[Math.floor(Math.random() * availableQuestions.length)];
    currentQuestion = questionIndex;
    questionText.innerHTML = currentQuestion.q;

    //get position of questionIndex from availableQuestion Array
    const index1 = availableQuestions.indexOf(questionIndex);
    //remove from array
    availableQuestions.splice(index1, 1);

    //set options
    const optionLen = currentQuestion.options.length

    for (let i = 0; i < optionLen; i++) {
        availableOptions.push(i)
    }

    optionContainer.innerHTML = '';
    let animationDelay = 0.15;

    //create options in html
    for (let i = 0; i < optionLen; i++) {
        //raandom option
        const optionIndex1 = availableOptions[Math.floor(Math.random() * availableOptions.length)];
        //get postion of optionIndex1
        const index2 = availableOptions.indexOf(optionIndex1);

        availableOptions.splice(index2, 1);

        const option = document.createElement("div");
        option.innerHTML = currentQuestion.options[optionIndex1];
        option.id = optionIndex1;
        option.style.animationDelay = animationDelay + 's';
        animationDelay = animationDelay + 0.2;
        option.className = "quiz-option";
        optionContainer.appendChild(option)
        option.setAttribute("onclick", "getResult(this)");


    }

    questionCounter++;

}

function getResult(element) {
    const id = parseInt(element.id);
    if (id == currentQuestion.answer) {
        element.classList.add("correct");
        updateSliderIndicator("correct");
        correctAnswers++;


    }
    else {
        element.classList.add("wrong");
        updateSliderIndicator("wrong");

        const optionLen = optionContainer.children.length;
        for (let i = 0; i < optionLen; i++) {
            if (parseInt(optionContainer.children[i].id) === currentQuestion.answer)
                optionContainer.children[i].classList.add("correct");
        }

    }
    attempt++;
    unclickableOptions();


}

function unclickableOptions() {
    const optionLen = optionContainer.children.length;
    for (let i = 0; i < optionLen; i++) {
        optionContainer.children[i].classList.add("already-answered");
    }
}

function sliderIndicator() {
    sliderIndicatorContainer.innerHTML = '';
    const totalQuestion = model_quiz.length;
    for (let i = 0; i < totalQuestion; i++) {
        const indicator = document.createElement("div");
        sliderIndicatorContainer.appendChild(indicator);
    }
}

function updateSliderIndicator(markType) {
    sliderIndicatorContainer.children[questionCounter - 1].classList.add(markType);
}

function next() {
    if (questionCounter == model_quiz.length) {

        quizOver();
    }
    else {
        getNewQuestion();
    }
}

function quizOver() {
    quizBox.classList.add("hide");
    resultBox.classList.remove("hide");
    quizResult();

}

function quizResult() {
    resultBox.querySelector(".total-question").innerHTML = model_quiz.length;
    resultBox.querySelector(".total-attempt").innerHTML = attempt;
    resultBox.querySelector(".total-correct").innerHTML = correctAnswers;
    resultBox.querySelector(".total-wrong").innerHTML = attempt - correctAnswers;
    const percentage = (correctAnswers / model_quiz.length) * 100;
    resultBox.querySelector(".total-percentage").innerHTML = percentage.toFixed(2) + "%";
    resultBox.querySelector(".total-score").innerHTML = correctAnswers + "/" + model_quiz.length;
}

function resetQuiz() {
    questionCounter = 0;
    correctAnswers = 0;
    attempt = 0;
}

function tryAgainQuiz() {
    resultBox.classList.add("hide");
    quizBox.classList.remove("hide");
    resetQuiz();
    startQuiz();
}

function goToDashboard() {
    resultBox.classList.add("hide");
    homeBox.classList.remove("hide");
    resetQuiz();
}

function startQuiz() {
    console.log("awa");
    homeBox.classList.add("hide");
    quizBox.classList.remove("hide");
    setAvailableQuestions();
    getNewQuestion();
    sliderIndicator();
}


