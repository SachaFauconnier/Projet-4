<?php

?>

<form method="get" action="index.php"  class="form-Alllivres">
    <div class="search__container">
        <h2 class="search__title">Nos livres à l'échange</h2>

        <div class="search">
            <input 
                type="text" 
                name="search" 
                id="searchInput"
                class="search__search-input" 
                placeholder="Rechercher un livre"
            >

            <input type="hidden" name="action" value="All-livres">

        </div>
    </div>
</form>

<!-- Section livres -->
<section class="section-livres">

    <div class="livres" id="livresContainer">
        <?php foreach($livres as $livre): ?>
            <article class="livre">

                <a href="index.php?action=detaillivre&id=<?= $livre->getId() ?>">

                    <div class="livre-image">
                        <img 
                            src="<?= htmlspecialchars($livre->getImage() ?: 'https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg') ?>" 
                            onerror="this.onerror=null;this.src='https://cdn.paris.fr/paris/2021/10/04/huge-9394fb10a8ef69a7572e9e273521dfb8.jpeg';"
                            alt="<?= htmlspecialchars($livre->getTitre()) ?>"
                        >
                    
                        <?php if (!$livre->getDisponible()): ?>
                            <span class="badge-dispo">non dispo.</span>
                        <?php endif; ?> 
                    </div>

                    <div class="livre-body">
                        <h2><?= htmlspecialchars($livre->getTitre()) ?></h2>
                        <p class="auteur"><?= htmlspecialchars($livre->getAuteur()) ?></p>
                        <p class="vendeur"> Vendu par : <?= htmlspecialchars($livre->getPseudo()) ?></p>
                    </div>

                </a>

            </article>
        <?php endforeach; ?>
    </div>

</section>




</section>

<script>
(function() {

const input = document.getElementById("searchInput");
const container = document.getElementById("livresContainer");

let timer;

if (!input) return; // sécurité

input.addEventListener("keyup", function () {

    clearTimeout(timer);

    timer = setTimeout(() => {
        const value = input.value;

        fetch("index.php?action=searchAjax&search=" + encodeURIComponent(value))
            .then(res => res.text())
            .then(data => {
                container.innerHTML = data;
            });

    }, 300);
});

})();
</script>