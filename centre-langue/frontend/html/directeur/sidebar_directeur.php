<?php
$page_courante = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <div class="sidebar-menu">

        <a href="/centre-langue/centre-langue/frontend/html/directeur/dashboard.php" 
           class="menu-item <?php echo $page_courante === 'dashboard.php' ? 'active' : ''; ?>">
            <span class="menu-icon">🏠</span>
            <span class="menu-text">Dashboard</span>
        </a>

        <a href="/centre-langue/centre-langue/frontend/html/directeur/langues.php" 
           class="menu-item <?php echo $page_courante === 'langues.php' ? 'active' : ''; ?>">
            <span class="menu-icon">📚</span>
            <span class="menu-text">Langues</span>
        </a>

        <a href="/centre-langue/centre-langue/frontend/html/directeur/gestion_users.php" 
           class="menu-item <?php echo $page_courante === 'gestion_users.php' ? 'active' : ''; ?>">
            <span class="menu-icon">👥</span>
            <span class="menu-text">Gestion Utilisateurs</span>
        </a>

    </div>
</aside>