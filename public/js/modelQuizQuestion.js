var currentIndex = 0; // Global variable to keep track of current index
var divs = document.querySelectorAll('#model-quiz'); // Get all the divs with class 'myDiv'

function showNextDiv() {
    divs[currentIndex].style.display = 'none'; // Hide the current div
    currentIndex++; // Increment the current index
    if (currentIndex >= divs.length) {
        currentIndex = 0; // If we've reached the end, loop back to the beginning
    }
    divs[currentIndex].style.display = 'block'; // Show the next div
}

document.querySelector('#nextButton').addEventListener('click', showNextDiv);
