<?php
/** @var Livre $livre */
?>

<section class="livre-detail">

    <div class="livre-detail__container">

        <div class="livre-detail__image">
            <img src="<?= $livre['image'] ?>" alt="<?= htmlspecialchars($livre['titre']) ?>">
        </div>

        <div class="livre-detail__content">

            <h1 class="livre-detail__title">
                <?= htmlspecialchars($livre['titre']) ?>
            </h1>

            <p class="livre-detail__author">
                par <?= htmlspecialchars($livre['auteur']) ?>
            </p>

            <div class="livre-detail__description">
                <?= nl2br(htmlspecialchars($livre['description'])) ?>
            </div>

            <div class="livre-detail__proprietaire">
                <strong>PROPRIÉTAIRE</strong><br><br>
                <?= htmlspecialchars($livre['pseudo']) ?>
            </div>

             <a href="" class="back-button">
                Envoyer un message
            </a>

        </div>

    </div>

</section>