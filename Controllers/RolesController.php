<?php

require_once '../Models/RolesModel.php';

class RolesController
{
    private $rolesCollaborateurs;

    public function __construct()
    {
        $this->rolesCollaborateurs = new RolesModel();
    }

    public function index()
    {
        return $this->rolesCollaborateurs->index();
    }
}
