const url = "http://docketu.iutnc.univ-lorraine.fr:42769/api/connexion/";
const username = "user1@mail.com";
const password = "user1";
const basicAuth = 'Basic ' + btoa(username + ':' + password);

fetch(url, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': basicAuth
    }
})
    .then(response => {
        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        localStorage.setItem("token", data.accesToken);
    })
    .catch(error => {
        console.error(`Erreur lors de la requête FETCH : ${error.message}`);
    });