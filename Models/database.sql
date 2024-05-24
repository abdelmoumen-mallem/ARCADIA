CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    statut TINYINT NOT NULL DEFAULT 1,
    role_id INT NOT NULL,
    date_creation DATE NOT NULL DEFAULT CURDATE(),
    CONSTRAINT fk_role_id FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    image_url VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    image_url VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS habitats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    image_url VARCHAR(255) NOT NULL,
    commentaire TEXT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS animaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL UNIQUE,
    statut TINYINT NOT NULL DEFAULT 1,
    race_id INT NOT NULL,
    habitat_id INT NOT NULL,
    CONSTRAINT fk_race_id FOREIGN KEY (race_id) REFERENCES races (id) ON DELETE RESTRICT,
    CONSTRAINT fk_habitat_id FOREIGN KEY (habitat_id) REFERENCES habitats (id) ON DELETE RESTRICT,
    date_creation DATE NOT NULL DEFAULT CURDATE()
);

CREATE TABLE IF NOT EXISTS rapports_veterinaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    etat VARCHAR(50) NOT NULL,
    nouriture VARCHAR(50) NOT NULL,
    grammage FLOAT NOT NULL,
    animal_id INT NOT NULL,
    utilisateur_id INT NOT NULL,
    date_creation DATE NOT NULL DEFAULT CURDATE(),
    CONSTRAINT fk_animal_id FOREIGN KEY (animal_id) REFERENCES animaux (id) ON DELETE RESTRICT,
    CONSTRAINT fk_utilisateur_id FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS statistiques_animaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL,
    statistique INT NOT NULL,
    date_creation DATE NOT NULL DEFAULT CURDATE(),
    CONSTRAINT fk_stat_animal_id FOREIGN KEY (animal_id) REFERENCES animaux (id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS consommations_animaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nouriture VARCHAR(50) NOT NULL,
    grammage FLOAT NOT NULL,
    animal_id INT NOT NULL,
    utilisateur_id INT NOT NULL,
    date_creation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_cons_animal_id FOREIGN KEY (animal_id) REFERENCES animaux (id) ON DELETE RESTRICT,
    CONSTRAINT fk_cons_utilisateur_id FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs (id) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    visible TINYINT NOT NULL DEFAULT 0,
    note TINYINT NOT NULL,
    date_creation DATE NOT NULL DEFAULT CURDATE()
);

CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    titre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    statut TINYINT NOT NULL DEFAULT 0,
    date_creation DATE NOT NULL DEFAULT CURDATE()
);

INSERT INTO
    roles (nom)
VALUES ('Administrateur'),
    ('Employé'),
    ('Vétérinaire');

INSERT INTO
    utilisateurs (
        username,
        password,
        nom,
        prenom,
        role_id
    )
VALUES (
        'abdelmoumen.mallem@gmail.com',
        '$2y$10$kQp5ghjp9.f9CpGT/J9QSeY1Y0svAnyM3WC9KnBjit5eQTbyXbEj6',
        'Garcia',
        'José',
        1
    );