<section class="public-profile">

    <div class="public-profile__container">

        <div class="public-profile__card">
            <img 
                src="https://i.ibb.co/fVbxwgSY/Mask-group.png" 
                alt="Photo profil"
                class="public-profile__avatar"
            >

            <h2 class="public-profile__name">
                <?= htmlspecialchars($utilisateur->getPseudo()) ?>
            </h2>

            <?php
            $dateInscription = new DateTime($utilisateur->getDateCreation());
            $today = new DateTime();
            $years = $today->diff($dateInscription)->y;
            $nbLivres = count($livres);
            ?>

            <p class="public-profile__since">
                Membre depuis <?= $years ?> <?= $years > 1 ? 'ans' : 'an' ?>
            </p>

            <div class="public-profile__library">
                <span class="public-profile__library-label">BIBLIOTHÈQUE</span>
                <span>
                    <?= $nbLivres ?> <?= $nbLivres > 1 ? 'livres' : 'livre' ?>
                </span>
            </div>

            <a 
                href="index.php?action=messagerie&user=<?= $utilisateur->getId() ?>" 
                class="public-profile__message-btn"
            >
                Écrire un message
            </a>
        </div>

        <div class="public-profile__books">
            <table class="public-profile__table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($livres)): ?>
                        <?php foreach ($livres as $livre): ?>
                            <tr>
                                <td>
                                    <img 
                                        src="<?= htmlspecialchars($livre->getImage() ?: 'https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg') ?>"
                                        onerror="this.onerror=null;this.src='https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg';"
                                        alt="<?= htmlspecialchars($livre->getTitre()) ?>"
                                        class="public-profile__book-img"
                                    >
                                </td>

                                <td><?= htmlspecialchars($livre->getTitre()) ?></td>
                                <td><?= htmlspecialchars($livre->getAuteur()) ?></td>
                                <td class="public-profile__desc">
                                    <?= htmlspecialchars(substr($livre->getDescription() ?? '', 0, 90)) ?>...
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Aucun livre disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</section>