function logout_open(){
    document.getElementById("logout-confirm").style.display = "block";
}

function logout_close(){
    document.getElementById("logout-confirm").style.display = "none";
}

// Get the maximum window height, width
const maxWidthWindow = window.screen.availWidth;
const maxHeightWindow = window.screen.availHeight;

// Calculate the ,height of the popup box
const boxWidth = Math.round(maxWidthWindow * 0.25);
const boxHeight = Math.round(maxHeightWindow * 0.15);


// Set the width,height of the popup box
const box = document.querySelector('#logout-confirm');
box.style.width = `${boxWidth}px`;
box.style.height = `${boxHeight}px`;