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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="/centre-langue/centre-langue/frontend/css/global.css">
    <link rel="stylesheet" href="/centre-langue/centre-langue/frontend/css/profil.css">
</head>
<body>
<?php include(__DIR__ . '/components/navbar.php'); ?>
<div class="page-wrapper">
    <div class="main-content" style="margin-left: 0;">
        <h1>Mon Profil</h1>
        <!-- INFOS PROFIL -->
        <div class="profil-container">
            <div class="profil-info">
                <div class="info-row">
                    <span class="info-label">Nom</span>
                    <span class="info-value" id="nomUser"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Prénom</span>
                    <span class="info-value" id="prenomUser"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value" id="emailUser"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Rôle</span>
                    <span class="info-value" id="roleUser"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Adresse</span>
                    <span class="info-value" id="adresseUser"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date de naissance</span>
                    <span class="info-value" id="dateNaissanceUser"></span>
                </div>
            </div>
        </div>

        <!-- CHANGER MOT DE PASSE -->
        <div class="form-container" style="margin-top: 32px;">
            <h2>Changer le mot de passe</h2>
            <div class="form-group">
                <label>Ancien mot de passe</label>
                <input type="password" id="ancienPassword" placeholder="Ancien mot de passe">
            </div>
            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" id="nouveauPassword" placeholder="Nouveau mot de passe">
            </div>
            <div class="form-group">
                <label>Confirmer le nouveau mot de passe</label>
                <input type="password" id="confirmPassword" placeholder="Confirmer">
            </div>
            <button id="btnChangerMdp">Changer le mot de passe</button>
            <p id="messageMdp"></p>
        </div>

    </div>
</div>
<script src="/centre-langue/centre-langue/frontend/js/views/ProfilView.js"></script>
</body>
</html>