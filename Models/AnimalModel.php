<?php

require_once 'DatabaseModel.php';

class AnimalModel extends DatabaseModel
{
    protected string $table = 'animaux';

    public function __construct()
    {
        parent::__construct();
    }

    // index spécifique 
    //public function index()
    //{
    //    return $this->indexGeneral($this->table);
    //}

    public function index()
    {
        $stmt = $this->pdo->query("SELECT a.*, h.nom as habitat_nom, r.nom as race_nom FROM animaux a INNER JOIN races r on a.race_id = r.id INNER JOIN habitats h on a.habitat_id = h.id ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function indexB($id)
    {
        $stmt = $this->pdo->prepare("SELECT r.nom as race_nom, r.image_url as race_image FROM animaux a INNER JOIN habitats h ON a.habitat_id = h.id INNER JOIN races r ON a.race_id = r.id WHERE h.id = :id GROUP BY r.id");
        $stmt->execute(array(':id' => $id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
