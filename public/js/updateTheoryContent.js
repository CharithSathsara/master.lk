<script>
    $(document).ready(function() {
			// Get all update buttons
			const updateButtons = $('#editImg');

    // Loop through each update button and add click event listener
    updateButtons.each(function() {
        $(this).click(function () {
            // Get the content ID of the clicked row
            const contentId = $(this).data('contentid');

            // Send AJAX request to get the content of the row
            $.ajax({
                url: '../../controller/contentCreatorController/theoryContentController/updateTheoryContentController.php',
                method: 'POST',
                data: {
                    contentId: contentId
                },
                success: function (response) {
                    // Redirect to updateContent.php with the content data
                    window.location.href = '../../view/js/updateTheory.php?content=' + response;
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        })
    });
		});
</script>