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
    $livres = $livreManager->getAllLivres(); 

    $view = new View("Tous les livres");
    $view->render("livres", ['livres' => $livres]);
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


    

    /**
     * Affiche le formulaire d'ajout d'un livre.
     * @return void
     */
    public function addLivre() : void
    {
        $view = new View("Ajouter un livre");
        $view->render("addLivre");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos() {
        $view = new View("A propos");
        $view->render("apropos");
    }


}