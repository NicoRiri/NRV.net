const queryString = window.location.search;
const params = new URLSearchParams(queryString);
const idsoiree = params.get("idsoiree");

// On récupère le token stocké dans le local storage
let token = localStorage.getItem('token');

let typos=false;

// URL de l'API
const apiUrl2 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree/'+idsoiree;
const apiUrl = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/profile';

// Configuration de l'en-tête de la requête avec les tokens
const headers = new Headers();
headers.append('Authorization', `Bearer ${token}`);

if (token === null) {
    window.location.href = "../connexion.index.html";
}
const fetchOptions = {
    method: 'GET',
    headers: headers,
};

fetch(apiUrl2).then(response => {
    if (response.status === 200) {
        return response.json();
    } else {
        throw new Error('Échec de la requête Fetch pour la soirée');
    }
}).then(soireeData => {
    console.log(soireeData);
    let txt = document.getElementById("billet");
    let html = `<div class="contenu" id="content">
                    <div class="text" id="text">
                        <h2>${soireeData.soiree.details.nom}</h2>
                        <p>${soireeData.soiree.details.date}</p>`;
    fetch(apiUrl,fetchOptions).then(response => {
        if (response.status === 200) {
            return response.json();
        } else {
            throw new Error('Échec de la requête Fetch pour la soirée');
        }
    }).then(profileData => {
        console.log(profileData);
        let arrhtml = [];
        profileData.billets.forEach(billet => {
            if(billet.estAchete == 1){
                for(let i = 0; i < billet.quantiteAssise; i++){
                    let htmltmp = `<p>Place assise</p>
                            <p>${profileData.profile.nom} ${profileData.profile.prenom}</p>
                            <p>Montant : ${soireeData.soiree.details.prixPlace}</p>
                            </div><img src="../img/billet.png" alt="billet"></div>`;
                    arrhtml.push(html + htmltmp);
                }
                for(let i = 0; i < billet.quantiteDebout; i++){
                    let htmltmp = `<p>Place debout</p>
                            <p>${profileData.profile.nom} ${profileData.profile.prenom}</p>
                            <p>Montant : ${soireeData.soiree.details.prixPlace}</p>
                            </div><img src="../img/billet.png" alt="billet"></div>`;
                    arrhtml.push(html + htmltmp);
                }
            }
        });
        arrhtml.forEach(html => {
            console.log(html);
            document.getElementById("billet").innerHTML += html;
        });
    });
});

