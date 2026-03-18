<?php /** @var array $livre */ ?>

<section class="edit-livre">
    <a href="index.php?action=profile" class="edit-livre__back">← retour</a>

    <h1 class="edit-livre__title">Modifier les informations</h1>

    <div class="edit-livre__card">
        <form action="index.php?action=updateLivre" method="post" class="edit-livre__form">
            <input type="hidden" name="id" value="<?= (int)$livre['id'] ?>">

            <div class="edit-livre__left">
                <label class="edit-livre__label">Photo</label>

                <img
                    class="edit-livre__image"
                    src="<?= htmlspecialchars($livre['image'] ?: 'https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg') ?>"
                    onerror="this.onerror=null;this.src='https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg';"
                    alt="<?= htmlspecialchars($livre['titre']) ?>"
                >

                <label class="edit-livre__small-label" id="toggleImageInput">
                    Modifier la photo
                </label>

                <input 
                    type="text" 
                    name="image" 
                    id="imageInput"
                    value="<?= htmlspecialchars($livre['image']) ?>"
                    class="hidden"
                >
            </div>

            <div class="edit-livre__right">
                <label class="edit-livre__label">Titre</label>
                <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>

                <label class="edit-livre__label">Auteur</label>
                <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required>

                <label class="edit-livre__label">Commentaire</label>
                <textarea name="description" rows="10"id="description"><?= htmlspecialchars($livre['description']) ?></textarea>

                <label class="edit-livre__label">Disponibilité</label>
                <select name="disponible">
                    <option value="1" <?= (int)$livre['disponible'] === 1 ? 'selected' : '' ?>>disponible</option>
                    <option value="0" <?= (int)$livre['disponible'] === 0 ? 'selected' : '' ?>>non dispo</option>
                </select>

                <button type="submit" class="edit-livre__button">Valider</button>
            </div>
        </form>
    </div>
</section>

<script>
function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

// initialisation au chargement
document.addEventListener("DOMContentLoaded", function() {
    const textarea = document.getElementById("description");
    autoResize(textarea);

    textarea.addEventListener("input", function() {
        autoResize(this);
    });
});

document.addEventListener("DOMContentLoaded", function () {

    const label = document.getElementById("toggleImageInput");
    const input = document.getElementById("imageInput");

    label.addEventListener("click", function () {
        input.classList.toggle("hidden");
        input.focus();
    });

});
</script>