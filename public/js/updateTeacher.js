
function showUpdateTeacherForm(userId,fName,lName,address1,address2,mobile,email){

    document.getElementById('teacher-fname').value = fName;
    document.getElementById('teacher-lname').value = lName;
    document.getElementById('teacher-address1').value = address1;
    document.getElementById('teacher-address2').value = address2;
    document.getElementById('teacher-number').value = mobile;
    document.getElementById('teacher-email').value = email;
    document.getElementById('teacher-userId').value = userId;

  document.getElementById('popup-update').style.display = 'block';

    // Close the popup form
        document.getElementById("closeTeacher-Icon").addEventListener("click", function() {
            document.getElementById("popup-update").style.display = "none";
        });

}

