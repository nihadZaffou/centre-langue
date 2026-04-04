// Charger le profil au chargement de la page
/* 
nomEvenement = 'DOMContentLoaded' → signifie : 
“quand tout le HTML est chargé et analysé par le navigateur
*/
document.addEventListener('DOMContentLoaded', function() {
    fetch('/centre-langue/centre-langue/index.php?route=getProfil')
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            document.getElementById('nomUser').textContent         = data.data.NomUser;
            document.getElementById('prenomUser').textContent      = data.data.PrenomUser;
            document.getElementById('emailUser').textContent       = data.data.EmailUser;
            document.getElementById('roleUser').textContent        = data.data.RoleUser;
            document.getElementById('adresseUser').textContent     = data.data.AdresseUser;
            document.getElementById('dateNaissanceUser').textContent = data.data.DateNaissanceUser;
        }
        console.log("rien")
    }
);
    
});

// Changer le mot de passe
document.getElementById('btnChangerMdp').addEventListener('click', function() {
    const messageMdp = document.getElementById('messageMdp');
    const data = new FormData();
    data.append('ancienPassword',  document.getElementById('ancienPassword').value);
    data.append('nouveauPassword', document.getElementById('nouveauPassword').value);
    data.append('confirmPassword', document.getElementById('confirmPassword').value);
    fetch('/centre-langue/centre-langue/index.php?route=updatePassword', {
        method: 'POST',
        body: data
    })
    //.then() permet donc de synchroniser ton code avec la réponse du serveur, sans bloquer la page
    .then(res => res.json())
    .then(result => {
        if(result.success) {
            messageMdp.className = 'success';
            messageMdp.innerHTML = result.message;
            // Vider les champs
            document.getElementById('ancienPassword').value  = '';
            document.getElementById('nouveauPassword').value = '';
            document.getElementById('confirmPassword').value = '';
        } else {
            messageMdp.className = 'error';
            messageMdp.innerHTML = result.message;
        }
    });
});