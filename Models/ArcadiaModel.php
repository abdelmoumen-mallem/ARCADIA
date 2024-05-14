<?php

require_once 'DatabaseModel.php';

class ArcadiaModel extends DatabaseModel
{
    public function createTable()
    {
        $filePath = __DIR__ . '/database.sql';
        $query = file_get_contents($filePath);

        if ($query === false) {
            throw new Exception("Erreur lors du chargement du fichier SQL");
        }

        try {
            $this->pdo->exec($query);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'exécution de la requête SQL: " . $e->getMessage());
        }
    }
}
