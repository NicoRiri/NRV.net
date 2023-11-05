const url = "http://docketu.iutnc.univ-lorraine.fr:42769/api/connexion/";

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    form.addEventListener("submit", function(event) {
        console.log("TEST");
        event.preventDefault();
        const inputElement = document.querySelectorAll("input");
        let user= inputElement[0].value;
        let mdp= inputElement[1].value;
        const basicAuth = 'Basic ' + btoa(user + ':' + mdp);
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
                localStorage.setItem("token", data.accesToken);
                console.log(window.location.href);
                window.location.href = "/";
            })
            .catch(error => {
                console.error(`Erreur lors de la requête FETCH : ${error.message}`);
            });
    });
});
