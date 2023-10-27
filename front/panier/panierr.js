// Définir l'URL de l'API
const apiUrl = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/profile';
let apiUrl2 = 'http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree';
let token = localStorage.getItem('token');

const headers = new Headers();
headers.append('Authorization', `Bearer ${token}`);
const fetchOptions = {
    method: 'GET',
    headers: headers,
};

fetch(apiUrl, fetchOptions)
    .then(response => {
        if (response.status === 200) {
            return response.json();
        } else {
            throw new Error('La requête a échoué');
        }
    })
    .then(data => {
        // Traiter les données reçues ici
        console.log('Données reçues :', data);
        for (let i = 0; i < data.billets.length; i++) {
            if (data.billets[i].estAchete === 0) {

            const quantiteDebout = data.billets[i].quantiteDebout;
            const quantiteAssise = data.billets[i].quantiteAssise;
            // Afficher les soirées achetées
            const soireeId = data.billets[i].soiree_id;
            apiUrl2 = `${apiUrl2}/${soireeId}`;

            fetch(apiUrl2)
                .then(response => {
                    if (response.status === 200) {
                        return response.json();
                    } else {
                        throw new Error('La requête a échoué');
                    }
                })
                .then(soireeData => {
                    console.log(apiUrl2);
                    console.log('Données reçues :', soireeData);

                    const nomSoiree = soireeData.soiree.details.nom;
                    console.log(nomSoiree);
                    const prix = soireeData.soiree.details.prixPlace;
                    console.log(prix);
                    const prixTotal = (prix * quantiteDebout) + (prix * quantiteAssise);
                })

                .catch(error => {
                    console.error('Une erreur s\'est produite lors de la récupération des détails de la soirée :', error);
                })
                .catch(error => {
                    console.error('Une erreur s\'est produite :', error);
                });

        }}
    })


    .catch(error => {
        console.error('Une erreur s\'est produite :', error);
    });