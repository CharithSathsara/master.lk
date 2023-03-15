function getCourses(){
    document.getElementById("about-courses").style.borderColor = "#f49f0a";
    document.getElementById("home").style.borderColor = "white";
    document.getElementById("about-courses").style.color = "black";
    document.getElementById("home").style.color = "#808080";
    document.getElementById("courses-div").style.visibility = "visible";

}

function getHome(){
    document.getElementById("home").style.borderColor = "#f49f0a";
    document.getElementById("about-courses").style.borderColor = "white";
    document.getElementById("home").style.color = "black";
    document.getElementById("about-courses").style.color = "#808080";
    document.getElementById("courses-div").style.visibility = "hidden";

}