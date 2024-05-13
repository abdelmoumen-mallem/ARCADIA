<?php

// Détermine quelle action doit être exécutée
function handleRoute($router)
{
    // Récupération de la méthode HTTP et de l'URI de la requête
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    // Récupération du gestionnaire de route pour la méthode et l'URI donnés
    $handler = $router->gethandler($method, $uri);

    // Vérification si un gestionnaire de route a été trouvé
    if ($handler == null) {
        // Si aucun gestionnaire de route n'a été trouvé, renvoyer une erreur 404
        header('HTTP/1.1 404 Not Found');
        exit();
    }

    // Instanciation du contrôleur et exécution de l'action correspondante
    $controller = new $handler['controller']();
    $action = $handler['action'];
    $controller->$action();
}
