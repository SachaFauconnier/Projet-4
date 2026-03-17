<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $livreController = new LivreController();
            $livreController->showHome();
        break;

                case 'All-livres':
            $livreController = new LivreController();
            $livreController->showAllLivres();
        break;
                case 'detaillivre':
            $livreController = new LivreController();
            $livreController->showLivre();
        break;

        case 'searchAjax':
            $controller = new LivreController();
            $controller->searchAjax();
        break;
        case 'deleteLivre':
            $livreController = new LivreController();
            $livreController->deleteLivre();
        break;
                    

        case 'connectionForm':
            $userController = new UserController();
            $userController->displayConnectionForm();
            break;
        case 'inscriptionForm':
            $userController = new UserController();
            $userController->displayinscriptionForm();
            break;

        case 'connectUser': 
            $userController = new UserController();
            $userController->connectUser();
            break;
        case "createUser":
            $controller = new UserController();
            $controller->createUser();
            break;

        case 'disconnectUser':
            $userController = new UserController();
            $userController->disconnectUser();
            break;  

        case 'profile':
            $userController = new UserController();
            $userController->showProfile();
        break;

        case 'updateUser':
            $userController = new UserController();
            $userController->updateUser();
        break;








    default:
        throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}