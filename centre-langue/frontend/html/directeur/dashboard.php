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
}?>
/*
`header()` c'est une fonction PHP qui envoie une **entête HTTP** au navigateur.
`Location:` c'est une entête spéciale qui dit au navigateur **"va à cette URL"**.
---*/
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Directeur</title>
</head>
<body>
    <h1>Bienvenue Directeur</h1>
    <a href="/centre-langue/centre-langue/backend/php/index.php?route=logout">Déconnexion</a>
</body>
</html>
