//Changes cards(divs) of the index page

function getLogin(){
    document.getElementById("login-list-item").style.borderColor = "#f49f0a";
    document.getElementById("signup-list-item").style.borderColor = "white";
    document.getElementById("signup-card").style.visibility = "hidden";
    document.getElementById("master-card").style.visibility = "visible";
    document.getElementById("forgot-pw-card").style.visibility = "hidden";

    document.getElementById("login-error").innerHTML = null;
}

function getSignup(){
    document.getElementById("signup-list-item").style.borderColor = "#f49f0a";
    document.getElementById("login-list-item").style.borderColor = "white";
    document.getElementById("signup-card").style.visibility = "visible";
    document.getElementById("master-card").style.visibility = "hidden";
    document.getElementById("forgot-pw-card").style.visibility = "hidden";

    document.getElementById("signup-error").innerHTML = null;


}

function forgotPassword(){
    document.getElementById("master-card").style.visibility = "visible";
    document.getElementById("forgot-pw-card").style.visibility = "visible";
    document.getElementById("signup-card").style.visibility = "hidden";
}

function inputChange() {
    // var element1 = document.getElementById("login-error");
    // var element2 = document.getElementById("signup-error");
    // element1.innerHTML = null;
    // element2.innerText = null;
    document.getElementById("login-error").style.visibility = "hidden";
    document.getElementById("signup-error").style.visibility = "hidden";
}

// const togglePassword = document.querySelector('#togglePassword');
// const password = document.querySelector('#login-password');

// togglePassword.addEventListener('click', function (e) {
//     // toggle the type attribute
//     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
//     password.setAttribute('type', type);
//     // toggle the eye slash icon
//     this.classList.toggle('fa-eye-slash');
// });




