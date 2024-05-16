<?php

require_once 'DatabaseModel.php';

class UserModel extends DatabaseModel
{
    // Méthode pour vérifier les informations de connexion de l'utilisateur
    public function verifyLogin($username, $password)
    {
        try {
            // Préparer la requête SQL pour éviter les injections SQL
            $stmt = $this->pdo->prepare("SELECT id, password FROM utilisateurs WHERE username = :username LIMIT 1");

            // Exécuter la requête avec le paramètre bind
            $stmt->execute(['username' => $username]);

            // Récupérer les données de l'utilisateur
            $user = $stmt->fetch();

            if ($user) {
                // Vérifier le mot de passe en comparant les valeurs directement
                if ($password === $user['password']) {
                    return true;  // Connexion valide
                }
            }
            return false;  // Échec de la connexion, mauvais username ou password
        } catch (PDOException $e) {
            // Gestion des erreurs
            throw new Exception("Erreur lors de la vérification de l'utilisateur: " . $e->getMessage());
        }
    }
}
