<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom Troc</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body> 
<header> 
<nav class="navbar">

    <div class="navbar__left">
        <div class="navbar__logo">TT</div>
        <span class="navbar__brand">Tom Troc</span>

        <a href="index.php">Accueil</a>
        <a href="index.php?action=All-livres">Nos livres à l'échange</a>
    </div>

    <div class="navbar__right">

        <?php if (!empty($_SESSION['idUtilisateur'])): ?>

            <a href="index.php?action=messagerie" class="navbar__link">
                💬 Messagerie <span class="badge">1</span>
            </a>

            <a href="index.php?action=profile" class="navbar__link">
                👤 Mon compte
            </a>

            <a href="index.php?action=disconnectUser" class="navbar__link">
                Déconnexion
            </a>

        <?php else: ?>

            <a href="index.php?action=connectionForm" class="navbar__link">
                Connexion
            </a>

        <?php endif; ?>

    </div>

</nav>
    
    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
 <!-- Footer -->
<footer class="site-footer">
    <div class="footer-content">
        <nav class="footer-links">
            <a href="#">Politique de confidentialité</a>
            <a href="#">Mentions légales</a>
        </nav>

        <div class="footer-brand">
            <span class="footer-name">Tom Troc&copy;</span>
            <span class="footer-logo">TT</span>
        </div>
    </div>
</footer>

</body>
</html>