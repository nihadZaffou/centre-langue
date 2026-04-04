<?php
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}?>
<nav class="navbar">
    <!-- Logo -->
    <div class="navbar-logo">
    <span class="logo-nihad">NIHAD</span>
    <span class="logo-center">Center</span>
</div>
    <!-- Utilisateur + Déconnexion -->
    <div class="navbar-right">
        <div class="navbar-user">
            <span class="user-name">
                <?php echo $_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom']; ?>
            </span>
            <span class="user-role">
                <?php echo ucfirst($_SESSION['user_role']); ?>
            </span>
        </div>
        <a href="/centre-langue/centre-langue/frontend/html/profil.php" 
        class="btn-profil">
            Mon Profil
        </a>
        <a href="/centre-langue/centre-langue/index.php?route=logout" class="btn-logout">
            Déconnexion
        </a>
    </div>

</nav>