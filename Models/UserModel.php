<?php

require_once 'DatabaseModel.php';

class UserModel extends DatabaseModel
{
    // Méthode pour vérifier les informations de connexion de l'utilisateur
    public function verifyLogin($username, $password)
    {
        try {
            // Préparer la requête SQL pour éviter les injections SQL
            $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE username = :username LIMIT 1");

            // Exécuter la requête avec le paramètre bind
            $stmt->execute(['username' => $username]);

            // Récupérer les données de l'utilisateur
            $user = $stmt->fetch();

            if ($user) {
                if ($password === $user['password']) {
                    //session_start();
                    //$_SESSION['id_user_arcadia'] = $user['id'];
                    $this->idUser($user['id'], $user['username'], $user['nom'], $user['prenom'], $user['role_id'], $user['date_creation'], $user['statut']);

                    return true;
                }
            }
            return false;  // Échec de la connexion, mauvais username ou password
        } catch (PDOException $e) {
            // Gestion des erreurs
            throw new Exception("Erreur lors de la vérification de l'utilisateur: " . $e->getMessage());
        }
    }

    public function idUser($id, $username, $nom, $prenom, $role_id, $date_creation)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Stocker les informations de l'utilisateur dans la variable de session
        $_SESSION['id_user_arcadia'] = [
            'id' => $id,
            'username' => $username,
            'nom' => $nom,
            'prenom' => $prenom,
            'role_id' => $role_id,
            'date_creation' => $date_creation
        ];
    }
}
