// Get all update buttons
const updateButtons = document.querySelectorAll('.Update-');

// Loop through each update button and add click event listener
updateButtons.forEach(function(updateButton) {
    updateButton.addEventListener('click', function(e) {

        // Get the parent row of the update button
        const parentRow = e.target.closest('tr');

        // Get the question, options, and correct answer from the parent row
        const teacherID = parentRow.querySelector('.user-id').innerHTML;
        const teacher_fname = parentRow.querySelector('.first-name').innerHTML;
        const teacher_lnamew = parentRow.querySelector('.last-name').innerHTML;
        const teacher_address1 = parentRow.querySelector('.address-1').innerHTML;
        const teacher_address2 = parentRow.querySelector('.address-2').innerHTML;
        const teacher_number = parentRow.querySelector('.telephone-number').innerHTML;
        const teacher_email = parentRow.querySelector('.email').innerHTML;
        const teacher_useerName = parentRow.querySelector('.userName').innerHTML;

        // Populate the update form with the data
        document.querySelector('#teacher-userId').value = teacherID;
        document.querySelector('#teacher-fname').value = teacher_fname;
        document.querySelector('#teacher-lname').value = teacher_lnamew;
        document.querySelector('#teacher-address1').value = teacher_address1;
        document.querySelector('#teacher-address2').value = teacher_address2;
        document.querySelector('#teacher-number').value = teacher_number ;
        document.querySelector('#teacher-email').value = teacher_email;
        document.querySelector('#teacher-username').value = teacher_useerName;

        // Show the update form
        document.querySelector('#popup-update').style.display = 'block';

    });
});

// Close the popup form
document.getElementById("close-form").addEventListener("click", function() {
    document.getElementById("update-question-form").style.display = "none";
});
