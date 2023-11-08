# NRV.net
## Auteurs
- Bernardet Nicolas
- Gallion Laura
- Demarque Amaury
- Hugot Benjamin
- Oudin Clément

## Fonctionnalités

### Programme du festival :
- 1. Affichage de la liste des spectacles : pour chaque spectacle, on affiche le titre, la date et
   l’horaire, une image,
- 2. Affichage du détail d’une soirée : nom de la soirée, thématique, date et horaire, lieu, tarifs,
   ainsi que la liste des spectacles : titre, artistes, description, style de musique, vidéo,
- 3. En cliquant sur un spectacle dans la liste, le détail de la soirée correspondante et affiché,
- 4. Filtrage de la liste des spectacles par date,
- 5. Filtrage de la liste des spectacles par style de musique,
- 6. Filtrage de la liste des spectacles par lieu.
   Compte et Profil d’utilisateur :
- 7. Inscription sur la plateforme et création d’un compte,
- 8. Accès aux billets achetés (« mes billets »)
   Achats de billets :
- 9. Lors de la visualisation d’une soirée, possibilité d’ajouter des billets d’entrée pour cette
   soirée dans un panier,
- 10. Visualisation de l’état courant du panier, calcul et affichage du montant total,
- 11. Validation du panier et transformation en commande, validation de la commande.
- 12. Paiement de la commande : on simule en transmettant des données correspondant à une
    carte bancaire : n , date expiration, code ; le contrôle de disponibilité des places est réalisé à
    ce moment-là, ainsi que la mise à jour du nombre de places disponibles pour la soirée.
- 13. Création des billets qui doivent comporter : nom de l’acheteur, référence, date et horaire de
    la soirée, catégorie de tarif ; les billets doivent être imprimables et peuvent être réalisés en
    html/css avec @media print.
### Backoffice :
- 14. Affichage de la jauge des spectacles : nombre de places vendues pour chaque soirée
### Fonctionnalités étendues
- 1. Pagination de la liste de spectacles,
- 2. Modification du panier : nombre de billets,
- 3. Backoffice : ajouter des spectacles et des soirées,
- 4. Backoffice : gérer les lieux et le nombre de places sur chaque lieu,
- 5. Backoffice : vente de billets à l’entrée des soirées. L‘application est utilisée par
   l’organisateur du festival pour la vente de billets sur le lieu de chaque soirée.
- 6. Panier persistant : possibilité d’ajouter des réservations qui sont conservées au-delà de la
   session jusqu’au paiement,
- 7. Vérification des places disponibles dans un panier avant paiement,


## Modèle relationel

- users(<ins>id</ins>, email, password, refresh_token, refresh_token_expiration_date, nom, prenom)

- Lieu(<ins>id</ins>, nom, adresse, nbPlaceAssise, nbPlaceDebout, lien)

- Soiree(<ins>id</ins>, nom, date, thematique, lieu_id, heureDebut, heureFin, prixPlace)

- Artiste(<ins>id</ins>, pseudonyme)

- Spectacle(<ins>id</ins>, titre, description, soiree_id, videoUrl, horaire)

- ImageSpectacle(<ins>id</ins>, imgUrl, spectacle_id)

- Billet(<ins>utilisateur_id</ins>, <ins>soiree_id</ins>, quantiteDebout, quantiteAssise, estAchete)

- Spectacle2Artiste(<ins>spectacle_id</ins>, <ins>artiste_id</ins>)



## Routes API
### Authentification
- 🟡 POST : /api/connexion/
- 🟡 POST : /api/inscription/
### NRV
- 🟢 GET : /api/spectacle/
- 🟢 GET : /api/spectacle/{id}/
- 🟢 GET : /api/soiree/
- 🟢 GET : /api/soiree/{id}/
- 🟢 GET : /api/profile/
- 🟡 POST : /api/achat/
- 🔵 PUT : /api/achat/
- 🟠 DELETE : /api/achat/