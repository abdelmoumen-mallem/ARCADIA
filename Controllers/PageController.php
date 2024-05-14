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
}
