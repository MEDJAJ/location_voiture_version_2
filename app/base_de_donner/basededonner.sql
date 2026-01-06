CREATE DATABASE Location_voiture;
USE Location_voiture;


CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    role VARCHAR(50) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    dateCreation DATETIME NOT NULL DEFAULT NOW()
);


CREATE TABLE categories (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    date_creation DATETIME NOT NULL DEFAULT NOW(),
    status BOOLEAN DEFAULT TRUE
);


CREATE TABLE vehicules (
    id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
    modele VARCHAR(100) NOT NULL,
    marque TEXT NOT NULL,
    disponibilite BOOLEAN DEFAULT TRUE,
    id_categorie INT,
    FOREIGN KEY (id_categorie)
        REFERENCES categories(id_categorie)
        ON DELETE CASCADE
);


CREATE TABLE reservations (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    dateDebut DATETIME NOT NULL,
    dateFin DATETIME NOT NULL,
    lieuPrise VARCHAR(150),
    dateCreation DATETIME NOT NULL DEFAULT NOW(),
    status VARCHAR(50),
    id_user INT,
    id_vehicule INT,
    FOREIGN KEY (id_user)
        REFERENCES users(id_user)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_vehicule)
        REFERENCES vehicules(id_vehicule)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TABLE avis (
    id_avis INT AUTO_INCREMENT PRIMARY KEY,
    note VARCHAR(10),
    content TEXT,
    dateCreation DATETIME NOT NULL DEFAULT NOW(),
    status BOOLEAN DEFAULT TRUE,
    deleted_at BOOLEAN DEFAULT FALSE,
    id_user INT,
    id_vehicule INT,
    FOREIGN KEY (id_user)
        REFERENCES users(id_user)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_vehicule)
        REFERENCES vehicules(id_vehicule)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);



INSERT INTO users (nom, prenom, role, email, password) VALUES
('Ben Ali', 'Ahmed', 'client', 'ahmed@gmail.com', 'hashed_pwd_123'),
('Trabelsi', 'Sara', 'client', 'sara@gmail.com', 'hashed_pwd_456'),
('Admin', 'Root', 'admin', 'admin@gmail.com', 'admin_pwd');



INSERT INTO categories (nom, description, status) VALUES
('Économique', 'Voitures économiques et peu coûteuses', TRUE),
('SUV', 'Véhicules spacieux et puissants', TRUE),
('Luxe', 'Voitures haut de gamme', TRUE);


INSERT INTO vehicules (modele, marque, disponibilite, id_categorie) VALUES
('Clio 4', 'Renault', TRUE, 1),
('Tucson', 'Hyundai', TRUE, 2),
('Classe C', 'Mercedes', FALSE, 3);


INSERT INTO reservations (dateDebut, dateFin, lieuPrise, status, id_user, id_vehicule) VALUES
('2026-01-05 09:00:00', '2026-01-10 18:00:00', 'Aéroport Tunis', 'confirmée', 1, 4),
('2026-01-15 10:00:00', '2026-01-18 12:00:00', 'Centre-ville', 'en attente', 2, 5),
('2026-01-20 08:00:00', '2026-01-25 20:00:00', 'Agence Lac', 'annulée', 1, 4);


INSERT INTO avis (note, content, status, id_user, id_vehicule) VALUES
('5', 'Très bonne voiture, confortable', TRUE, 1, 1),
('4', 'Bon service mais voiture un peu sale', TRUE, 2, 2),
('3', 'Prix élevé mais bonne qualité', TRUE, 1, 3);
