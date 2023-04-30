// Get all update buttons
const updateButtons = document.querySelectorAll('.update-button');

// Loop through each update button and add click event listener
updateButtons.forEach(function (updateButton) {
    updateButton.addEventListener('click', function (e) {

        // Get the parent row of the update button
        const parentRow = e.target.closest('tr');

        // Get the question, options, and correct answer from the parent row
        const sectionContent = document.querySelector('#sectioncontent').value;

        // Populate the update form with the data
        document.querySelector('#editorcontent2').value = questionId;


    });
});


