CREATE TABLE Lieu (
                      `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                      nom VARCHAR(255),
                      adresse VARCHAR(255),
                      nbPlaceAssise INT,
                      nbPlaceDebout INT
);

CREATE TABLE Soiree (
                        `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                        nom VARCHAR(255),
                        date DATE,
                        thematique VARCHAR(255),
                        lieu_id INT,
                        heureDebut TIME,
                        heureFin TIME,
                        prixPlace INT,
                        FOREIGN KEY (lieu_id) REFERENCES Lieu(id)
);

CREATE TABLE Artiste (
                         `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                         pseudonyme VARCHAR(255)
);

CREATE TABLE Spectacle (
                           `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                           titre VARCHAR(255),
                           description TEXT,
                           soiree_id INT,
                           videoUrl VARCHAR(255),
                           horaire TIME,
                           FOREIGN KEY (soiree_id) REFERENCES Soiree(id)
);

CREATE TABLE ImageSpectacle (
                                `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                                imgUrl VARCHAR(255),
                                spectacle_id INT,
                                FOREIGN KEY (spectacle_id) REFERENCES Spectacle(id)
);

CREATE TABLE Billet (
                        utilisateur_id INT,
                        soiree_id INT,
                        quantiteDebout INT,
                        quantiteAssise INT,
                        PRIMARY KEY (utilisateur_id, soiree_id),
                        FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id),
                        FOREIGN KEY (soiree_id) REFERENCES Soiree(id)
);

CREATE TABLE Spectacle2Artiste (
                                   spectacle_id INT,
                                   artiste_id INT,
                                   PRIMARY KEY (spectacle_id, artiste_id),
                                   FOREIGN KEY (spectacle_id) REFERENCES Spectacle(id),
                                   FOREIGN KEY (artiste_id) REFERENCES Artiste(id)
);

-- drop table Artiste;
-- drop table Billet;
-- drop table ImageSpectacle;
-- drop table Lieu;
-- drop table Soiree;
-- drop table Spectacle;
-- drop table Spectacle2Artiste;
-- drop table Utilisateur;
