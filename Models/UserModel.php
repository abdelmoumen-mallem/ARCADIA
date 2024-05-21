<?php

require_once 'DatabaseModel.php';

class UserModel extends DatabaseModel
{
    public function verifyLogin($username, $password)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE username = :username LIMIT 1");

            $stmt->execute(['username' => $username]);

            $user = $stmt->fetch();

            if ($user) {
                if (password_verify($password, $user['password'])) {

                    $this->idUser($user['id'], $user['username'], $user['nom'], $user['prenom'], $user['role_id'], $user['date_creation'], $user['statut']);

                    return true;
                }
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la vérification de l'utilisateur: " . $e->getMessage());
        }
    }

    public function idUser($id, $username, $nom, $prenom, $role_id, $date_creation, $statut)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['id_user_arcadia'] = [
            'id' => $id,
            'username' => $username,
            'nom' => $nom,
            'prenom' => $prenom,
            'role_id' => $role_id,
            'date_creation' => $date_creation,
            'statut' => $statut
        ];
    }
}
