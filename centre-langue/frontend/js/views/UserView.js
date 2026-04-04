// Afficher/cacher les champs selon le rôle choisi
document.getElementById('roleSelect').addEventListener('change', function() {
    const role = this.value;
    // Cacher tous les champs spécifiques d'abord
    document.getElementById('champProf').style.display = 'none';
    document.getElementById('champEtudiant').style.display = 'none';
    // Afficher selon le rôle
    if(role === 'prof') {
        document.getElementById('champProf').style.display = 'block';
    } else if(role === 'etudiant') {
        document.getElementById('champEtudiant').style.display = 'block';
    }
});
document.getElementById('btnCreer').addEventListener('click', function() {
    const role = document.getElementById('roleSelect').value;
    const message = document.getElementById('message');
    if(!role) {
        message.className = 'error';
        message.innerHTML = 'Veuillez choisir un rôle';
        return;
    }
    /*envoie seulement champs utiles form simple envoie tous et recharge la page
    contrôles exactement quels champs envoyer selon le rôle. Et c'est JS qui gère l'envoi sans rechargement — pas FormData lui-même
    */
   //FormData c'est un objet en mémoire dans le navigateur
    const data = new FormData();
    data.append('RoleUser',          role);
    data.append('NomUser',           document.getElementById('nom').value);
    data.append('PrenomUser',        document.getElementById('prenom').value);
    data.append('EmailUser',         document.getElementById('email').value);
    data.append('DateNaissanceUser', document.getElementById('dateNaissance').value);
    data.append('AdresseUser',       document.getElementById('adresse').value);
    data.append('PhotoUser',         '');
    if(role === 'prof') {
        data.append('Specialite', document.getElementById('specialite').value);
    } else if(role === 'etudiant') {
        data.append('ParentNom',    document.getElementById('parentNom').value);
        data.append('ParentPrenom', document.getElementById('parentPrenom').value);
        data.append('ParentTel',    document.getElementById('parentTel').value);
    }
    //$_POST['NomUser']
    fetch('/centre-langue/centre-langue/index.php?route=createUser', {
        method: 'POST',
        body: data
    })
    .then(res => res.json())
    //txt-> objet JS en mémoire
    .then(data => {
        if(data.success) {
            message.className = 'success';
            message.innerHTML = data.message;
            document.getElementById('resultatPassword').style.display = 'block';
            document.getElementById('passwordGenere').innerHTML = data.password;
        } else {
            message.className = 'error';
            message.innerHTML = data.message;
        }
    });
});
/*
Le formulaire enverrait tous les champs
 — même ceux cachés. Si le directeur crée un gérant, Specialite et ParentNom 
 seraient quand même envoyés avec des valeurs vides. C'est inutile et pas propre.
J’ai utilisé FormData avec fetch pour envoyer les données dynamiquement sans rechargement de page. Cela permet d’envoyer 
uniquement les champs nécessaires selon le rôle et de gérer facilement les fichiers si besoin.
 C’est plus flexible qu’un formulaire classique
*/