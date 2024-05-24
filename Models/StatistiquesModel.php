<?php

require_once 'DatabaseModel.php';

class StatistiquesModel extends DatabaseModel
{
    protected string $table = 'statistiques_animaux';

    public function __construct()
    {
        parent::__construct();
    }

    // Liste des avis
    public function index()
    {
        return $this->indexGeneral($this->table);
    }

    public function indexB()
    {
        $stmt = $this->pdo->query("SELECT a.prenom, COALESCE(s.statistique, 0) AS stats, DATE_FORMAT(s.date_creation, '%d/%m/%Y') AS dateStats FROM animaux a LEFT join $this->table s ON a.id = s.animal_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertion des nouveaux avis
    public function insert($animal_id, $statistique)
    {
        return $this->insertGeneral($this->table, compact('animal_id', 'statistique'));
    }

    public function update($id, $statistique, $date)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE $this->table SET statistique = :statistique, date_creation = :date WHERE animal_id = :id");
            $stmt->execute([
                'statistique' => $statistique,
                'id' => $id,
                'date' => $date
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function verifyStats($id, $action)
    {
        if ($action === 0) {
            $colonne = 'COUNT(*)';
        } else if ($action === 1) {
            $colonne = 'statistique';
        }
        $stmt = $this->pdo->prepare("SELECT $colonne FROM $this->table WHERE animal_id = :id");
        $stmt->execute([
            'id' => $id,
        ]);

        return $stmt->fetchColumn();
    }
}
