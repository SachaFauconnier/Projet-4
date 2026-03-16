
<?php
    /**
     * Template pour afficher le formulaire de connexion.
     */
?>
<section class="Connection">
    <div class="connection-form">
        <form action="index.php?action=connectUser" method="post" class="foldedCorner">
            <h2>Connexion</h2>

            <div class="formGrid">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>

                <button class="submit">Se connecter</button>

                <div class="inscription">
                    Pas de compte ?
                    <a href="index.php?action=inscriptionForm" class="inscription-btn">Inscrivez-vous</a>
                </div>

            </div>
        </form>
    </div>
    <img src=https://i.ibb.co/fVbxwgSY/Mask-group.png>
</section>