const queryString = window.location.search;
const params = new URLSearchParams(queryString);
const idValue = params.get("id");

fetch("http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree/")
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        let soiree = data.soiree.find(soiree => soiree.id == idValue);
        if(soiree==undefined){
            window.location.href = "../index.html";
        }
        document.getElementsByClassName("titre")[0].innerText = soiree.nom;
        document.getElementsByTagName("h2")[0].innerText = "Theme : " + soiree.thematique;
        document.getElementsByTagName("h2")[1].innerText = soiree.date;
        document.getElementsByTagName("h3")[0].innerText = "Billet à " + soiree.prixPlace + "€";
        document.getElementsByTagName("iframe")[0].src = soiree.lieu_id.lien;
        for (let i = 0; i < soiree.spectacleArrayId.length; i++) {
            fetch("http://docketu.iutnc.univ-lorraine.fr:42769/api/spectacle/" + soiree.spectacleArrayId[i])
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Erreur HTTP! Statut: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    let spectacle = data.spectacle.details;
                    let imgsrc = spectacle.tabImg[(Math.floor(Math.random() * spectacle.tabImg.length))].imgUrl;
                    let titre = spectacle.titre;
                    let horaire = spectacle.horaire;
                    let description = spectacle.description;
                    let video = spectacle.VideoUrl;
                    let artiste = "";
                    let lien = "../detailspectacle/index.html?id=" + spectacle.id;
                    for (let j = 0; j < spectacle.artisteArray.length; j++) {
                        artiste += spectacle.artisteArray[j].pseudonyme + " ";
                    }
                    document.getElementsByTagName("body")[0].innerHTML += `
                        <a href="`+ lien +`">
                        <div class="spectacle box">
                            <img src="` + imgsrc + `">
                                <div>
                                    <div>
                                        <h3>` + titre + `</h3>
                                        <h3>` + horaire + `</h3>
                                    </div>
                                    <p> ` + description + `</p>
                                    <h4>artiste(s): ` + artiste + `</h4>
                                </div>
                                <iframe width="560" height="315" src="` + video + `" allowfullscreen></iframe>
                        </div></a>`;
                    let boutonA=document.getElementById("commandea");
                    boutonA.addEventListener("click",function(){
                        ajouter("assise",idValue);
                    });
                    let boutonD=document.getElementById("commanded");
                    boutonD.addEventListener("click",function(){
                        ajouter("debout",idValue);
                    });
                });
        }
    });

function ajouter(type,id){
    let quantitedebout=0;
    let quantiteassise=0;
    if(type==="debout"){
        quantitedebout=1;
    }else if(type==="assise"){
        quantiteassise=1;
    }
    let token = localStorage.getItem('token');
    const headers = new Headers();
    headers.append('Authorization', `Bearer ${token}`);
    const requestBody = {
        soiree_id: id,
        quantite_debout: quantitedebout,
        quantite_assise: quantiteassise// Les données que vous voulez envoyer dans le corps de la requête
    };
    const fetchOptions2 = {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(requestBody) // Convertir les données en JSON et les envoyer dans le corps
    };
    let apiUrl3 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/achat';
    fetch(apiUrl3, fetchOptions2)
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
}