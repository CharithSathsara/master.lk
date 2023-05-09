const clearBtn = document.querySelector('.clear-button[type="reset"]');// fix the view issue, initially not view

// add a click event listener to the clear button
clearBtn.addEventListener('click', function(event) {
    // prevent the default form submission behavior
    event.preventDefault();

    // get the select elements for subject and lesson
    const subjectSelect = document.querySelector('select[name="subject"]');
    const lessonSelect = document.querySelector('select[name="lesson"]');

    // reset the value of the select elements to the default value
    subjectSelect.value = '';
    lessonSelect.value = '';

    // submit the form to refresh the page
    document.querySelector('.search-form').submit();
});
