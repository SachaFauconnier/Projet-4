<?php

?>
<!-- Section hero -->
<section class="hero">
    <div class="hero__container">

        <div class="hero__content">
            <h1 class="hero__title">
                Rejoignez nos <br>lecteurs passionnés
            </h1>

            <p class="hero__text">
                Donnez une nouvelle vie à vos livres en les échangeant avec
                d'autres amoureux de la lecture. Nous croyons en la magie du
                partage de connaissances et d’histoires à travers les livres.
            </p>

            <a href="/books" class="btn btn--primary">
                Découvrir
            </a>
        </div>

        <div class="hero__image">
            <img src="https://i.ibb.co/MDWc9YK0/main1.png" 
                 alt="Une personne assise entourée de piles de livres devant une librairie">
        </div>

    </div>
</section>


<!-- Section livres -->
<section class="section-livres">
    <h1 class="section-title">Les derniers livres ajoutés</h1>

    <div class="derniersLivres">
        <?php foreach($livres as $livre): ?>
            <article class="livre">
                <div class="livre-image">
                    <img src="<?= $livre->getImage() ?>" alt="<?= htmlspecialchars($livre->getTitle()) ?>">
                </div>
                <div class="livre-body">
                    <h2><?= htmlspecialchars($livre->getTitle()) ?></h2>
                    <p class="auteur"><?= htmlspecialchars($livre->getAuteur()) ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="btn-container">
        <a href="index.php?action=All-livres" class="btn-voir-tous">Voir tous les livres</a>
    </div>
</section>


<!-- Section Comment ça marche -->
<section class="comment">
    <h2 class="comment-title">Comment ça marche ?</h2>
    <p class="comment-subtitle">
        Échanger des livres avec TomTroc c'est simple et<br>
        amusant ! Suivez ces étapes pour commencer :
    </p>

    <div class="etapes">
        <div class="etape">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
        </div>
        <div class="etape">
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </div>
        <div class="etape">
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </div>
        <div class="etape">
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </div>
    </div>

    <div class="btn-container">
        <a href="index.php?action=All-livres" class="btn-voir-tous-outline">Voir tous les livres</a>
    </div>
</section>

<!-- Image pleine largeur -->
<section class="section-image-banner">
    <img src="https://i.ibb.co/zWb4s9xN/image-bibliotheque.png" alt="Personne parcourant des livres dans une bibliothèque">

</section>
<!-- Section Nos valeurs -->
<section class="section-valeurs">
    <div class="valeurs-content">
        <div class="valeurs-texte">
            <h2 class="valeurs-title">Nos valeurs</h2>
            <p>
                Chez Tom Troc, nous mettons l'accent sur le
                partage, la découverte et la communauté. Nos
                valeurs sont ancrées dans notre passion pour les
                livres et notre désir de créer des liens entre les
                lecteurs. Nous croyons en la puissance des histoires
                pour rassembler les gens et inspirer des
                conversations enrichissantes.
            </p>
            <p>
                Notre association a été fondée avec une conviction
                profonde : chaque livre mérite d'être lu et partagé.
            </p>
            <p>
                Nous sommes passionnés par la création d'une
                plateforme conviviale qui permet aux lecteurs de se
                connecter, de partager leurs découvertes littéraires
                et d'échanger des livres qui attendent patiemment
                sur les étagères.
            </p>
            <span class="valeurs-signature">L'équipe Tom Troc</span>
        </div>
        <div class="valeurs-icon">
            <!-- Coeur vert SVG -->
            <svg width="100" height="120" viewBox="0 0 100 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 30 C50 15, 75 5, 80 25 C85 45, 50 65, 50 65 C50 65, 15 45, 20 25 C25 5, 50 15, 50 30Z"
                      stroke="#2ecc71" stroke-width="2" fill="none"/>
                <line x1="50" y1="65" x2="50" y2="115" stroke="#2ecc71" stroke-width="2"/>
            </svg>
        </div>
    </div>
</section>


