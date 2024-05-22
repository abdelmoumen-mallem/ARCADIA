<?php

require_once 'DatabaseModel.php';

class RacesModel extends DatabaseModel
{
    protected string $table = 'races';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->indexGeneral($this->table);
    }

    public function insert($nom, $image_url)
    {
        return $this->insertGeneral($this->table, compact('nom', 'image_url'));
    }

    public function update($id, $nom, $image_url)
    {
        return $this->updateGeneral($this->table, $id, compact('nom', 'image_url'));
    }

    // Verifie unicité du nom de race
    public function nameTest($name, $id)
    {
        $sql = "SELECT COUNT(*) FROM $this->table WHERE nom = :name";
        $params = ['name' => $name];

        if ($id !== null) {
            $sql .= " AND id <> :id";
            $params['id'] = $id;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    public function show($id)
    {
        return $this->showGeneral($this->table, $id);
    }

    public function delete($id)
    {
        return $this->deleteGeneral($this->table, $id);
    }
}
