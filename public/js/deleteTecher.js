function showDeleteTeacherForm(userId) {

    document.getElementById('teacherUserId').value = userId;
    document.getElementById('Delete-teacherPopBox').style.display='block';

    document.getElementById("deleteNo-btn").addEventListener("click",function () {
        document.querySelector(".popup-delete").style.display = "none";
    });

}

