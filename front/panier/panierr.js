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
if (token === null) {
    window.location.href = "../connexion/index.html";
}
function supprimer(soiree){
    const headers = new Headers();
    headers.append('Authorization', `Bearer ${token}`);

    const requestBody = {
        soiree_id: soiree // Les données que vous voulez envoyer dans le corps de la requête
    };
    const fetchOptions = {
        method: 'DELETE',
        headers: headers,
        body: JSON.stringify(requestBody) // Convertir les données en JSON et les envoyer dans le corps
    };
    fetch(apiUrl, fetchOptions)
        .then(response => {
            if (response.status === 200) {
                return response.json(); // Convertir la réponse en JSON
            } else {
                throw new Error('Échec de la requête Fetch');
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
    //window.location.href = "../panier/index.html";
}

fetch(apiUrl, fetchOptions)
    .then(response => {
        if (response.status === 200) {
            return response.json();
        } else {
            throw new Error('La requête a échoué');
        }
    })
    .then(data => {
        console.log('Données reçues :', data);
        for (let i = 0; i < data.billets.length; i++) {
            if (data.billets[i].estAchete === 0) {

                const quantiteDebout = data.billets[i].quantiteDebout;
                const quantiteAssise = data.billets[i].quantiteAssise;
                NombreBillet=NombreBillet+quantiteAssise+quantiteDebout;
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

                                itemInfo.appendChild(h2);
                                itemInfo.appendChild(prixP);
                                itemInfo.appendChild(quantiteDeboutP);
                                itemInfo.appendChild(quantiteAssiseP);

                                console.log(item);

                                item.appendChild(itemImage);
                                item.appendChild(itemInfo);

                                const bouton= document.createElement('button');
                                bouton.className='myLog';
                                bouton.textContent='Supprimer';
                                bouton.style.marginLeft='auto';
                                bouton.style.marginTop='auto';
                                bouton.onclick=function() {
                                    console.log(data.billets[i].soiree_id+" "+data.billets[i].utilisateur_id);
                                    supprimer(data.billets[i].soiree_id);
                                }
                                item.appendChild(bouton);

                                document.querySelector('.container').appendChild(item);

                                const nombreBilletsP = document.querySelector('.order-summary p:nth-child(2)');
                                nombreBilletsP.textContent = `Nombre d'Articles : ${NombreBillet}`;

                                const totalAPayerP = document.querySelector('.order-summary p:nth-child(3)');
                                totalAPayerP.textContent = `Total à payer : ${prixTotalP}€`;

                                const commanderButton = document.querySelector('#b');
                                commanderButton.addEventListener('click', function() {
                                    localStorage.setItem('coutTotal', prixTotalP);

                                    console.log('Redirection vers la page de paiement');
                                    console.log(window.location.href='../paiement/index.html');
                                    window.location.href = '../paiement/index.html';
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