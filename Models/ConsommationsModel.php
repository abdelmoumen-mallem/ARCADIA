<?php

require_once 'DatabaseModel.php';

class ConsommationsModel extends DatabaseModel
{
    protected string $table = 'consommations_animaux';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($filtre)
    {
        $stmt = $this->pdo->query("SELECT r.*, a.prenom, ra.nom, u.nom as nom_collaborateur, u.prenom as prenom_collaborateur FROM $this->table r INNER JOIN animaux a ON r.animal_id = a.id INNER JOIN races ra ON a.race_id = ra.id INNER JOIN utilisateurs u ON r.utilisateur_id = u.id $filtre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($id)
    {
        return $this->showGeneral($this->table, $id);
    }

    public function update($id, $animal_id, $nouriture, $grammage, $utilisateur_id)
    {
        return $this->updateGeneral($this->table, $id, compact('animal_id', 'nouriture', 'grammage', 'utilisateur_id'));
    }

    public function insert($animal_id, $nouriture, $grammage, $utilisateur_id)
    {
        return $this->insertGeneral($this->table, compact('animal_id', 'nouriture', 'grammage', 'utilisateur_id'));
    }

    public function delete($id)
    {
        return $this->deleteGeneral($this->table, $id);
    }
}
