<?php
$page_courante = basename($_SERVER['PHP_SELF']);
//$_SERVER=tab cree par php contient des infos sur le serveur et la requête actuelle.
//$_SERVER['PHP_SELF'] :chemin complet de la page actuelle;
//basename():extrait juste le nom du fichier à partir d'un chemin 
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

    </div>
<!-- 
u es sur langues.php
        ↓
$_SERVER['PHP_SELF'] = ".../langues.php"
        ↓
basename() → "langues.php"
        ↓
$page_courante === 'langues.php' → TRUE
        ↓
class="menu-item active" → surligné en or 
--> 
</aside>