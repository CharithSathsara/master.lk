function addPhysicsDescriptionPop(){

    document.getElementById('error-message-validate').style.display='none';

    document.querySelector('.mainDiv-addSubject').style.display = 'block';
    document.getElementById('container-addPhysics').style.display = 'block';
}

function closeAddPopBox() {
    document.querySelector('.mainDiv-addSubject').style.display = 'none';
    document.getElementById('container-addPhysics').style.display='none';
    document.getElementById('container-addChemistry').style.display='none';
}


function showAddChemistryPop(){

    document.getElementById('error-message-ChemistryValidate').style.display='none';

    document.querySelector('.mainDiv-addSubject').style.display = 'block'
    document.getElementById('container-addChemistry').style.display = 'block';
}