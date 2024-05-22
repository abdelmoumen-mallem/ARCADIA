<?php

require_once 'DatabaseModel.php';

class RolesModel extends DatabaseModel
{
    protected string $table = 'roles';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($filtre)
    {
        return $this->indexGeneral($this->table . " " . $filtre);
    }
}
