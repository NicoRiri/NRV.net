fetch("http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree/")
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        let soiree = data.soiree[0];
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
                    for (let j = 0; j < spectacle.artisteArray.length; j++) {
                        artiste += spectacle.artisteArray[j].pseudonyme + " ";
                    }
                    document.getElementsByTagName("body")[0].innerHTML += `
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

                        </div>`;
                });
        }


    });



