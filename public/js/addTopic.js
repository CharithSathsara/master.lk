//Add Topic Popup

function showAddTopicPopup() {

    // Show the popup
    document.getElementById("page-mask-addTopic").style.display = "block";


    // Hide the popup after 3 seconds
    setTimeout(function () {
        document.getElementById("page-mask-addTopic").style.display = "none";
    }, 2500);
}

function closeAddTopicPopup() {
    document.getElementById("page-mask-addTopic").style.display = "none";


}


// function showAddTopicSuccessfulPopup() {

//     // Show the popup
//     document.getElementById("page-mask-add-success").style.display = "block";


//     // Hide the popup after 3 seconds
//     setTimeout(function () {
//         document.getElementById("page-mask-add-success").style.display = "none";
//     }, 2500);
// }

// //Add Topic Unsuccess Popup

// function showAddTopicUnsuccessfulPopup() {

//     // Show the popup
//     document.getElementById("page-mask-add-unsuccess").style.display = "block";


//     // Hide the popup after 3 seconds
//     setTimeout(function () {
//         document.getElementById("page-mask-add-unsuccess").style.display = "none";
//     }, 2500);
// }

