<?php

require_once 'DatabaseModel.php';

class CollaborateursModel extends DatabaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT u.*, r.nom AS role_nom FROM utilisateurs u INNER JOIN roles r ON u.role_id = r.id ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
