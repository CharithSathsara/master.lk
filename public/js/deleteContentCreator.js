function showDeleteCreatorForm(userId){

    document.getElementById('creatorUserId').value = userId;
    document.getElementById('Delete-contentPop').style.display='block';

        document.getElementById("deleteContentNo-btn").addEventListener("click",function () {
        document.querySelector(".popup-deleteContent").style.display = "none";
        });
}

// function close(){
//     document.querySelector(".popup-deleteContent").style.display = "none";
// }

function closeDeleteCreatorPop(){
    document.querySelector(".popup-deleteContent").style.display = "none";
}