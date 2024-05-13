<?php


use Src\Models\Router;

// Inclusion du fichier du routeur et des contrôleurs
require_once '../Models/routerHandler.php';
require_once '../Controllers/PageController.php';
require_once '../Models/Router.php';

// Instanciation de la classe Router
$router = new Router();

// Définition des routes
$router->addRoute('GET', '/', 'PageController', 'accueil');
$router->addRoute('GET', '/contacts', 'PageController', 'contacts');
$router->addRoute('GET', '/services', 'PageController', 'services');
$router->addRoute('GET', '/habitats', 'PageController', 'habitats');
$router->addRoute('GET', '/test', 'PageController', 'test');


// Appel de la fonction handleRoute pour gérer les routes
handleRoute($router);
