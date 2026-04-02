document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    console.log('Formulaire soumis'); // debug
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let message = document.getElementById('message');
    let spinner = document.getElementById('spinner');

    spinner.style.display = 'block';
    message.innerHTML = '';

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../index.php?route=login', true); // chemin corrigé
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.withCredentials = true; // important pour session PHP

    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4) {
            spinner.style.display = 'none';

            if(xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                console.log(response); // debug

                if(response.success === true) {
                    // redirection selon rôle
                    switch(response.user.RoleUser) {
                        case 'directeur':
                            window.location.href = 'directeur/dashboard.php';
                            break;
                        case 'gerant':
                            window.location.href = 'gerant/dashboard.php';
                            break;
                        case 'etudiant':
                            window.location.href = 'etudiant/dashboard.php';
                            break;
                        case 'prof':
                            window.location.href = 'prof/dashboard.php';
                            break;
                        default:
                            message.className = 'error';
                            message.innerHTML = "Rôle inconnu";
                    }
                } else {
                    message.className = 'error';
                    message.innerHTML = response.message;
                }
            } else {
                message.className = 'error';
                message.innerHTML = "Erreur serveur: " + xhr.status;
            }
        }
    }

    xhr.send('email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
});
/*
revision:
L’utilisateur saisit son email et son mot de passe dans le formulaire de connexion.
Le JavaScript (XHR ou fetch) intercepte la soumission du formulaire et envoie les données via POST à index.php avec le paramètre route=login.
Dans index.php, la route est analysée et l’appel est dirigé vers le AuthController.
Le contrôleur vérifie d’abord que les champs email et mot de passe ne sont pas vides.
Ensuite, il appelle la méthode getUserByEmail du modèle Utilisateur pour récupérer les informations de l’utilisateur depuis la base de données.
Si l’utilisateur existe, le contrôleur utilise password_verify pour comparer le mot de passe saisi avec le mot de passe hashé stocké en base.
Si le mot de passe est correct, une session PHP est créée et des cookies sécurisés sont configurés pour maintenir la session.
Enfin, le contrôleur renvoie une réponse JSON au front-end.
Le JavaScript interprète cette réponse et redirige l’utilisateur vers son tableau de bord correspondant à son rôle (directeur, gerant, prof, ou etudiant).
En cas d’erreur (email inexistant ou mot de passe incorrect), un message d’erreur est affiché côté front.
AJAX (Asynchronous JavaScript and XML) est une technique qui permet à la page web d’envoyer des requêtes au serveur sans recharger la page.
*/