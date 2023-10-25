INSERT INTO Utilisateur (id, email, mdp, prenom, nom, refreshToken, estProducteur)
VALUES
    (1, 'utilisateur1@gmail.com', '$2y$10$j8yFIETGP3KF3mbaNK/GNODGSrvtUR4XzZ6upW0UNDHvPgYBp6mB.', 'John', 'Doe', 'NULL', 0),
    (2, 'utilisateur2@gmail.com', '$2y$10$XOUaVoKqWLnKgwkhZpGUTOtEZze.kGTfaMj41aKpIzWmVr9KXDBbi', 'Jane', 'Doe', 'NULL', 1),
    (3, 'utilisateur3@gmail.com', '$2y$10$QzYb7V7UU.dC3Gw7543mreJBUe2/OZsEnT/mOJ3eooMFe34zwUsKO', 'Bob', 'Smith', 'NULL', 1);

INSERT INTO Lieu (id, nom, adresse, nbPlaceAssise, nbPlaceDebout)
VALUES
    (1, 'Lieu 1', 'Adresse 1', 100, 50),
    (2, 'Lieu 2', 'Adresse 2', 200, 100),
    (3, 'Lieu 3', 'Adresse 3', 150, 75);

INSERT INTO Soiree (id, nom, date, thematique, lieu_id, heureDebut, heureFin, prixPlace, nbPlaceAssiseRestante, nbPlaceDeboutRestante)
VALUES
    (1, 'Soirée 1', '2023-10-20', 'Thématique 1', 1, '19:00:00', '23:00:00', 13.2, 100, 50),
    (2, 'Soirée 2', '2023-10-25', 'Thématique 2', 2, '20:00:00', '00:00:00', 11.2, 200, 100),
    (3, 'Soirée 3', '2023-11-01', 'Thématique 3', 3, '18:00:00', '22:00:00', 1109.01, 150, 75);

INSERT INTO Artiste (id, pseudonyme)
VALUES
    (1, 'Artiste 1'),
    (2, 'Artiste 2'),
    (3, 'Artiste 3');

INSERT INTO Spectacle (id, titre, description, soiree_id, videoUrl, horaire)
VALUES
    (1, 'Spectacle 1', 'Description Spectacle 1', 1, 'https://video-url-1.com', '20:00:00'),
    (2, 'Spectacle 2', 'Description Spectacle 2', 2, 'https://video-url-2.com', '21:00:00'),
    (3, 'Spectacle 3', 'Description Spectacle 3', 3, 'https://video-url-3.com', '19:00:00');

INSERT INTO ImageSpectacle (id, imgUrl, spectacle_id)
VALUES
    (1, 'https://image-url-1.com', 1),
    (2, 'https://image-url-2.com', 2),
    (3, 'https://image-url-3.com', 3);

INSERT INTO Billet (utilisateur_id, spectacle_id, quantiteDebout, quantiteAssis)
VALUES
    (1, 1, 2, 7),
    (2, 3, 1, 8),
    (3, 2, 3, 9);

INSERT INTO Spectacle2Artiste (spectacle_id, artiste_id)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);
