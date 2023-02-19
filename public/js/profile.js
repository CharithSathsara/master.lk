function getPhotoUpdatePopup(){
    document.getElementById("page-mask-photo").style.display = "block";
}

function closePhotoUpdatePopup(){
    document.getElementById("page-mask-photo").style.display = "none";
    document.getElementById("change-photo-error").innerHTML = null;
    document.getElementById("change-pw-error").innerHTML = null;
}

function getPwUpdatePopup(){
    document.getElementById("page-mask-password").style.display = "block";
}

function closePwUpdatePopup(){
    document.getElementById("page-mask-password").style.display = "none";
    document.getElementById("change-pw-error").innerHTML = null;
    document.getElementById("change-photo-error").innerHTML = null;
}

function inputChange() {

    document.getElementById("change-pw-error").style.visibility = "hidden";
    document.getElementById("change-photo-error").style.visibility = "hidden";
}

function getProfileInfoPopup(){
    document.getElementById("page-mask-profileInfo").style.display = "block";
}

function closeProfileInfoPopup(){
    document.getElementById("page-mask-profileInfo").style.display = "none";
}