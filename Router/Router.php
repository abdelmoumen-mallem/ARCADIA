<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function addRoute(string $method, string $path, string $controller, string $action)
    {
        // Remplacez les segments dynamiques par des expressions régulières correspondantes
        $path = preg_replace('/\{(\w+)\}/', '(?<$1>[^\/]+)', $path);


        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function getHandler(string $method, string $uri)
    {
        foreach ($this->routes as $route) {
            // Construction de l'expression régulière à partir du chemin de la route
            $regex = '@^' . $route['path'] . '$@';

            // Vérifie si l'URI correspond à la route
            if ($route['method'] === $method && preg_match($regex, $uri, $matches)) {
                // Retourne les informations sur le gestionnaire avec les segments dynamiques
                return [
                    'method' => $route['method'],
                    'controller' => $route['controller'],
                    'action' => $route['action'],
                    'params' => array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY)
                ];
            }
        }
        return null;
    }
}
