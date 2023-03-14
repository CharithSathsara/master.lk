//
//     document.getElementById("but-deleteTeacher").addEventListener("click",function () {
//     document.querySelector(".popup-delete").style.display = "flex";
//     const teacherID = document.querySelector('.user-id').innerHTML;
//     // document.querySelector("body").style.backgroundColor = "rgba(0,0,0,0.35)";
//     // document.querySelector("body").style.zIndex = "100";
//         document.querySelector('#teacherUserId').value = teacherID;
// })
//
//     document.getElementById("deleteNo-btn").addEventListener("click",function (){
//     document.querySelector(".popup-delete").style.display="none";
// })
//
//     document.getElementById("deleteYes-btn").addEventListener("click",function (){
//     document.querySelector(".popup-delete").style.display="none";
// })

function showDeleteTeacherForm(userId) {

    document.getElementById('teacherUserId').value = userId;
    document.getElementById('Delete-teacherPopBox').style.display='block';

    document.getElementById("deleteNo-btn").addEventListener("click",function () {
        document.querySelector(".popup-delete").style.display = "none";
    });

}

