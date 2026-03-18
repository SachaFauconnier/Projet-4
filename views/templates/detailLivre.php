
<?php
/** @var array $livre */
?>

<section class="livre-detail">
    <div class="livre-detail__container">

        <div class="livre-detail__image">
            <img 
                src="<?= htmlspecialchars($livre['image'] ?: 'https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg') ?>"
                onerror="this.onerror=null;this.src='https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg';"
                alt="<?= htmlspecialchars($livre['titre']) ?>"
            >
        </div>

        <div class="livre-detail__content">

            <h2 class="livre-detail__title">
                <?= htmlspecialchars($livre['titre']) ?>
            </h2>

            <p class="livre-detail__author">
                par <?= htmlspecialchars($livre['auteur']) ?>
            </p>

            <div class="livre-detail__separator"></div>

            <div class="livre-detail__block">
                <p class="livre-detail__label">DESCRIPTION</p>
                <div class="livre-detail__description">
                    <?= nl2br(htmlspecialchars($livre['description'])) ?>
                </div>
            </div>

            <div class="livre-detail__block">
                <p class="livre-detail__label">PROPRIÉTAIRE</p>

                <a href="" class="livre-detail__owner">
                    <img 
                        src="https://i.ibb.co/fVbxwgSY/Mask-group.png" 
                        alt="Photo du propriétaire"
                        class="livre-detail__owner-avatar"
                    >
                    <span class="livre-detail__owner-name">
                        <?= htmlspecialchars($livre['pseudo']) ?>
                    </span>
                </a>
            </div>

            <a href="index.php?action=messagerie&user=<?= (int)$livre['utilisateur_id'] ?>" class="livre-detail__button">
    Envoyer un message
</a>

        </div>

    </div>
</section>