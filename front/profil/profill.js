
// On récupère le token stocké dans le local storage
let token = localStorage.getItem('token');

let typos=false;

// URL de l'API
const apiUrl2 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree';
const apiUrl = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/profile';

// Configuration de l'en-tête de la requête avec les tokens
const headers = new Headers();
headers.append('Authorization', `Bearer ${token}`);

if (token === null) {
    window.location.href = "../connexion/index.html";
}
const fetchOptions = {
    method: 'GET',
    headers: headers,
};

document.addEventListener("DOMContentLoaded", function () {
    fetch(apiUrl, fetchOptions)
        .then(response => {
            if (response.status === 200) {
                return response.json(); // Convertir la réponse en JSON
            } else {
                throw new Error('Échec de la requête Fetch');
            }
        })
        .then(data => {
            const profile = data.profile;
            const nom = profile.nom;
            const prenom = profile.prenom;
            const email = profile.email;
            const billets = data.billets;
            const tableBillets = document.getElementById("table-billets");

            function getSoireeDetails(soireeId) {
                fetch(`${apiUrl2}/${soireeId}`)
                    .then(response => {
                        if (response.status === 200) {
                            return response.json();
                        } else {
                            throw new Error('Échec de la requête Fetch pour la soirée');
                        }
                    })
                    .then(soireeData => {
                        //for each de chaque element dans soreeData
                        const row = tableBillets.insertRow();
                        if(typos){
                            row.classList.add("pair");
                            typos=false;
                        }else{
                            row.classList.add("impair");
                            typos=true;
                        }
                        row.insertCell(0).textContent = soireeData.soiree.details.nom; // Nom de la soirée
                        row.insertCell(1).textContent = soireeData.soiree.details.thematique; // Thématique de la soirée
                        row.insertCell(2).textContent = soireeData.soiree.details.date; // Date de la soirée
                        row.insertCell(3).textContent = soireeData.soiree.details.heureDebut; // Horaire de la soirée
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des détails de la soirée:', error);
                    });
            }

            billets.forEach(billet => {
                if(billet.estAchete===1){
                    for (let i = 0; i < billet.quantiteAssise; i++) {
                        getSoireeDetails(billet.soiree_id);
                    }
                    for (let i = 0; i < billet.quantiteDebout; i++) {
                        getSoireeDetails(billet.soiree_id);
                    }
                }
            });

            const nomElement = document.getElementById("nom");
            const prenomElement = document.getElementById("prenom");
            const emailElement = document.getElementById("email");

            nomElement.textContent = nom;
            prenomElement.textContent = prenom;
            emailElement.textContent = email;
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
});
