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
      <h1 class="sousTitre">`+element.details.titre+`</h1>
      <img class="ImgSpec" src=`+element.details.tabImg[0].imgUrl+` alt="Affiche">
    </div>
  `;

    // Utiliser innerHTML pour insérer le code HTML dans l'élément parent
    elementParent.innerHTML += codeHTML;
}

function charger(donnee){
    let list=[];
    let specUn=donnee.spectacle[0];
    list.push(specUn.details.id);
    let specDeux=donnee.spectacle[1];
    list.push(specDeux.details.id);
    let specTrois=donnee.spectacle[2];
    list.push(specTrois.details.id);
    let pack1=document.querySelectorAll(".Affiche");
    reset(pack1[0]);
    ajouterSpectacle(pack1[0],specUn);
    ajouterSpectacle(pack1[0],specDeux);
    ajouterSpectacle(pack1[0],specTrois);

    //Ici part 2
    reset(pack1[1]);
    ajouterSpectacle(pack1[1],specUn);
    ajouterSpectacle(pack1[1],specDeux);
    ajouterSpectacle(pack1[1],specTrois);
    //Ici fin part 2

    let enfant=pack1[0].children;
    for(let i=1;i<enfant.length;i++){
        enfant[i].addEventListener("click",function(){
            window.location.href = "detailspectacle/index.html?id="+list[i-1];
        });
    }
}



