<section class="messagerie">

    <div class="messagerie__sidebar">
        <h1 class="messagerie__title">Messagerie</h1>

        <div class="messagerie__list">
            <?php foreach ($conversations as $conversation): ?>
                <a 
                    href="index.php?action=messagerie&user=<?= (int)$conversation['id'] ?>" 
                    class="messagerie__item"
                >
                    <img src="https://i.ibb.co/fVbxwgSY/Mask-group.png" alt="" class="messagerie__avatar">

                    <div class="messagerie__item-content">
                        <div class="messagerie__item-top">
                            <span class="messagerie__name"><?= htmlspecialchars($conversation['pseudo']) ?></span>
                            <span class="messagerie__time">
                                <?= date('H:i', strtotime($conversation['last_date'])) ?>
                            </span>
                        </div>
                        <p class="messagerie__preview">Voir la conversation</p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="messagerie__chat">

        <?php if ($selectedUser): ?>

            <div class="messagerie__header">
                <img src="https://i.ibb.co/fVbxwgSY/Mask-group.png" alt="" class="messagerie__avatar">
                <span class="messagerie__header-name"><?= htmlspecialchars($selectedUser->getPseudo()) ?></span>
            </div>

            <div class="messagerie__messages">
                <?php foreach ($messages as $message): ?>
                    <div class="messagerie__bubble-wrapper <?= (int)$message['expediteur_id'] === (int)$idUtilisateur ? 'is-me' : 'is-other' ?>">
                        <div class="messagerie__meta">
                            <?= htmlspecialchars($message['expediteur_pseudo']) ?> · <?= date('H:i', strtotime($message['date_creation'])) ?>
                        </div>

                        <div class="messagerie__bubble">
                            <?= nl2br(htmlspecialchars($message['contenu'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <form action="index.php?action=sendMessage" method="post" class="messagerie__form">
                <input type="hidden" name="destinataire_id" value="<?= (int)$selectedUser->getId() ?>">

                <input 
                    type="text" 
                    name="contenu" 
                    class="messagerie__input"
                    placeholder="Tapez votre message ici"
                    required
                >

                <button type="submit" class="messagerie__button">Envoyer</button>
            </form>

        <?php else: ?>

            <div class="messagerie__empty">
                Sélectionnez une conversation.
            </div>

        <?php endif; ?>

    </div>

</section>