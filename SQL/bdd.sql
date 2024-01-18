CREATE TABLE medecin (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Civilite VARCHAR(10) NOT NULL
);

CREATE TABLE usager (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Civilite VARCHAR(10) NOT NULL,
    Adresse VARCHAR(255) NOT NULL,
    DateNaissance DATE NOT NULL,
    LieuNaissance VARCHAR(255) NOT NULL,
    NumeroSecuriteSociale VARCHAR(15) NOT NULL UNIQUE,
    MedID int not null,
    FOREIGN KEY (MedID) REFERENCES medecin(ID)
);

CREATE TABLE rendezvous (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    DateHeureRDV DATETIME NOT NULL,
    DuréeRDV INT NOT NULL,
    MedID int not null,
    UsaID int not null,
    FOREIGN KEY (MedID) REFERENCES medecin(ID),
    FOREIGN KEY (UsaID) REFERENCES usager(ID)
);

CREATE TABLE connecter (
  Login VARCHAR(255) PRIMARY KEY,
  Mdp VARCHAR(255) NOT NULL);

INSERT INTO connecter (Login, Mdp) VALUES 
('admin', 'password'),
('secretaire', '0000');

INSERT INTO medecin (Nom, Prenom, Civilite) VALUES
('ANDRE', 'Michel', 'M'),
('BERNARD', 'Francois', 'M'),
('BRETON', 'Patrick', 'M'),
('CAILLE', 'Valerie', 'MME'),
('CHAMPION', 'Eric', 'M'),
('CLEMENT', 'Martine', 'MME'),
('DENOUAL', 'Jean-Marc', 'M'),
('DUPONT', 'Francois', 'M'),
('DUPUIS', 'Nathalie', 'MME'),
('FABRE', 'Alain', 'M'),
('FAURE', 'Anne', 'MME'),
('FOURNIER', 'Bernard', 'M'),
('GAUTHIER', 'Christine', 'MME'),
('GIRARD', 'Pierre', 'M'),
('GRAND', 'Sophie', 'MME'),
('GUERIN', 'Laurent', 'M'),
('GUILLAUME', 'Nathalie', 'MME');

INSERT INTO usager (Nom, Prenom, Civilite, Adresse, DateNaissance, LieuNaissance, NumeroSecuriteSociale, MedID) VALUES
('DUPONT', 'Luc', 'M', '1 Rue des Lilas, 75001 Toulouse', '1990-01-01', 'Paris', '12345678901234', 1),
('DURAND', 'Marie', 'MME', '2 Rue des Roses, 75002 Toulouse', '1985-05-12', 'Lyon', '23456789742345', 2),
('MARTIN', 'Jean', 'M', '3 Rue des Tournesols, 75003 Toulouse', '1978-09-20', 'Marseille', '14567890123456', 3),
('THOMAS', 'Sophie', 'MME', '4 Rue des Pins, 75004 Toulouse', '1982-03-03', 'Toulouse', '25678901234567', 1),
('LEFEVRE', 'Paul', 'M', '5 Rue des Tilleuls, 75005 Toulouse', '1995-07-14', 'Nantes', '16789012345678', 2),
('ROUX', 'Francois', 'M', '6 Rue des Jonquilles, 75006 Toulouse', '1992-11-05', 'Strasbourg', '17890123456789', 3),
('DUPONT', 'Jean', 'M', '7 Chemin des Coquelicots, 75007 Toulouse', '1988-02-17', 'Bordeaux', '18901234867890', 1),
('DURAND', 'Julie', 'MME', '8 Rue des Marguerites, 75008 Toulouse', '1989-06-29', 'Rennes', '29012345679901', 2),
('MARTIN', 'Luc', 'M', '9 Imoasse des Tournesols, 75009 Toulouse', '1977-10-10', 'Montpellier', '10127856789012', 3),
('THOMAS', 'Pierre', 'M', '10 Rue des Lilas, 75010 Toulouse', '1991-01-15', 'Paris', '12345677901234', 1), 
('LEFEVRE', 'Marie', 'MME', '11 Rue des Roses, 75011 Toulouse', '1986-06-04', 'Lyon', '23456784012345', 2),
('ROUX', 'Jean', 'M', '12 Rue des Tournesols, 75012 Toulouse', '1979-09-23', 'Marseille', '14567890723456', 3),
('DUPONT', 'Sophie', 'MME', '13 Rue des Pins, 75013 Toulouse', '1983-03-06', 'Toulouse', '25678701234567', 1),
('DURAND', 'Paul', 'M', '14 Rue des Tilleuls, 75014 Toulouse', '1996-08-09', 'Nantes', '14789012345678', 2),
('MARTIN', 'Julie', 'MME', '15 Rue des Jonquilles, 75015 Toulouse', '1993-11-11', 'Strasbourg', '27890123456789', 3),
('THOMAS', 'Jean', 'M', '16 Rue des Coq uelicots, 75016 Toulouse', '1987-02-19', 'Bordeaux', '18901234567890', 1),
('LEFEVRE', 'Sophie', 'MME', '17 Rue des Marguerites, 75017 Toulouse', '1990-06-30', 'Rennes', '29012345678901', 2),
('ROUX', 'Luc', 'M', '18 Rue des Tournesols, 75018 Toulouse', '1978-10-08', 'Montpellier', '10123456789012', 3),
('UNTYPE', 'Pierre', 'M', '19 Avenue des Lilas, 75019 Toulouse', '1992-01-12', 'Paris', '12345678141234', 1),
('LAMARTI', 'Marie', 'MME', '20 Rue des Roses, 75020 Toulouse', '1987-04-21', 'Lyon', '23456789012345', 2),
('DEMAIN', 'Anthonin', 'M', '21 Rue des Tournesols, 75021 Toulouse', '1980-07-03', 'Marseille', '14567890123457', 3),
('DUPONT', 'Julie', 'MME', '22 Rue des Pins, 75022 Toulouse', '1984-12-07', 'Toulouse', '25678901234568', 1),
('BILIBILI', 'Gaetan', 'M', '23 Rue des Tilleuls, 75023 Toulouse', '1997-08-10', 'Nantes', '16789012345679', 2),
('MARTIN', 'Julie', 'MME', '24 Boulevard des Jonquilles, 75024 Toulouse', '1994-11-12', 'Strasbourg', '27890123456780', 3),
('THOMAS', 'Jean', 'M', '25 Rue des Coquelicots, 75025 Toulouse', '1988-02-20', 'Bordeaux', '18901234567891', 1),
('LEFEVRE', 'Sophie', 'MME', '26 Rue des Marguerites, 75026 Toulouse', '1991-07-01', 'Rennes', '29012345678902', 2),
('ROUX', 'Luc', 'M', '27 Rue des Tournesols, 75027 Toulouse', '1979-10-09', 'Montpellier', '10123456789013', 3),
('UNTYPE', 'Pierre', 'M', '28 Avenue des Lilas, 75028 Toulouse', '1993-01-13', 'Paris', '12345678151234', 1),
('LAMARTI', 'Jeanne', 'MME', '29 Rue des Roses, 75029 Toulouse', '1988-04-22', 'Lyon', '23456789022345', 2),
('DEMAIN', 'Jean', 'M', '30 Route des Tournesols, 75030 Toulouse', '1981-07-04', 'Marseille', '14567890123458', 3),
('DUPONT', 'Sophie', 'MME', '31 Rue des Pins, 75031 Toulouse', '1985-12-08', 'Toulouse', '25678901234569', 1);

INSERT INTO rendezvous (DateHeureRDV, DuréeRDV, MedID, UsaID) VALUES
('2024-01-15 10:00:00', 30, 1, 1),
('2024-01-20 14:30:00', 45, 2, 2),
('2024-02-01 11:15:00', 60, 3, 3),
('2024-02-10 09:30:00', 30, 1, 4),
('2024-02-15 16:45:00', 45, 2, 5),
('2024-03-05 13:00:00', 60, 3, 1),
('2024-03-12 15:30:00', 30, 5, 2),
('2024-03-20 10:45:00', 45, 8, 3),
('2024-04-01 14:00:00', 60, 3, 4),
('2024-04-10 11:30:00', 30, 1, 5),
('2024-04-15 17:45:00', 45, 2, 1),
('2024-05-05 12:00:00', 60, 3, 2),
('2024-05-12 16:30:00', 30, 1, 3),
('2024-05-20 13:45:00', 45, 2, 4),
('2024-06-01 15:00:00', 60, 3, 5),
('2024-06-10 12:30:00', 30, 1, 1),
('2024-06-15 18:45:00', 45, 2, 2),
('2024-07-05 13:00:00', 60, 3, 3),
('2024-07-12 15:30:00', 30, 1, 4),
('2024-07-20 10:45:00', 45, 2, 5),
('2024-08-01 14:00:00', 60, 3, 1),
('2024-08-10 11:30:00', 30, 1, 2),
('2024-08-15 17:45:00', 45, 2, 3),
('2024-09-05 12:00:00', 60, 3, 4),
('2024-09-12 16:30:00', 30, 1, 5),
('2024-09-20 13:45:00', 45, 2, 1),
('2024-10-01 15:00:00', 60, 3, 2),
('2024-10-10 12:30:00', 30, 1, 3),
('2024-10-15 18:45:00', 45, 2, 4);