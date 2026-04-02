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
if($_SESSION['user_role'] !== "gerant"){
    header("Location: ../login.php");
    exit();
}
}?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard gerant</title>
</head>
<body>
    <h1>Bienvenue gerant</h1>
   <a href="/centre-langue/centre-langue/index.php?route=logout">Déconnexion</a>
</body>
</html>
