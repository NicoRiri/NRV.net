INSERT INTO Lieu (id, nom, adresse, nbPlaceAssise, nbPlaceDebout, lien)
VALUES
    (1, 'Lieu 1', 'Adresse 1', 100, 50, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10658.508162089971!2d5.126226402489653!3d48.09813860134465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ece5a067f6849f%3A0xc45cb934790e6a2a!2sPALESTRA!5e0!3m2!1sfr!2sfr!4v1698398137519!5m2!1sfr!2sfr'),
    (2, 'Lieu 2', 'Adresse 2', 200, 100, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10658.508162089971!2d5.126226402489653!3d48.09813860134465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ece5a067f6849f%3A0xc45cb934790e6a2a!2sPALESTRA!5e0!3m2!1sfr!2sfr!4v1698398137519!5m2!1sfr!2sfr'),
    (3, 'Lieu 3', 'Adresse 3', 150, 75, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10658.508162089971!2d5.126226402489653!3d48.09813860134465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ece5a067f6849f%3A0xc45cb934790e6a2a!2sPALESTRA!5e0!3m2!1sfr!2sfr!4v1698398137519!5m2!1sfr!2sfr');

INSERT INTO Soiree (id, nom, date, thematique, lieu_id, heureDebut, heureFin, prixPlace)
VALUES
    (1, 'Soirée 1', '2023-10-20', 'Thématique 1', 1, '19:00:00', '23:00:00', 13.2),
    (2, 'Soirée 2', '2023-10-25', 'Thématique 2', 2, '20:00:00', '00:00:00', 11.2),
    (3, 'Soirée 3', '2023-11-01', 'Thématique 3', 3, '18:00:00', '22:00:00', 1109.01);

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

INSERT INTO Billet (utilisateur_id, soiree_id, quantiteDebout, quantiteAssise, estAchete)
VALUES
    (1, 1, 2, 7, 0),
    (2, 3, 1, 8, 0),
    (3, 2, 3, 9, 1);

INSERT INTO Spectacle2Artiste (spectacle_id, artiste_id)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);
