<?php

require_once '../Config/database.php';


class DatabaseModel
{
    protected $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }
}
