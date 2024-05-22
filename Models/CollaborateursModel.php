<?php

require_once 'DatabaseModel.php';

class CollaborateursModel extends DatabaseModel
{
    protected string $table = 'utilisateurs';

    public function __construct()
    {
        parent::__construct();
    }

    // index spécifique 
    public function index()
    {
        $stmt = $this->pdo->query("SELECT u.*, r.nom AS role_nom FROM $this->table u INNER JOIN roles r ON u.role_id = r.id ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($id)
    {
        return $this->showGeneral($this->table, $id);
    }

    public function update($id, $username, $nom, $prenom, $statut, $role_id)
    {
        return $this->updateGeneral($this->table, $id, compact('username', 'nom', 'prenom', 'statut', 'role_id'));
    }

    public function insert($username, $nom, $prenom, $statut, $role_id)
    {
        return $this->insertGeneral($this->table, compact('username', 'nom', 'prenom', 'statut', 'role_id'));
    }

    // Verification unicité username
    public function usernameTest($id, $username)
    {
        $sql = "SELECT COUNT(*) FROM $this->table WHERE username = :username";
        $params = ['username' => $username];

        if ($id !== null) {
            $sql .= " AND id <> :id";
            $params['id'] = $id;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    // Récuperation de l'id du collaborateur
    public function usernameId($username)
    {
        $stmt = $this->pdo->prepare("SELECT id FROM $this->table WHERE username = :username");
        $stmt->execute([
            'username' => $username,
        ]);

        return $stmt->fetchColumn();
    }

    public function delete($id)
    {
        return $this->deleteGeneral($this->table, $id);
    }

    // Creation du mot de passe
    public function updatePassword($id, $password)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE $this->table SET password = :password WHERE id = :id");
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
