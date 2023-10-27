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
    })
    .catch(error => {
        console.error(`Erreur lors de la requête FETCH : ${error.message}`);
    });
