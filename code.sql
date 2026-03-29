CREATE DATABASE IF NOT EXISTS projet4 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE projet4;

DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS livre;
DROP TABLE IF EXISTS utilisateur;

-- ======================
-- TABLE UTILISATEUR
-- ======================
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    profileImage VARCHAR(255) DEFAULT NULL,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modification DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ======================
-- TABLE LIVRE
-- ======================
CREATE TABLE livre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    description TEXT DEFAULT NULL,
    image VARCHAR(255) DEFAULT NULL,
    disponible TINYINT(1) NOT NULL DEFAULT 1,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modification DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_livre_utilisateur
        FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id)
        ON DELETE CASCADE
);

-- ======================
-- TABLE MESSAGE
-- ======================
CREATE TABLE message (
    id INT AUTO_INCREMENT PRIMARY KEY,
    expediteur_id INT NOT NULL,
    destinataire_id INT NOT NULL,
    contenu TEXT NOT NULL,
    date_creation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_message_expediteur
        FOREIGN KEY (expediteur_id) REFERENCES utilisateur(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_message_destinataire
        FOREIGN KEY (destinataire_id) REFERENCES utilisateur(id)
        ON DELETE CASCADE
);

-- ======================
-- INSERT UTILISATEURS
-- ======================
INSERT INTO utilisateur (
    id, pseudo, email, mot_de_passe, profileImage
) VALUES
(1, 'sacha', 'sacha@mail.com', 'test', NULL),
(2, 'alice', 'alice@mail.com', '1234', NULL),
(3, 'bob', 'bob@mail.com', '5678', NULL);

-- ======================
-- INSERT LIVRES
-- ======================
INSERT INTO livre (
    utilisateur_id, titre, auteur, description, image, disponible
) VALUES
(1, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'Un classique incontournable.', NULL, 1),
(1, '1984', 'George Orwell', 'Roman dystopique.', NULL, 1),
(1, 'L Alchimiste', 'Paulo Coelho', 'Roman initiatique.', NULL, 0),
(1, 'Harry Potter', 'J.K. Rowling', 'Fantasy jeunesse.', NULL, 1),
(2, 'Orgueil et Préjugés', 'Jane Austen', NULL, NULL, 1),
(3, 'Le Hobbit', 'J.R.R. Tolkien', NULL, NULL, 1);

-- ======================
-- INSERT MESSAGES
-- ======================
INSERT INTO message (
    expediteur_id, destinataire_id, contenu, date_creation
) VALUES
(1, 2, 'Salut Alice, ton livre est dispo ?', '2026-03-25 10:00:00'),
(2, 1, 'Oui toujours dispo !', '2026-03-25 10:05:00'),
(1, 2, 'Parfait merci !', '2026-03-25 10:10:00'),
(3, 1, 'Salut Sacha, intéressé par 1984', '2026-03-26 14:00:00'),
(1, 3, 'Ok je te le réserve', '2026-03-26 14:15:00'),
(2, 1, 'Tu peux passer quand tu veux', '2026-03-27 09:30:00'),
(1, 2, 'Top merci !', '2026-03-27 09:45:00');