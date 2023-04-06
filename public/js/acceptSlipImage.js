function viewAcceptPage(paymentId){
    console.log(paymentId);
    document.getElementById('yer-PaymentId').value = paymentId;
    document.querySelector('.access-popBox').style.display = 'block';

    document.getElementById('close-verifyPop').addEventListener('click',function (){
        document.querySelector('.access-popBox').style.display = 'none';
    })
}