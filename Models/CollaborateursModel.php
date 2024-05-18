<?php

require_once 'DatabaseModel.php';

class CollaborateursModel extends DatabaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT u.*, r.nom AS role_nom FROM utilisateurs u INNER JOIN roles r ON u.role_id = r.id ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $username, $nom, $prenom, $statut, $role_id)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE utilisateurs SET username = :username, nom = :nom, prenom = :prenom, statut = :statut, role_id = :role_id WHERE id = :id");
            $stmt->execute([
                'username' => $username,
                'nom' => $nom,
                'prenom' => $prenom,
                'statut' => $statut,
                'role_id' => $role_id,
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }

    public function insert($username, $nom, $prenom, $statut, $role_id)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (username, nom, prenom, statut, role_id) VALUES (:username, :nom, :prenom, :statut, :role_id)");
            $stmt->execute([
                'username' => $username,
                'nom' => $nom,
                'prenom' => $prenom,
                'statut' => $statut,
                'role_id' => $role_id,
            ]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }

    public function usernameTest($id, $username)
    {
        if ($id !== null) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE id <> :id AND username = :username");
            $stmt->execute([
                'username' => $username,
                'id' => $id
            ]);
        } else {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE username = :username");
            $stmt->execute([
                'username' => $username,
            ]);
        }
        return $stmt->fetchColumn();
    }


    public function usernameId($username)
    {

        $stmt = $this->pdo->prepare("SELECT id FROM utilisateurs WHERE username = :username");
        $stmt->execute([
            'username' => $username,
        ]);

        return $stmt->fetchColumn();
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }

    public function updatePassword($id, $password)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE utilisateurs SET password = :password WHERE id = :id");
            $stmt->execute([
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            //return $e->getMessage();
            return false;
        }
    }
}
