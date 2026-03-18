<?php 

class LivreController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    // uniquement 4 derniers livres
    public function showHome(): void
{
    $livreManager = new LivreManager();
    $livres = $livreManager->getLastLivres(4); 

    $view = new View("Accueil");
    $view->render("home", ['livres' => $livres]);
}


// récupérer tous les livres
public function showAllLivres(): void
{
    $livreManager = new LivreManager();

    // récupérer la recherche
    $search = Utils::request("search");

    if (!empty($search)) {
        $livres = $livreManager->searchLivres($search);
    } else {
        $livres = $livreManager->getAllLivres();
    }

    $view = new View("Tous les livres");
    $view->render("Livres", [
        'livres' => $livres
    ]);
}


    /**
     * Affiche le détail d'un livre.
     * @return void
     */
    public function showLivre() : void
{
    $id = Utils::request("id", -1);

    $livreManager = new LivreManager();
    $livre = $livreManager->getLivreById($id);

    if (!$livre) {
        throw new Exception("Le livre demandé n'existe pas.");
    }

    $view = new View($livre['titre']);
    $view->render("detailLivre", [
        'livre' => $livre
    ]);
}




public function deleteLivre(): void
{
    if (empty($_SESSION['idUtilisateur'])) {
        throw new Exception("Utilisateur non connecté.");
    }

    $id = (int) Utils::request("id");

    if ($id <= 0) {
        throw new Exception("ID invalide.");
    }

    $livreManager = new LivreManager();
    $livre = $livreManager->getLivreById($id);

    if (!$livre) {
        throw new Exception("Livre introuvable.");
    }

    if ((int)$livre['utilisateur_id'] !== (int)$_SESSION['idUtilisateur']) {
        throw new Exception("Action interdite.");
    }

    $livreManager->deleteLivre($id);

    Utils::redirect("profile");
}

public function showEditLivre(): void
{
    if (empty($_SESSION['idUtilisateur'])) {
        Utils::redirect("connectionForm");
    }

    $id = (int) Utils::request("id");

    if ($id <= 0) {
        throw new Exception("ID invalide.");
    }

    $livreManager = new LivreManager();
    $livre = $livreManager->getLivreById($id);

    if (!$livre) {
        throw new Exception("Livre introuvable.");
    }

    if ((int)$livre['utilisateur_id'] !== (int)$_SESSION['idUtilisateur']) {
        throw new Exception("Action interdite.");
    }

    $view = new View("Modifier un livre");
    $view->render("editLivre", [
        'livre' => $livre
    ]);
}

public function updateLivre(): void
{
    if (empty($_SESSION['idUtilisateur'])) {
        Utils::redirect("connectionForm");
    }

    $id = (int) Utils::request("id");
    $titre = trim(Utils::request("titre", ""));
    $auteur = trim(Utils::request("auteur", ""));
    $description = trim(Utils::request("description", ""));
    $image = trim(Utils::request("image", ""));
    $disponible = Utils::request("disponible", "1");

    if ($id <= 0 || empty($titre) || empty($auteur)) {
        throw new Exception("Les champs obligatoires sont manquants.");
    }

    $livreManager = new LivreManager();
    $livre = $livreManager->getLivreById($id);

    if (!$livre) {
        throw new Exception("Livre introuvable.");
    }

    if ((int)$livre['utilisateur_id'] !== (int)$_SESSION['idUtilisateur']) {
        throw new Exception("Action interdite.");
    }

    $livreManager->updateLivre(
        $id,
        $titre,
        $auteur,
        $description,
        $image,
        (int)$disponible
    );

    Utils::redirect("profile");
}



}