const url = "http://docketu.iutnc.univ-lorraine.fr:42769/api/inscription/";

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        const inputElement = document.querySelectorAll("input");
        let nom= inputElement[0].value;
        let prenom= inputElement[1].value;
        let mail= inputElement[2].value;
        let mdp= inputElement[3].value;
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
                "email" : mail,
                "password" : mdp,
                "nom" : nom,
                "prenom" : prenom
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP! Statut: ${response.status}`);
                }
                window.location.href = "/";
                return response.json();
            })
            .catch(error => {
                console.error(`Erreur lors de la requête FETCH : ${error.message}`);
            });
    });
});
