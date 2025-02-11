document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.getElementById('username');
    const usernameMessage = document.getElementById('username-message');

    usernameInput.addEventListener('input', function () {
        const username = usernameInput.value.trim();

        if (username.length >= 5) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'check_username.php', true); 
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.exists) {
                        usernameMessage.textContent = 'Username already taken.';
                        usernameMessage.style.color = 'red';
                    }
                    else {
                        usernameMessage.textContent = 'Username available.';
                        usernameMessage.style.color = 'green';
                    }
                }
            };
            xhr.send('username=' + encodeURIComponent(username));
        } else {
            usernameMessage.textContent = '';
        }
    });
});

//bullet 3