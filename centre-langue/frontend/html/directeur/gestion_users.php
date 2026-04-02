<?php
session_set_cookie_params([
    'path' => '/',
    'domain' => 'localhost',
    'secure' => false,
    'httponly' => true
]);
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}
if($_SESSION['user_role'] !== "directeur"){
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Utilisateurs</title>
    <link rel="stylesheet" href="/centre-langue/centre-langue/frontend/css/global.css">
    <link rel="stylesheet" href="/centre-langue/centre-langue/frontend/css/gestion_users.css">
</head>
<body>
<?php include('../components/navbar.php'); ?>
<div class="page-wrapper">
    <?php include('sidebar_directeur.php'); ?>
    <div class="main-content">

        <h1>Créer un utilisateur</h1>
        <!-- FORMULAIRE CRÉATION -->
        <div class="form-container">
            <div class="form-group">
                <label>Rôle</label>
                <select id="roleSelect">
                    <option value="">-- Choisir un rôle --</option>
                    <option value="gerant">Gérant</option>
                    <option value="directeur">Directeur</option>
                    <option value="prof">Professeur</option>
                    <option value="etudiant">Étudiant</option>
                </select>
            </div>
            <!-- CHAMPS COMMUNS -->
            <div class="form-group">
                <label>Nom</label>
                <input type="text" id="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" id="prenom" placeholder="Prénom">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Date de naissance</label>
                <input type="date" id="dateNaissance">
            </div>
            <div class="form-group">
                <label>Adresse</label>
                <input type="text" id="adresse" placeholder="Adresse">
            </div>

            <!-- CHAMPS SPÉCIFIQUES PROF -->
            <div id="champProf" style="display:none;">
                <div class="form-group">
                    <label>Spécialité</label>
                    <input type="text" id="specialite" placeholder="Spécialité">
                </div>
            </div>

            <!-- CHAMPS SPÉCIFIQUES ÉTUDIANT -->
            <div id="champEtudiant" style="display:none;">
                <div class="form-group">
                    <label>Nom du parent</label>
                    <input type="text" id="parentNom" placeholder="Nom du parent">
                </div>
                <div class="form-group">
                    <label>Prénom du parent</label>
                    <input type="text" id="parentPrenom" placeholder="Prénom du parent">
                </div>
                <div class="form-group">
                    <label>Téléphone du parent</label>
                    <input type="text" id="parentTel" placeholder="Téléphone du parent">
                </div>
            </div>

            <button id="btnCreer">Créer l'utilisateur</button>
            <p id="message"></p>

            <!-- MOT DE PASSE GÉNÉRÉ -->
            <div id="resultatPassword" style="display:none;">
                <p>Mot de passe généré : <strong id="passwordGenere"></strong></p>
            </div>
        </div>

    </div>
</div>
<script src="/centre-langue/centre-langue/frontend/js/views/UserView.js"></script>
</body>
</html>