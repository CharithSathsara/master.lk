function viewRejectPage(paymentId){
    document.getElementById('yer-RejectPaymentId').value = paymentId;
    document.getElementById('reject-popBox').style.display='block';

    document.getElementById('close-rejectPop').addEventListener('click',function (){
        document.getElementById('reject-popBox').style.display='none';
    })
    document.getElementById('close-reject').addEventListener('click',function (){
        document.getElementById('reject-popBox').style.display='none';
    })
}