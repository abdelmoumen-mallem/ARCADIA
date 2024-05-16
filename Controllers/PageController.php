<?php

class PageController
{
    public function accueil()
    {
        require_once '../Views/pages/accueil.php';
    }

    public function services()
    {
        require_once '../Views/pages/services.php';
    }

    public function habitats()
    {
        require_once '../Views/pages/habitats.php';
    }

    public function contacts()
    {
        require_once '../Views/pages/contacts.php';
    }

    public function connexion()
    {
        require_once '../Views/pages/connexion.php';
    }

    public function error404()
    {
        require_once '../Views/errorPage/error404.php';
    }

    public function test()
    {
        require_once '../Views/users/test.php';
    }
}
