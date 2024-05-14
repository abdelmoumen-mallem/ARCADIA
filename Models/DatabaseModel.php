<?php

class DatabaseModel
{
    protected $pdo;

    public function __construct()
    {
        require_once '../Config/database.php';
        $this->pdo = $pdo;
    }
}
