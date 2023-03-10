// let btn = document.getElementById("goToLesson-button");
 
// btn.addEventListener("click", () => {
 
//     let btnValue = btn.value;
 
//     $.post('../../controller/studentController/dashboardController/selectLessonController.php', {
//         btnValue: btnValue
//     }, (response) => {
//         console.log(response);
//     });
// });

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
