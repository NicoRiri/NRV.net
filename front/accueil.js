const url = "http://docketu.iutnc.univ-lorraine.fr:42769/api/spectacle/";

fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        charger(data);
    })
    .catch(error => {
        console.error(`Erreur lors de la requête FETCH : ${error.message}`);
    });

function reset(elementParent){
    const codeHTML =  `<h1 class=titre>Meilleur Spectacle</h1>`;
    elementParent.innerHTML = codeHTML;
}
function ajouterSpectacle(elementParent,element) {
    const codeHTML = `
    <div class="spec box">
      <h1>`+element.details.titre+`</h1>
      <img class="ImgSpec" url=`+element.details.tabImg[0].imgUrl+` alt="Affiche">
    </div>
  `;

    // Utiliser innerHTML pour insérer le code HTML dans l'élément parent
    elementParent.innerHTML += codeHTML;
}

function charger(donnee){
    let specUn=donnee.spectacle[0];
    let specDeux=donnee.spectacle[1];
    let specTrois=donnee.spectacle[2];
    let pack1=document.querySelectorAll(".Affiche");
    reset(pack1[0]);
    ajouterSpectacle(pack1[0],specUn);
    ajouterSpectacle(pack1[0],specDeux);
    ajouterSpectacle(pack1[0],specTrois);
    reset(pack1[1]);
    ajouterSpectacle(pack1[1],specUn);
    ajouterSpectacle(pack1[1],specDeux);
    ajouterSpectacle(pack1[1],specTrois);
}



