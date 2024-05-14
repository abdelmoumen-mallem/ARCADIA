<?php

require_once 'DatabaseModel.php';

class ImmoModel extends DatabaseModel
{
    public function countRows()
    {
        $query = "SELECT COUNT(*) FROM `vente_2019`";
        $statement = $this->pdo->query($query);
        $count = $statement->fetchColumn();
        return $count;
    }
}
