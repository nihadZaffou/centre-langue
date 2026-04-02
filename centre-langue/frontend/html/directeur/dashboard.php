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
    <title>Dashboard Directeur</title>
  <link rel="stylesheet" href="/centre-langue/centre-langue/frontend/css/global.css"> 
</head>
<body>
 <?php include('../components/navbar.php'); ?>
    <div class="page-wrapper">
        <?php include('sidebar_directeur.php'); ?>

        <div class="main-content">
            <h1>Bienvenue <?php echo $_SESSION['user_prenom']; ?></h1>
        </div>
    </div>
</body>
</html>
