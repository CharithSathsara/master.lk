function showUpdateCreatorForm(userId,fname,lname,address1,address2,mobile,email){

    document.getElementById('Creator-fname').value = fname;
    document.getElementById('Creator-lname').value = lname;
    document.getElementById('Creator-address1').value = address1;
    document.getElementById('Creator-address2').value = address2;
    document.getElementById('Creator-number').value = mobile;
    document.getElementById('Creator-email').value = email;
    document.getElementById('Creator-userId').value = userId;

    document.getElementById('update-ContentCreatorPop').style.display='flex';

    document.querySelector(".CloseContentCreatorPop").addEventListener("click",function () {
        document.querySelector(".update-ContentCreatorPop").style.display = "none";
    });
}