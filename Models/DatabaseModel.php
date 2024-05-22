<?php

require_once '../Config/database.php';

// Modele de base lié au crud et connexion a la database
class DatabaseModel
{
    protected $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Index par tables
    protected function indexGeneral($table)
    {
        $stmt = $this->pdo->query("SELECT * FROM $table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch 1 resultat par tables
    protected function showGeneral($table, $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function insertGeneral($table, $data)
    {
        try {
            $colonne = '';
            $valeur = '';
            foreach ($data as $key => $value) {
                $colonne .= "$key, ";
                $valeur .= ":$key, ";
            }
            $colonne = rtrim($colonne, ', ');
            $valeur = rtrim($valeur, ', ');

            $query = "INSERT INTO $table ($colonne) VALUES ($valeur)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            // Log de la requête SQL avec les valeurs
            return false;
        }
    }

    // Update par table
    // Récupere un groupement champ/valeur
    protected function updateGeneral($table, $id, $data)
    {
        try {
            $champvaleur = '';
            foreach ($data as $key => $value) {
                $champvaleur .= "$key = :$key, ";
            }
            $champvaleur = rtrim($champvaleur, ', ');

            $stmt = $this->pdo->prepare("UPDATE $table SET $champvaleur WHERE id = :id");
            $data['id'] = $id;
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Delete par table
    protected function deleteGeneral($table, $id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
