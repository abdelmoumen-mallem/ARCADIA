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

    public function accueil_admin()
    {
        require_once '../Views/users/accueil_admin.php';
    }

    public function collaborateurs_admin()
    {
        require_once '../Views/users/collaborateurs_admin.php';
    }

    public function services_admin()
    {
        require_once '../Views/users/services_admin.php';
    }

    public function habitats_admin()
    {
        require_once '../Views/users/habitats_admin.php';
    }

    public function animaux_admin()
    {
        require_once '../Views/users/animaux_admin.php';
    }

    public function horaires_admin()
    {
        require_once '../Views/users/horaires_admin.php';
    }

    public function compte_rendu_admin()
    {
        require_once '../Views/users/compte_rendu_admin.php';
    }

    public function consommation_animaux_admin()
    {
        require_once '../Views/users/consommation_animaux_admin.php';
    }

    public function avis_admin()
    {
        require_once '../Views/users/avis_admin.php';
    }

    public function contacts_admin()
    {
        require_once '../Views/users/contacts_admin.php';
    }

    public function roles_admin()
    {
        require_once '../Views/users/roles_admin.php';
    }

    public function creationPassword()
    {
        require_once '../Views/pages/creationPassword.php';
    }
}
