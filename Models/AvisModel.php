<?php

require_once 'DatabaseModel.php';

class AvisModel extends DatabaseModel
{
    protected string $table = 'avis';

    public function __construct()
    {
        parent::__construct();
    }

    // Liste des avis
    public function index($filtre)
    {
        return $this->indexGeneral($this->table . " " . $filtre);
    }

    public function indexB($filtre)
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM $this->table $filtre");
        return $stmt->fetchColumn();
    }

    // Insertion des nouveaux avis
    public function insert($nom, $description, $note)
    {
        return $this->insertGeneral($this->table, compact('nom', 'description', 'note'));
    }

    // Update de la visibilité des avis
    public function update($id, $visible)
    {
        return $this->updateGeneral($this->table, $id, compact('visible'));
    }
}
