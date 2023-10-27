//première partie
const apiUrl = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/profile';
let apiUrl2 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree';
let apiUrl3 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/achat';
let token = localStorage.getItem('token');
let prixTotalP=0;

let couptotal=localStorage.getItem('coupTotal');
if (couptotal === null) {
    window.location.href = "../panier/index.html";
}
const headers = new Headers();
headers.append('Authorization', `Bearer ${token}`);
const fetchOptions = {
    method: 'GET',
    headers: headers,
};
const fetchOptions2 = {
    method: 'PUT',
    headers: headers,
};
//deuxieme partie
const tableHTML = `
  <div class="table box">
  <div id="tableau-container"></div>
    <button class="myButton" id="btnAfficherCarte">Valider le panier</button>
    </div>
`;
const carteHTML = `
  <div class="box carte">
    <form id="formulaire-paiement">
    <div>
        <h3>Numéro de carte</h3>
        <input type="tel" pattern="[0-9]{16}" name="numeroCarte" required>
    </div>
    <div>
        <h3>Date d'expiration</h3>
        <input type="number" min="1" max="12" step="1" value="1" name="mois" required>
        <input type="number" min="1900" max="2099" step="1" value="2023" name="année" required>
    </div>
    <div>
        <h3>Cryptogramme</h3>
        <input type="number" min="0" max="999" name="cryptogramme" required>
    </div>
    <button class="myButton" type="submit"id="btnAfficherBillet">Valider</button>
</form>

  </div>
`;
const billetHTML = `
  <div class="box billet">
    <h3>Billet(s)</h3>
    <ul>
        <li>La soirée (Le soir, 19h, 18/03/2024) <button class="myButton"id="btnImprimerFacture">Imprimer</button></li>
    </ul>
  </div>
`;
const group =document.querySelector("#un");
const boutoncouleur = document.querySelector("#uno");
const boutoncouleur2 = document.querySelector("#dos");
const boutoncouleur3 = document.querySelector("#tres");


boutoncouleur.style.backgroundColor = "lightblue";
group.innerHTML= tableHTML ;
const btnAfficherCarte = document.getElementById("btnAfficherCarte");

btnAfficherCarte.addEventListener("click", function () {
    group.innerHTML= carteHTML ;
    boutoncouleur.style.backgroundColor = "white";
    boutoncouleur2.style.backgroundColor = "lightblue";
    const btnAfficherBillet = document.getElementById("btnAfficherBillet");
    const formulairePaiement = document.getElementById("formulaire-paiement");
    formulairePaiement.addEventListener("submit", function (event) {
        event.preventDefault();
    btnAfficherBillet.addEventListener("click", function () {
        group.innerHTML= billetHTML ;
        boutoncouleur2.style.backgroundColor = "white";
        boutoncouleur3.style.backgroundColor = "lightblue";
        fetch(apiUrl3, fetchOptions2)
            .then(response => {
                if (response.status === 200) {
                    return response.json();
                } else {
                    throw new Error('La requête a échoué');
                }
            });
            });
    });
});
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
        const tableauHTML = document.createElement('table');
        tableauHTML.innerHTML = `
            <tr class="principal">
                <th>Nom</th>
                <th>Thème</th>
                <th>Date</th>
                <th>Place</th>
                <th>Tarif</th>
            </tr>
        `;
        let status="pair";
        for (let i = 0; i < data.billets.length; i++) {
            if (data.billets[i].estAchete === 0) {
                const quantiteDebout = data.billets[i].quantiteDebout;
                const quantiteAssise = data.billets[i].quantiteAssise;

                const soireeId = data.billets[i].soiree_id;
                apiUrl2 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree';
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
                        const theme = soireeData.soiree.details.thematique;
                        const date = soireeData.soiree.details.date;
                        const tarifIndividuel = prix;

                        for (let j = 0; j < quantiteAssise; j++) {
                            const ligneHTML = `
                                <tr class="`+status+`">
                                    <td>${nomSoiree}</td>
                                    <td>${theme}</td>
                                    <td>${date}</td>
                                    <td>Assise</td>
                                    <td>${tarifIndividuel}€</td>
                                </tr>
                            `;
                            tableauHTML.innerHTML += ligneHTML;

                            if(status==="pair"){
                                status="impair";
                            }else{
                                status="pair";
                            }
                        }

                        for (let k = 0; k < quantiteDebout; k++) {
                            const ligneHTML = `
                                <tr class="\`+status+\`">
                                    <td>${nomSoiree}</td>
                                    <td>${theme}</td>
                                    <td>${date}</td>
                                    <td>Debout</td>
                                    <td>${tarifIndividuel}€</td>
                                </tr>
                            `;
                            tableauHTML.innerHTML += ligneHTML;

                            if(status==="pair"){
                                status="impair";
                            }else{
                                status="pair";
                            }
                        }
                        prixTotalP = prixTotalP + (quantiteAssise + quantiteDebout) * prix;

                        console.log(prixTotalP);
                        const totalLigneHTML = `
            <tr class="principal">
                <td colspan="4">Total :</td>
                <td>${prixTotalP}€</td>
            </tr>
        `;
                        tableauHTML.innerHTML=tableauHTML.innerHTML+totalLigneHTML;
                        const tableauContainer = document.querySelector('#tableau-container');
                        tableauContainer.appendChild(tableauHTML);

                    })
                    .catch(error => {
                        console.log(error.message);
                    });
            }
        }
    })
    .catch(error => {
        console.log(error.message);
    });
