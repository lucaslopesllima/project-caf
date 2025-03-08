document.addEventListener('DOMContentLoaded', function() {

    let emailInput = document.getElementById('email');
    let passwordInput = document.getElementById('password');

    if (emailInput && passwordInput) {
        emailInput.addEventListener('input', validateLogin);
        passwordInput.addEventListener('input', validateLogin);
    }
    function validateLogin() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const rememberMe = document.getElementById('remember_me');

        rememberMe.disabled = !(email.length >= 5 && email.includes('@') && password.length >= 5);
    }
});
