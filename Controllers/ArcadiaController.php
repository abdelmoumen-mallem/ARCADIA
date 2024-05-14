<?php
require_once '../Models/ArcadiaModel.php';

class ArcadiaController
{
    private $arcadiaModel;

    public function __construct()
    {
        $this->arcadiaModel = new ArcadiaModel;
    }

    public function createInDatabase()
    {
        $create = $this->arcadiaModel->createTable();

        return $create;
    }
}
