document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let message = document.getElementById('message');

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../backend/php/index.php?route=login', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if(response.success === true) {
                if(response.user.RoleUser === 'directeur') {
                    window.location.href = 'directeur/dashboard.php';
                } else if(response.user.RoleUser === 'gerant') {
                    window.location.href = 'gerant/dashboard.php';
                } else if(response.user.RoleUser === 'etudiant') {
                    window.location.href = 'etudiant/dashboard.php';
                } else if(response.user.RoleUser === 'prof') {
                    window.location.href = 'prof/dashboard.php';
                }
            } else {
                message.className = 'error';
                message.innerHTML = response.message;
            }
        }
    }

    xhr.send('email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
});