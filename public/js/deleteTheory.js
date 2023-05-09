function closeDeleteTheoryPopup() {
    document.getElementById("page-mask-delete-theory").style.display = "none";


}

function deleteTheoryPopup() {
    document.getElementById("page-mask-delete-theory").style.display = "block";
}

function showDeleteSuccessfulPopup() {
    // Show the popup
    document.getElementById("page-mask-delete-success").style.display = "block";


    // Hide the popup after 3 seconds
    setTimeout(function () {
        document.getElementById("page-mask-delete-success").style.display = "none";
    }, 2500);
}

function showUpdateUnsuccessfulPopup() {

    // Show the popup
    document.getElementById("page-mask-delete-unsuccess").style.display = "block";


    // Hide the popup after 3 seconds
    setTimeout(function () {
        document.getElementById("page-mask-delete-unsuccess").style.display = "none";
    }, 2500);
}

