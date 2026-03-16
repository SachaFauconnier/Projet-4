<?php

/**
 * Contrôleur de la partie utilisateur.
 */
class UserController
{
    /**
     * Vérifie que l'utilisateur est connecté.
     * Si non, redirige vers le formulaire de connexion.
     */
    private function checkIfUserIsConnected(): void
    {
        if (empty($_SESSION['utilisateur'])) {
            Utils::redirect("connectionForm");
        }
    }

    /**
     * Affiche la page utilisateur (ex: messagerie, profil, tableau de bord)
     */
    public function showUtilisateur(): void
    {
        $this->checkIfUserIsConnected();

        // Ici on pourrait récupérer des données spécifiques à l'utilisateur, ex : ses livres
        $livreManager = new LivreManager();
        $livres = $livreManager->getAllLivres();

        $view = new View("Utilisateur");
        $view->render("utilisateur", [
            'livres' => $livres,
            'utilisateur' => $_SESSION['utilisateur']
        ]);
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function displayConnectionForm(): void
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Affiche le formulaire d'inscription
     */
    public function displayinscriptionForm(): void
    {
        $view = new View("Inscription");
        $view->render("inscriptionForm");
    }

    /**
     * Connexion de l'utilisateur
     */
    public function connectUser(): void
    {
        $email = Utils::request("email");
        $password = Utils::request("password");

        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $utilisateurManager = new UtilisateurManager();
        $utilisateur = $utilisateurManager->getUserByEmail($email);

        if (!$utilisateur) {
            throw new Exception("Utilisateur inexistant.");
        }

        if ($password !== $utilisateur->getMot_de_passe()) {
            throw new Exception("Mot de passe incorrect.");
        }

        // stocker seulement l'id
        $_SESSION['idUtilisateur'] = $utilisateur->getId();

        Utils::redirect("home");
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function disconnectUser(): void
    {
        session_start();
        unset($_SESSION['utilisateur']);
        unset($_SESSION['idUtilisateur']);
        session_destroy();

        Utils::redirect("home");
    }

    /**
     * Affiche le profil de l'utilisateur
     */
    public function showProfile(): void
    {
        if (empty($_SESSION['idUtilisateur'])) {
            Utils::redirect("connectionForm");
        }

        $utilisateurManager = new UtilisateurManager();
        $utilisateur = $utilisateurManager->getUtilisateurById($_SESSION['idUtilisateur']);

        $livreManager = new LivreManager();
        $livres = $livreManager->getLivresByUser($utilisateur->getId());

        $view = new View("Mon compte");
        $view->render("profile", [
            'utilisateur' => $utilisateur,
            'livres' => $livres
        ]);
    }

    public function createUser(): void
{
    $pseudo = Utils::request("login");
    $email = Utils::request("email");
    $password = Utils::request("password");

    if (empty($pseudo) || empty($email) || empty($password)) {
        throw new Exception("Tous les champs sont obligatoires.");
    }

    $utilisateurManager = new UtilisateurManager();

    // insertion dans la base
    $utilisateurManager->insertUtilisateur($pseudo, $email, $password);

    // redirection vers la page de connexion
    Utils::redirect("connectionForm");
}

}