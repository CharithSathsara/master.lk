// Get all update buttons
const updateButtons = document.querySelectorAll('.update-button');

// Loop through each update button and add click event listener
updateButtons.forEach(function(updateButton) {
    updateButton.addEventListener('click', function(e) {

        // Get the parent row of the update button
        const parentRow = e.target.closest('tr');

        // Get the question, options, and correct answer from the parent row
        const questionId = document.querySelector('input[name="questionId"]').value;
        const question = parentRow.querySelector('.question').innerHTML;
        const option1 = parentRow.querySelector('.option1').innerHTML;
        const option2 = parentRow.querySelector('.option2').innerHTML;
        const option3 = parentRow.querySelector('.option3').innerHTML;
        const option4 = parentRow.querySelector('.option4').innerHTML;
        const option5 = parentRow.querySelector('.option5').innerHTML;
        const description = parentRow.querySelector('.description').innerHTML;

        // Populate the update form with the data
        document.querySelector('#question-id').value = questionId;
        document.querySelector('#update-question').value = question;
        document.querySelector('#update-option1').value = option1;
        document.querySelector('#update-option2').value = option2;
        document.querySelector('#update-option3').value = option3;
        document.querySelector('#update-option4').value = option4;
        document.querySelector('#update-option5').value = option5;
        document.querySelector('#update-description').value = description;

        // Show the update form
        document.getElementById("page-mask-update-question").style.display = "block";
        document.querySelector('#update-question-form').style.display = 'block';

    });
});

// Close the popup form
document.getElementById("close-form").addEventListener("click", function() {
    document.getElementById("update-question-form").style.display = "none";
    document.getElementById("page-mask-update-question").style.display = "none";
});
