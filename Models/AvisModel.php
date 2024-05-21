<?php

require_once 'DatabaseModel.php';

class AvisModel extends DatabaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($filtre)
    {
        $stmt = $this->pdo->query("SELECT * FROM avis $filtre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nom, $description, $note)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO avis (nom, description, note) VALUES (:nom, :description, :note)");
            $stmt->execute([
                'description' => $description,
                'nom' => $nom,
                'note' => $note
            ]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }

    public function update($id, $visible)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE avis SET visible = :visible WHERE id = :id");
            $stmt->execute([
                'id' => $id,
                'visible' => $visible
            ]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }
}
