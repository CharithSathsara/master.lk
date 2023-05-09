function showAddBankDetailsPop(){
    document.getElementById('error-message-add-bankAccount').style.display = 'none';
    document.getElementById('mainDiv-addBank').style.display = 'block';

    document.querySelector('.addPop-close').addEventListener('click',function (){
        document.getElementById('mainDiv-addBank').style.display = 'none';
    })

}

function closeAddBankPop(){
    document.getElementById('mainDiv-addBank').style.display = 'none';
}

function updateBankAccountPop(){

    document.getElementById('error-message-update-bankDetails').style.display='none';
    document.getElementById('Update-BankDetails').style.display='block';
}

function closeUpdateBankPop(){
    document.getElementById('Update-BankDetails').style.display='none';
}