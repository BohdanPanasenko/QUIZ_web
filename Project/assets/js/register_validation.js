document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('register-form');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function (event) {
        let valid = true;
        errorMessage.innerHTML = '';

        if (username.value.length < 5) {
            valid = false;
            errorMessage.innerHTML += '<p>Username must be at least 5 characters long.</p>';
        }

        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        if (!passwordRegex.test(password.value)) {
            valid = false;
            errorMessage.innerHTML += '<p>Password must be at least 8 characters long and contain at least one letter and one number.</p>';
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            valid = false;
            errorMessage.innerHTML += '<p>Please enter a valid email address.</p>';
        }
        //idk what just else I could have checked
        if (email.value.length < 10)
        {
            valid = false;
            errorMessage.innerHTML += '<p>Email must be at least 10 characters long.</p>';
        }

        if (!valid) {
            event.preventDefault(); //prevents submission 
        }
    });
});

//bullet 1