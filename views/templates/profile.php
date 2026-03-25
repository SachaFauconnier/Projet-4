<section class="account">

    <h1>Mon compte</h1>

    <div class="account-top">

        <!-- Profil -->
        <div class="profile-card">

            <img
                class="avatar"
                id="avatarPreview"
                src="<?= htmlspecialchars($utilisateur->getProfileImageOrDefault()) ?>"
                onerror="this.onerror=null;this.src='https://i.ibb.co/fVbxwgSY/Mask-group.png';"
                alt="Photo de profil"
            >
            

            <label id="toggleAvatarInput" style="cursor:pointer;">Modifier
            </label>

            <hr>

            <h2><?= htmlspecialchars($utilisateur->getPseudo()); ?></h2>

            <?php
                $dateInscription = new DateTime($utilisateur->getDateCreation());
                $today = new DateTime();
                $years = $today->diff($dateInscription)->y;
                $nbLivres = count($livres);
            ?>

            <p>
                Membre depuis
                <?= $years ?>
                <?= $years > 1 ? 'ans' : 'an' ?>
            </p>

            <span class="library">
                Bibliothèque <br>
                <?= $nbLivres ?> <?= $nbLivres > 1 ? 'livres' : 'livre' ?>
            </span>
        </div>

        <!-- Informations -->
        <div class="profile-form">

            <h3>Vos informations personnelles</h3>

            <form method="post" action="index.php?action=updateUser">

                <input 
                    type="text" 
                    name="avatar"
                    id="avatarInput"
                    value="<?= htmlspecialchars($utilisateur->getProfileImage() ?? '') ?>"
                    class="hidden"
                >

                <label>Adresse email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($utilisateur->getEmail()); ?>">

                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="********">

                <label>Pseudo</label>
                <input type="text" name="pseudo" value="<?= htmlspecialchars($utilisateur->getPseudo()); ?>">

                <button type="submit" class="save">Enregistrer</button>

            </form>

        </div>

    </div>

    <!-- Liste livres -->
    <div class="livre-profile-list">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Description</th>
                    <th>Disponibilité</th>
                    <th>Action</th>
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
                                    class="livre-profile-img"
                                >
                            </td>

                            <td><?= htmlspecialchars($livre->getTitre()); ?></td>
                            <td><?= htmlspecialchars($livre->getAuteur()); ?></td>

                            <td class="desc">
                                <?= htmlspecialchars(substr($livre->getDescription() ?? '', 0, 80)); ?>...
                            </td>

                            <td>
                                <span class="<?= $livre->getDisponible() ? 'available' : 'not-available' ?>">
                                    <?= $livre->getDisponible() ? 'disponible' : 'non dispo' ?>
                                </span>
                            </td>

                            <td class="actions">
                                <a href="index.php?action=editLivre&id=<?= (int)$livre->getId() ?>">Éditer</a>

                                <form action="index.php?action=deleteLivre" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= (int)$livre->getId() ?>">
                                    <button type="submit" class="delete" onclick="return confirm('Supprimer ce livre ?');">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</section>

<script>
const toggleAvatarInput = document.getElementById('toggleAvatarInput');
const avatarInput = document.getElementById('avatarInput');
const avatarPreview = document.getElementById('avatarPreview');

if (toggleAvatarInput && avatarInput) {
    toggleAvatarInput.addEventListener('click', function () {
        avatarInput.classList.toggle('hidden');
    });
}

if (avatarInput && avatarPreview) {
    avatarInput.addEventListener('input', function () {
        avatarPreview.src = this.value || 'https://i.ibb.co/fVbxwgSY/Mask-group.png';
    });
}
</script>