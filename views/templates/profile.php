<section class="account">

<h1>Mon compte</h1>

<div class="account-top">

    <!-- Profil -->
    <div class="profile-card">
        <img src="https://i.ibb.co/fVbxwgSY/Mask-group.png" class="avatar">

        <a class="edit-photo">modifier</a>

        <hr>

        <h2><?= $utilisateur->getPseudo(); ?></h2>
        <?php
            $dateInscription = new DateTime($utilisateur->getDateCreation());
            $today = new DateTime();

            $years = $today->diff($dateInscription)->y;
            ?>

            <p>
                Membre depuis 
                <?= $years ?> 
                <?= $years > 1 ? 'ans' : 'an' ?>
        </p>

        <span class="library">
            Bibliothèque <br>
            <?php $nbLivres = count($livres); ?>

            <?= $nbLivres ?> <?= $nbLivres > 1 ? 'livres' : 'livre' ?>
        </span>
    </div>


    <!-- Informations -->
    <div class="profile-form">

        <h3>Vos informations personnelles</h3>

        <form method="post" action="index.php?action=updateUser">

            <label>Adresse email</label>
            <input type="email" name="email" value="<?= $utilisateur->getEmail(); ?>">

            <label>Mot de passe</label>
            <input type="password" name="password" placeholder="********">

            <label>Pseudo</label>
            <input type="text" name="pseudo" value="<?= $utilisateur->getPseudo(); ?>">

            <button class="save">Enregistrer</button>

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
<?php foreach($livres as $livre): ?>

<tr>

<td>
    <img 
        src="<?= htmlspecialchars($livre->getImage() ?: 'https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg') ?>" 
        onerror="this.onerror=null;this.src='https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg';"
        alt="<?= htmlspecialchars($livre->getTitre()) ?>"class="livre-profile-img"
    >
</td>

<td><?= $livre->getTitre(); ?></td>

<td><?= $livre->getAuteur(); ?></td>

<td class="desc">
<?= htmlspecialchars(substr($livre->getDescription() ?? '',0,80)); ?>...
</td>

<td>
<span class="<?= $livre->getDisponible() ? 'available' : 'not-available' ?>">
<?= $livre->getDisponible() ? 'disponible' : 'non dispo' ?>
</span>
</td>

<td class="actions">
    <a href="index.php?action=editLivre&id=<?= $livre->getId() ?>">Éditer</a>

    <form action="index.php?action=deleteLivre" method="post" style="display:inline;">
        <input type="hidden" name="id" value="<?= $livre->getId() ?>">
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