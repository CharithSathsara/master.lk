

function selectLesson(btn){

     var lesson = btn.getAttribute("key");
     var formData = new FormData();
     formData.append("lesson",lesson);
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
        }
     };
    xmlhttp.open("POST","../../controller/studentController/dashboardController/lessonController.php",true);
    xmlhttp.send(lesson);


}

// let number = document.getElementById("number");
// let counter = 0;
// setInterval(() =>{
//     if(counter == 65){
//         clearInterval();
//     }else{
//         counter += 1;
//         number.innerHTML = counter + "%";
//     }
// },20);
