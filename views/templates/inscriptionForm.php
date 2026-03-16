<?php
    /**
     * Template pour afficher le formulaire de connexion.
     */
?>
<section class="Inscription">
<div class="connection-form">
    <form action="index.php?action=createUser" method="post" class="foldedCorner">
        <h2>Inscription</h2>
        <div class="formGrid">
            <label for="login">Pseudo</label>
            <input type="text" name="login" id="login" required>
            <label for="email">Adresse email</label>
            <input type="text" name="email" id="email" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button class="submit">S'inscrire</button>

            <div class="inscription">Déjà inscrit ?
                <a href="index.php?action=home" class="inscription-btn">Connectez-vous</a>
            </div>
        </div>
    </form>
</div>
<img src=https://i.ibb.co/fVbxwgSY/Mask-group.png>
</section>

