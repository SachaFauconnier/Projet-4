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
        $email = trim(Utils::request("email", ""));
        $password = Utils::request("password", "");

        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Adresse email invalide.");
        }

        $utilisateurManager = new UtilisateurManager();
        $utilisateur = $utilisateurManager->getUserByEmail($email);

        if (!$utilisateur) {
            throw new Exception("Utilisateur inexistant.");
        }

        if (!password_verify($password, $utilisateur->getMot_de_passe())) {
            throw new Exception("Mot de passe incorrect.");
        }

        session_regenerate_id(true);
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
        $pseudo = trim(Utils::request("login", ""));
        $email = trim(Utils::request("email", ""));
        $password = Utils::request("password", "");

        if (empty($pseudo) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Adresse email invalide.");
        }

        $utilisateurManager = new UtilisateurManager();

        $utilisateurExistant = $utilisateurManager->getUserByEmail($email);
        if ($utilisateurExistant) {
            throw new Exception("Cet email est déjà utilisé.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $utilisateurManager->insertUtilisateur($pseudo, $email, $hashedPassword);

        Utils::redirect("connectionForm");
    }

    public function updateUser(): void
    {
    if (empty($_SESSION['idUtilisateur'])) {
        Utils::redirect("connectionForm");
    }

    $id = (int) $_SESSION['idUtilisateur'];
    $email = trim(Utils::request("email", ""));
    $pseudo = trim(Utils::request("pseudo", ""));
    $password = Utils::request("password", "");
    $avatar = trim(Utils::request("avatar", ""));

    if (empty($email) || empty($pseudo)) {
        throw new Exception("Email et pseudo obligatoires.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Adresse email invalide.");
    }

    if (!empty($avatar) && !filter_var($avatar, FILTER_VALIDATE_URL)) {
        throw new Exception("URL de l'image invalide.");
    }

    if (empty($avatar)) {
        $avatar = null;
    }

    $utilisateurManager = new UtilisateurManager();

    $utilisateurExistant = $utilisateurManager->getUserByEmail($email);

    if ($utilisateurExistant && $utilisateurExistant->getId() !== $id) {
        throw new Exception("Cet email est déjà utilisé.");
    }

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $utilisateurManager->updateUtilisateurAvecMotDePasse($id, $pseudo, $email, $hashedPassword, $avatar);
    } else {
        $utilisateurManager->updateUtilisateurSansMotDePasse($id, $pseudo, $email, $avatar);
    }

    Utils::redirect("profile");
    }

    public function showPublicProfile(): void
    {
        $id = (int) Utils::request("id", 0);

        if ($id <= 0) {
            throw new Exception("Utilisateur introuvable.");
        }

        $utilisateurManager = new UtilisateurManager();
        $utilisateur = $utilisateurManager->getUtilisateurById($id);

        if (!$utilisateur) {
            throw new Exception("Utilisateur introuvable.");
        }

        $livreManager = new LivreManager();
        $livres = $livreManager->getLivresByUser($id);

        $view = new View("Profil utilisateur");
        $view->render("publicProfile", [
            'utilisateur' => $utilisateur,
            'livres' => $livres
        ]);
    }


    public function showMessagerie(): void
    {
        if (empty($_SESSION['idUtilisateur'])) {
            Utils::redirect("connectionForm");
        }

        $idUtilisateur = (int) $_SESSION['idUtilisateur'];
        $otherUserId = (int) Utils::request("user", 0);

        $messageManager = new MessageManager();
        $utilisateurManager = new UtilisateurManager();

        $conversations = $messageManager->getConversationsByUser($idUtilisateur);

        $selectedUser = null;
        $messages = [];

        if ($otherUserId > 0) {
            $selectedUser = $utilisateurManager->getUtilisateurById($otherUserId);
            $messages = $messageManager->getMessagesBetweenUsers($idUtilisateur, $otherUserId);
        }

        $view = new View("Messagerie");
        $view->render("messagerie", [
            'conversations' => $conversations,
            'selectedUser' => $selectedUser,
            'messages' => $messages,
            'idUtilisateur' => $idUtilisateur
        ]);
    }

    public function sendMessage(): void
    {
        if (empty($_SESSION['idUtilisateur'])) {
            Utils::redirect("connectionForm");
        }

        $expediteurId = (int) $_SESSION['idUtilisateur'];
        $destinataireId = (int) Utils::request("destinataire_id", 0);
        $contenu = trim(Utils::request("contenu", ""));

        if ($destinataireId <= 0 || empty($contenu)) {
            throw new Exception("Message invalide.");
        }

        $messageManager = new MessageManager();
        $messageManager->sendMessage($expediteurId, $destinataireId, $contenu);

        Utils::redirect("messagerie&user=" . $destinataireId);
    }

    

}