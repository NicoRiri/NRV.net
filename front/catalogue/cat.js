/* Les Variables */
    let lieux = [];

/* Les Fetch */
    let soirees = fetch("http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree/")
    .then(function(response) {
        if (!response.ok) {
            throw new Error("Réponse réseau incorrecte");
        }
        return response.json();
    });

    function getSoireeById(id){
        let soiree = fetch("http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree/" + id)
        .then(function(response) {
            if (!response.ok) {
                throw new Error("Réponse réseau incorrecte");
                }
                return response.json();
        });
        return soiree;
    }

    let specs = fetch("http://docketu.iutnc.univ-lorraine.fr:42769/api/spectacle/")
    .then(function(response) {
        if (!response.ok) {
        throw new Error("Réponse réseau incorrecte");
        }
        return response.json();
    });
    
    specs.then(data => {
            data.spectacle.forEach(element => {
            let a = document.createElement("a");
            a.setAttribute("href", "../detailspectacle/index.html?id=" + element.details.id);
            a.setAttribute("class", "item");
            a.innerHTML = `<div class="text">
                <h2>${element.details.titre}</h2>`;

                element.details.artisteArray.forEach(artiste => {
                    a.innerHTML += `<p>${artiste.pseudonyme}</p>`;
                });
                
                getSoireeById(element.details.soiree_id)
                .then(soiree => {
                    a.innerHTML += `<p>${soiree.soiree.details.date}</p>
                                    <p>${soiree.soiree.details.nbPlaceRestanteTotale} places</p>`;
                });



            a.innerHTML += `</div>`;
                if(element.details.tabImg.length > 1){
                    //prendre un nombre aléatoire entre 0 et tabImg.length
                    let rand = Math.floor(Math.random() * element.details.tabImg.length);
                    a.innerHTML += `<img src="${element.details.tabImg[rand].imgUrl}" alt="Image 1" class="image"/>`;
                } else {
                    a.innerHTML += `<img src="${element.details.tabImg[0].imgUrl}" alt="Image 1" class="image"/>`;
                }
            document.getElementById("catalogue").appendChild(a);
        });
    })
    .catch(function(error) {
        console.log(
        "Il y a eu un problème avec l'opération fetch: " +
            error.message
        );
    });

    soirees.then(data => {
        data.soiree.forEach(element => {
            console.log(element);
            let lieu = document.createElement("option");
            lieu.setAttribute("value", element.lieu_id.nom);
            lieu.innerHTML = element.lieu_id.nom;
            document.getElementById("lieux").appendChild(lieu);
            
            let theme = document.createElement("option");
            theme.setAttribute("value", element.thematique);
            theme.innerHTML = element.thematique;
            document.getElementById("genre").appendChild(theme);
        });
    });

/* Les Event */

    document.getElementById("txtfiltre").addEventListener("click", function(){
        document.getElementById("filtre").classList.toggle("filtreshown");
        document.getElementById("hidden").classList.toggle("hiddenshown");

    });

    document.getElementById("exec").addEventListener("click", function(){
        document.getElementById("catalogue").innerHTML = "";
        let lieu = document.getElementById("lieux").value;
        let theme = document.getElementById("genre").value;
        let date = document.getElementById("date").value;
        console.log(lieu);
        specs.then(data => {
            data.spectacle.forEach(element => {
                getSoireeById(element.details.soiree_id).then(soiree => {
                    if(soiree.soiree.details.lieu_id.nom == lieu || lieu == "0"){
                        if(soiree.soiree.details.thematique == theme || theme == "0"){
                            if(soiree.soiree.details.date == date || date == ""){
                                let a = document.createElement("a");
                                a.setAttribute("href", "../detailspectacle/index.html?id=" + element.details.id);
                                a.setAttribute("class", "item");
                                a.innerHTML = `<div class="text">
                                    <h2>${element.details.titre}</h2>`;

                                    element.details.artisteArray.forEach(artiste => {
                                        a.innerHTML += `<p>${artiste.pseudonyme}</p>`;
                                    });
                                    
                                    getSoireeById(element.details.soiree_id)
                                    .then(soiree => {
                                        a.innerHTML += `<p>${soiree.soiree.details.date}</p>
                                                        <p>${soiree.soiree.details.nbPlaceRestanteTotale} places</p>`;
                                    });



                                a.innerHTML += `</div>`;
                                    if(element.details.tabImg.length > 1){
                                        //prendre un nombre aléatoire entre 0 et tabImg.length
                                        let rand = Math.floor(Math.random() * element.details.tabImg.length);
                                        a.innerHTML += `<img src="${element.details.tabImg[rand].imgUrl}" alt="Image 1" class="image"/>`;
                                    } else {
                                        a.innerHTML += `<img src="${element.details.tabImg[0].imgUrl}" alt="Image 1" class="image"/>`;
                                    }
                                document.getElementById("catalogue").appendChild(a);
                            }
                        }
                    }
                });
            });
        });
        document.getElementById("filtredate").innerHTML = `<label>Par date :</label>
        <input type="date" id="date">`;
    });

    


/*
<a href="monspectacle.html" class="item">
            <div class="text">
                <h2>Titre 1</h2>
                <p>Mon artiste à mwa</p>
                <p>Date</p>
                <p>Nombre de places</p>                
            </div>
            <img src="saul.gif" alt="Image 1" class="image"/>
        </a>
         */