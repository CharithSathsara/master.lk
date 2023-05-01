function showUpdateSuccessfulPopup() {

    // Show the popup
    document.getElementById("page-mask-update-success").style.display = "block";


    // Hide the popup after 3 seconds
    setTimeout(function () {
        document.getElementById("page-mask-update-success").style.display = "none";
    }, 3000);
}

function showUpdateUnsuccessfulPopup() {

    // Show the popup
    document.getElementById("page-mask-update-unsuccess").style.display = "block";


    // Hide the popup after 3 seconds
    setTimeout(function () {
        document.getElementById("page-mask-update-unsuccess").style.display = "none";
    }, 3000);
}

