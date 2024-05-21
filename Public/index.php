<?php

// Inclusion du fichier du routeur et des contrôleurs
require_once '../Router/routerHandler.php';
require_once '../Controllers/PageController.php';
require_once '../Controllers/UserController.php';
require_once '../Controllers/AvisController.php';
require_once '../Controllers/CollaborateursController.php';
require_once '../Controllers/ServicesController.php';



require_once '../Middleware/AuthMiddleware.php';

require_once '../Router/Router.php';

// Instanciation de la classe Router
$router = new Router();

// Routes public
$router->addRoute('GET', '/', 'PageController', 'accueil');
$router->addRoute('GET', '/contacts', 'PageController', 'contacts');
$router->addRoute('GET', '/services', 'PageController', 'services');
$router->addRoute('GET', '/habitats', 'PageController', 'habitats');
$router->addRoute('GET', '/connexion', 'PageController', 'connexion');
$router->addRoute('GET', '/connexion/{id}', 'PageController', 'connexion');
$router->addRoute('GET', '/error', 'PageController', 'error404');
$router->addRoute('POST', '/connexion', 'UserController', 'login');
$router->addRoute('GET', '/creationPassword/{id}', 'PageController', 'creationPassword');
$router->addRoute('POST', '/creationPassword/{id}', 'CollaborateursController', 'updatePassword');
$router->addRoute('POST', '/creationAvis', 'AvisController', 'insert');

// Route soumis a authentification utilisateur
if (middleware_auth()) {
    $router->addRoute('GET', '/accueil_admin', 'PageController', 'accueil_admin');
    $router->addRoute('GET', '/services_admin', 'PageController', 'services_admin');
    $router->addRoute('GET', '/habitats_admin', 'PageController', 'habitats_admin');
    $router->addRoute('GET', '/animaux_admin', 'PageController', 'animaux_admin');
    $router->addRoute('GET', '/horaires_admin', 'PageController', 'horaires_admin');
    $router->addRoute('GET', '/compte_rendu_admin', 'PageController', 'compte_rendu_admin');
    $router->addRoute('GET', '/consommation_animaux_admin', 'PageController', 'consommation_animaux_admin');
    $router->addRoute('GET', '/avis_admin', 'PageController', 'avis_admin');
    $router->addRoute('GET', '/contacts_admin', 'PageController', 'contacts_admin');
    $router->addRoute('GET', '/roles_admin', 'PageController', 'roles_admin');
    $router->addRoute('GET', '/deconnexion', 'UserController', 'logout');

    if ($_SESSION['id_user_arcadia']['role_id'] === 1) {
        $router->addRoute('GET', '/collaborateurs_admin', 'PageController', 'collaborateurs_admin');
        $router->addRoute('POST', '/collaborateurs_admin', 'CollaborateursController', 'show');
        $router->addRoute('POST', '/collaborateurs_admin_update', 'CollaborateursController', 'update');
        $router->addRoute('POST', '/collaborateurs_admin_insert', 'CollaborateursController', 'insert');
        $router->addRoute('POST', '/collaborateurs_admin_delete', 'CollaborateursController', 'delete');
        $router->addRoute('POST', '/collaborateurs_admin_mail', 'CollaborateursController', 'sendEmail');
    }

    $router->addRoute('POST', '/visibleAvis', 'AvisController', 'update');

    $router->addRoute('POST', '/services_admin_insert', 'ServicesController', 'insert');
    $router->addRoute('POST', '/services_admin_update', 'ServicesController', 'update');
    $router->addRoute('POST', '/services_admin_show', 'ServicesController', 'show');
    $router->addRoute('POST', '/services_admin_delete', 'ServicesController', 'delete');

    $router->addRoute('POST', '/habitats_admin_insert', 'HabitatsController', 'insert');
    $router->addRoute('POST', '/habitats_admin_update', 'HabitatsController', 'update');
    $router->addRoute('POST', '/habitats_admin_show', 'HabitatsController', 'show');
    $router->addRoute('POST', '/habitats_admin_delete', 'HabitatsController', 'delete');
}

// Appel de la fonction handleRoute pour gérer les routes
handleRoute($router);
