// Définir l'URL de l'API
const apiUrl = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/profile';
let apiUrl2 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree';
let token = localStorage.getItem('token');
let prixTotalP=0;
let NombreBillet=0;
const headers = new Headers();
headers.append('Authorization', `Bearer ${token}`);
const fetchOptions = {
    method: 'GET',
    headers: headers,
};

fetch(apiUrl, fetchOptions)
    .then(response => {
        if (response.status === 200) {
            return response.json();
        } else {
            throw new Error('La requête a échoué');
        }
    })
    .then(data => {
        // Traiter les données reçues ici
        console.log('Données reçues :', data);
        for (let i = 0; i < data.billets.length; i++) {
            if (data.billets[i].estAchete === 0) {

                const quantiteDebout = data.billets[i].quantiteDebout;
                const quantiteAssise = data.billets[i].quantiteAssise;
                NombreBillet=NombreBillet+quantiteAssise+quantiteDebout;
                // Afficher les soirées achetées
                const soireeId = data.billets[i].soiree_id;
                apiUrl2 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree'
                apiUrl2 = `${apiUrl2}/${soireeId}`;

                fetch(apiUrl2)
                    .then(response => {
                        if (response.status === 200) {
                            return response.json();
                        } else {
                            throw new Error('La requête a échoué');
                        }
                    })
                    .then(soireeData => {
                        console.log('Données reçues :', soireeData);

                        const nomSoiree = soireeData.soiree.details.nom;
                        const prix = soireeData.soiree.details.prixPlace;
                        const prixTotal = (prix * quantiteDebout) + (prix * quantiteAssise);

                       prixTotalP = prixTotal+prixTotalP;
                       console.log(prixTotalP);
                        const totaldeplace = quantiteDebout + quantiteAssise;
                        let specto='http://docketu.iutnc.univ-lorraine.fr:42769'+soireeData.soiree.link.spectacle[0].href;
                        let image;
                        fetch(specto)
                            .then(response => {
                                if (response.status === 200) {
                                    return response.json();
                                } else {
                                    throw new Error('La requête a échoué');
                                }
                            })
                            .then(dataImg => {
                                image=dataImg.spectacle.details.tabImg[0].imgUrl;

                                const item = document.createElement('div');
                                item.className = 'item box';

                                const itemImage = document.createElement('img');
                                itemImage.className = 'item-image';
                                itemImage.src = image;

                                const itemInfo = document.createElement('div');
                                itemInfo.className = 'item-info';

                                const h2 = document.createElement('h2');
                                h2.textContent = nomSoiree; // Mettez à jour le nom de la soirée

                                const prixP = document.createElement('p');
                                prixP.textContent = `Prix : ${prix}€`; // Mettez à jour le prix

                                const quantiteDeboutP = document.createElement('p');
                                quantiteDeboutP.textContent = `Place Debout : ${quantiteDebout}`; // Mettez à jour la quantité debout

                                const quantiteAssiseP = document.createElement('p');
                                quantiteAssiseP.textContent = `Place Assise : ${quantiteAssise}`; // Mettez à jour la quantité assise

                                // Ajoutez ces éléments à la structure HTML
                                itemInfo.appendChild(h2);
                                itemInfo.appendChild(prixP);
                                itemInfo.appendChild(quantiteDeboutP);
                                itemInfo.appendChild(quantiteAssiseP);

                                item.appendChild(itemImage);
                                item.appendChild(itemInfo);

                                // Ajoutez le nouvel élément à la page HTML
                                document.querySelector('.container').appendChild(item);

                                const nombreBilletsP = document.querySelector('.order-summary p:nth-child(2)');
                                nombreBilletsP.textContent = `Nombre d'Articles : ${NombreBillet}`;

                                // Mise à jour du coût total
                                const totalAPayerP = document.querySelector('.order-summary p:nth-child(3)');
                                totalAPayerP.textContent = `Total à payer : ${prixTotalP}€`;

                                const commanderButton = document.querySelector('#b');
                                commanderButton.addEventListener('click', function() {
                                    // Enregistrez le coutTotal dans localStorage
                                    localStorage.setItem('coutTotal', prixTotalP);

                                    // Redirigez l'utilisateur vers la page de paiement
                                    console.log('Redirection vers la page de paiement');
                                    console.log(window.location.href='../paiement/index.html');
                                    window.location.href = '../paiement/index.html'; // Remplacez par le chemin de votre page de paiement
                                });


                            })

                            .catch(error => {
                                console.error('Une erreur s\'est produite lors de la récupération des détails de la soirée :', error);
                            })
                            .catch(error => {
                                console.error('Une erreur s\'est produite :', error);
                            });
                    })

                    .catch(error => {
                        console.error('Une erreur s\'est produite lors de la récupération des détails de la soirée :', error);
                    })
                    .catch(error => {
                        console.error('Une erreur s\'est produite :', error);
                    });

            }}
    })


    .catch(error => {
        console.error('Une erreur s\'est produite :', error);
    });