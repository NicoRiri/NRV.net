CREATE TABLE Utilisateur (
                             id INT PRIMARY KEY,
                             email VARCHAR(255),
                             mdp VARCHAR(255),
                             prenom VARCHAR(255),
                             nom VARCHAR(255)
);

CREATE TABLE Lieu (
                      id INT PRIMARY KEY,
                      nom VARCHAR(255),
                      adresse VARCHAR(255),
                      nbPlaceAssise INT,
                      nbPlaceDebout INT
);

CREATE TABLE Soiree (
                        id INT PRIMARY KEY,
                        nom VARCHAR(255),
                        date DATE,
                        thematique VARCHAR(255),
                        lieuId INT,
                        heureDebut TIME,
                        heureFin TIME,
                        FOREIGN KEY (lieuId) REFERENCES Lieu(id)
);

CREATE TABLE Artiste (
                         id INT PRIMARY KEY,
                         pseudonyme VARCHAR(255)
);

CREATE TABLE Spectacle (
                           id INT PRIMARY KEY,
                           titre VARCHAR(255),
                           description TEXT,
                           soireeId INT,
                           videoUrl VARCHAR(255),
                           horaire TIME,
                           FOREIGN KEY (soireeId) REFERENCES Soiree(id)
);

CREATE TABLE ImageSpectacle (
                                id INT PRIMARY KEY,
                                imgUrl VARCHAR(255),
                                spectacleId INT,
                                FOREIGN KEY (spectacleId) REFERENCES Spectacle(id)
);

CREATE TABLE Billet (
                        utilisateurId INT,
                        spectacleId INT,
                        quantite INT,
                        PRIMARY KEY (utilisateurId, spectacleId),
                        FOREIGN KEY (utilisateurId) REFERENCES Utilisateur(id),
                        FOREIGN KEY (spectacleId) REFERENCES Spectacle(id)
);

CREATE TABLE Spectacle2Artiste (
                                   spectacleId INT,
                                   artisteId INT,
                                   PRIMARY KEY (spectacleId, artisteId),
                                   FOREIGN KEY (spectacleId) REFERENCES Spectacle(id),
                                   FOREIGN KEY (artisteId) REFERENCES Artiste(id)
);
