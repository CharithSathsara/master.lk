function viewUpdateChemistryDescription(){
         textarea.style.height = '130px';
        document.getElementById('error-message-updateChemistryValidate').style.display= 'none';
        document.getElementById('mainDiv-updateChemistrySubject').style.display = 'block';
}

function closeUpdateChemistryPopBox(){
    document.getElementById('mainDiv-updateChemistrySubject').style.display = 'none';
}

function showUpdatePhysicsPop(){
    // console.log(2);
    document.getElementById('error-message-updatePhysicsValidate').style.display= 'none';
    // document.querySelector('.mainDiv-updatePhysicsSubject').style.display='block';
    document.getElementById('mainDiv-updatePhysicsSubject').style.display = 'block';
}

function closeUpdatePhysicsPopBox(){
    document.getElementById('mainDiv-updatePhysicsSubject').style.display = 'none';
}