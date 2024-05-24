# Projet: Gestion de Zoo

## Description
Ce projet consiste en un système de gestion de zoo comprenant un site vitrine et un back-office pour la gestion administrative. Le back-office permet une gestion différenciée selon les rôles et les utilisateurs.

## Outils et Technologies
- **Front-end**: HTML, CSS, JavaScript
- **Back-end**: PHP 8.2, SQL
- **Base de données**: MariaDB ou MySQL
- **Serveur Web**: Apache

## Fonctionnalités
- **Site vitrine**: Présentation du zoo, informations sur les animaux, habitats, services, contact.
- **Back-office**:
  - Gestion des animaux
  - Gestion du personnel
  - Authentification et gestion des utilisateurs avec différents rôles

## Lancement du Projet en Local
Pour lancer le projet sur votre machine locale, suivez ces étapes :

1. **Lancement d'Apache et MySQL/MariaDB**:
   Assurez-vous que Apache et MySQL/MariaDB sont en cours d'exécution.

2. **Création de la base de données**:
   - Créez une nouvelle base de données nommée `arcadia`.
   - Exécutez le fichier SQL pour la création des tables et colonnes : `./Models/database.sql`.

3. **Connexion Admin**:
   - Connectez-vous en tant qu'admin avec les identifiants fournis dans le fichier `./Models/database.sql` (ligne 115 et 116).

4. **Création de comptes pour d'autres rôles**:
   - Suivez le processus de création de compte pour différents rôles.

5. **Réception de l'email**:
   - Réception d'un email pour créer un mot de passe après l'inscription.

6. **Connexion et interaction**:
   - Connexion avec d'autres profils.
   - Interaction avec les diverses fonctionnalités du back-office.

## Configuration
Les configurations spécifiques nécessaires pour le fonctionnement optimal du système.


