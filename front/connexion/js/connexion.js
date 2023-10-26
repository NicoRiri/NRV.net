const url = "http://docketu.iutnc.univ-lorraine.fr:42769/api/connexion/";

document.addEventListener("DOMContentLoaded", function() {
    // Attend que le document HTML soit complètement chargé

    // Écoutez l'événement de soumission du formulaire
    const form = document.querySelector("form"); // Sélectionnez le formulaire
    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire par défaut
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
                console.log(data);
                localStorage.setItem("token", data.accesToken);
            })
            .catch(error => {
                console.error(`Erreur lors de la requête FETCH : ${error.message}`);
            });
    });
});