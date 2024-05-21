<?php

require_once 'DatabaseModel.php';

class ServicesModel extends DatabaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nom, $description, $image_url)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO services (nom, description, image_url) VALUES (:nom, :description, :image_url)");
            $stmt->execute([
                'description' => $description,
                'nom' => $nom,
                'image_url' => $image_url
            ]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }

    public function update($id, $nom, $description, $image_url)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE services SET nom = :nom, description = :description, image_url = :image_url WHERE id = :id");
            $stmt->execute([
                'description' => $description,
                'nom' => $nom,
                'image_url' => $image_url,
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }

    public function nameTest($name, $id)
    {
        if ($id !== null) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM services WHERE id <> :id AND nom = :name");
            $stmt->execute([
                'name' => $name,
                'id' => $id
            ]);
        } else {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM services WHERE nom = :name");
            $stmt->execute([
                'name' => $name
            ]);
        }

        return $stmt->fetchColumn();
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM services WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM services WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }
}
