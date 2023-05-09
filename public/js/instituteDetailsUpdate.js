function showUpdatePopBox(){
    document.getElementById('error-message-Update-institute').style.display='none';


    // document.getElementById('updateInstitute-name').value = instituteName;
    // document.getElementById('updateInstitute-email').value = email;
    // document.getElementById('updateInstitute-number').value = number;
    // document.getElementById('updateInstitute-fax').value = fax;
    // document.getElementById('updateInstitute-address1').value = address1;
    // document.getElementById('updateInstitute-address2').value = address2;

    document.getElementById('updateInstitute-main').style.display='block';
}

function closeUpdateInstitute(){
    document.getElementById('updateInstitute-main').style.display='none';
}