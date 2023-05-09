

function updateBank(AccountNumber,HolderName,BankName,BranchName){
    document.querySelector(".Update-BankDetails").style.display = "block";

    document.getElementById('BankAccountNumber').value = AccountNumber;
    document.getElementById('BankHolderName').value = HolderName;
    document.getElementById('BankBankName').value = BankName;
    document.getElementById('BankBranchName').value = BranchName;

    document.getElementById('UpdateBox-closeIcon').addEventListener("click",function (){
        document.querySelector(".Update-BankDetails").style.display = "none";
    })
}
