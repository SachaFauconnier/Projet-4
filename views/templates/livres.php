<?php

?>

<div class="search__container">
            <h2 class="search__title">Nos livres à l'échange</h2>
            <div class="search">
                <input type="text" class="search__search-input" placeholder="Rechercher un livre">
                <svg class="search__search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </div>
        </div>

<!-- Section livres -->
<section class="section-livres">

    <div class="livres">
        <?php foreach($livres as $livre): ?>
            <article class="livre">

                <a href="index.php?action=detaillivre&id=<?= $livre->getId() ?>">

                    <div class="livre-image">
                        <img src="<?= $livre->getImage() ?>" alt="<?= htmlspecialchars($livre->getTitle()) ?>">
                    </div>

                    <div class="livre-body">
                        <h2><?= htmlspecialchars($livre->getTitle()) ?></h2>
                        <p class="auteur"><?= htmlspecialchars($livre->getAuteur()) ?></p>
                    </div>

                </a>

            </article>
        <?php endforeach; ?>
    </div>

</section>




