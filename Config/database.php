<?php
require_once 'config.php';

try {
    // Création d'une connexion PDO à la base de données
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
    // Configuration des attributs PDO pour afficher les erreurs et activer le mode d'exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur lors de la connexion, affichage du message d'erreur
    echo "Erreur de connexion : " . $e->getMessage();
}
