-- Exemple de données pour la table Utilisateur
INSERT INTO Utilisateur (id, email, mdp, prenom, nom) VALUES
                                                          (1, 'utilisateur1@example.com', 'motdepasse1', 'Jean', 'Dupont'),
                                                          (2, 'utilisateur2@example.com', 'motdepasse2', 'Marie', 'Martin'),
                                                          (3, 'utilisateur3@example.com', 'motdepasse3', 'Pierre', 'Leroy');

-- Exemple de données pour la table Lieu
INSERT INTO Lieu (id, nom, adresse, nbPlaceAssise, nbPlaceDebout) VALUES
                                                                      (1, 'Lieu A', 'Adresse A', 100, 200),
                                                                      (2, 'Lieu B', 'Adresse B', 150, 250),
                                                                      (3, 'Lieu C', 'Adresse C', 120, 220);

-- Exemple de données pour la table Soiree
INSERT INTO Soiree (id, nom, date, thematique, lieuId, heureDebut, heureFin) VALUES
                                                                                 (1, 'Soirée 1', '2023-10-20', 'Thématique A', 1, '19:00:00', '23:00:00'),
                                                                                 (2, 'Soirée 2', '2023-10-21', 'Thématique B', 2, '20:00:00', '23:30:00'),
                                                                                 (3, 'Soirée 3', '2023-10-22', 'Thématique C', 3, '18:30:00', '22:30:00');

-- Exemple de données pour la table Artiste
INSERT INTO Artiste (id, pseudonyme) VALUES
                                         (1, 'Artiste A'),
                                         (2, 'Artiste B'),
                                         (3, 'Artiste C');

-- Exemple de données pour la table Spectacle
INSERT INTO Spectacle (id, titre, description, soireeId, videoUrl, horaire) VALUES
                                                                                (1, 'Spectacle 1', 'Description Spectacle 1', 1, 'https://exemple.com/video1', '20:00:00'),
                                                                                (2, 'Spectacle 2', 'Description Spectacle 2', 2, 'https://exemple.com/video2', '21:00:00'),
                                                                                (3, 'Spectacle 3', 'Description Spectacle 3', 3, 'https://exemple.com/video3', '19:30:00');

-- Exemple de données pour la table ImageSpectacle
INSERT INTO ImageSpectacle (id, imgUrl, spectacleId) VALUES
                                                         (1, 'https://exemple.com/image1', 1),
                                                         (2, 'https://exemple.com/image2', 2),
                                                         (3, 'https://exemple.com/image3', 3);

-- Exemple de données pour la table Billet
INSERT INTO Billet (utilisateurId, spectacleId, quantite) VALUES
                                                              (1, 1, 2),
                                                              (2, 2, 1),
                                                              (3, 3, 3);

-- Exemple de données pour la table Spectacle2Artiste
INSERT INTO Spectacle2Artiste (spectacleId, artisteId) VALUES
                                                           (1, 1),
                                                           (2, 2),
                                                           (3, 3);
