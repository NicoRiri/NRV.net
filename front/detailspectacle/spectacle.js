const queryString = window.location.search;
const params = new URLSearchParams(queryString);
const idValue = params.get("id");

let url = "http://docketu.iutnc.univ-lorraine.fr:42769/api/spectacle/";
url=url+idValue;

fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        let html = `<h2>${data.spectacle.details.titre}</h2>
        <div class="text">`;
        data.spectacle.details.artisteArray.forEach(artiste => {
            html += `<p>${artiste.pseudonyme}</p>`;
        });
        html += `</div>
        <p>${data.spectacle.details.description}</p>`;
        data.spectacle.details.tabImg.forEach(img => {
            html += `<img src="${img.imgUrl}" class="image"/>`;
        });
        html += `<iframe width="560" height="315" src="${data.spectacle.details.VideoUrl}" allowfullscreen></iframe>
        </div>
            <a class="myLog voirsoiree" href="../soirée/index.html?id=${data.spectacle.details.soiree_id}">Voir la soirée</a>"`;
        document.getElementById("specinfo").innerHTML = html;
    })
    .catch(error => {
        console.error(`Erreur lors de la requête FETCH : ${error.message}`);
    });
