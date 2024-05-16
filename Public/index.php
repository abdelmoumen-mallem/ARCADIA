<?php

// Inclusion du fichier du routeur et des contrôleurs
require_once '../Router/routerHandler.php';
require_once '../Controllers/PageController.php';
require_once '../Controllers/UserController.php';

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

$router->addRoute('GET', '/test', 'PageController', 'test');



$router->addRoute('POST', '/connexion', 'UserController', 'login');

// Routes soumis a connexion utilisateur



// Appel de la fonction handleRoute pour gérer les routes
handleRoute($router);
