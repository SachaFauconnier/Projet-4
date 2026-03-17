<?php foreach($livres as $livre): ?>
    <article class="livre">

        <a href="index.php?action=detaillivre&id=<?= $livre->getId() ?>">

            <div class="livre-image">
                        <img 
                            src="<?= htmlspecialchars($livre->getImage() ?: 'https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg') ?>" 
                            onerror="this.onerror=null;this.src='https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg';"
                            alt="<?= htmlspecialchars($livre->getTitre()) ?>"
                        >
            </div>

            <div class="livre-body">
                <h2><?= htmlspecialchars($livre->getTitre()) ?></h2>
                <p><?= htmlspecialchars($livre->getAuteur()) ?></p>
                <p>Vendu par : <?= htmlspecialchars($livre->getPseudo() ?? 'Inconnu') ?></p>
            </div>

        </a>

    </article>
<?php endforeach; ?>