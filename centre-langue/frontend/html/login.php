<?php
session_start();
if(isset($_SESSION['user_id'])){
    $role = $_SESSION['user_role'];
    header("Location: /centre-langue/centre-langue/frontend/html/" . $role . "/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NIHAD Center - Connexion</title>
    <link rel="stylesheet" href="../css/global.css">
<link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
<form id="loginForm">
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" placeholder="votre@email.com" required>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" id="password" placeholder="••••••••" required>
            </div>
            <div id="spinner" class="spinner" style="display:none;">
    <div class="spinner-cercle"></div>
    <p>Connexion en cours...</p>
</div>
            <button type="submit">Se connecter</button>
            <p id="message"></p>
        </form>

    </div>
    <script src="../js/views/loginView.js"></script>
</body>
</html>