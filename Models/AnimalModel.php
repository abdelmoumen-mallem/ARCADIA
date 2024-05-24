<?php

require_once 'DatabaseModel.php';

class AnimalModel extends DatabaseModel
{
    protected string $table = 'animaux';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT a.*, h.nom as habitat_nom, r.nom as race_nom FROM $this->table a INNER JOIN races r on a.race_id = r.id INNER JOIN habitats h on a.habitat_id = h.id ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function indexB($id)
    {
        $stmt = $this->pdo->prepare("SELECT r.nom as race_nom, r.image_url as race_image, a.race_id FROM $this->table a INNER JOIN habitats h ON a.habitat_id = h.id INNER JOIN races r ON a.race_id = r.id WHERE h.id = :id GROUP BY r.id");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function indexC($id)
    {
        $stmt = $this->pdo->prepare("SELECT a.id as animalId, a.prenom, rv.* FROM $this->table a LEFT JOIN (SELECT rv1.* FROM rapports_veterinaires rv1 WHERE rv1.date_creation = (SELECT MAX(rv2.date_creation) FROM rapports_veterinaires rv2 WHERE rv2.animal_id = rv1.animal_id)) AS rv ON rv.animal_id = a.id WHERE a.race_id = :id AND a.statut = 1");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function indexD($filtre)
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM $this->table a INNER JOIN rapports_veterinaires r ON a.id = r.animal_id  WHERE etat = $filtre");
        return $stmt->fetchColumn();
    }

    public function show($id)
    {
        return $this->showGeneral($this->table, $id);
    }

    public function update($id, $prenom, $race_id, $habitat_id, $statut)
    {
        return $this->updateGeneral($this->table, $id, compact('prenom', 'race_id', 'habitat_id', 'statut'));
    }

    public function insert($prenom, $statut, $habitat_id, $race_id)
    {
        return $this->insertGeneral($this->table, compact('prenom', 'statut', 'habitat_id', 'race_id'));
    }

    // Verification unicité name
    public function usernameTest($id, $name)
    {
        $sql = "SELECT COUNT(*) FROM $this->table WHERE prenom = :name";
        $params = ['name' => $name];

        if ($id !== null) {
            $sql .= " AND id <> :id";
            $params['id'] = $id;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function delete($id)
    {
        return $this->deleteGeneral($this->table, $id);
    }
}
