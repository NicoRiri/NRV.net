    let specs = [];

    fetch("http://docketu.iutnc.univ-lorraine.fr:42769/api/spectacle/")
    .then(function(response) {
        if (!response.ok) {
        throw new Error("Réponse réseau incorrecte");
        }
        return response.json();
    })
    .then(data => {
        let html = "";

        data.spectacle.forEach(element => {
            let a = document.createElement("a");
            a.setAttribute("href", "../detailspectacle/index.html?id=" + element.details.id);
            a.setAttribute("class", "item");
            a.innerHTML = `<div class="text">
                <h2>${element.details.titre}</h2>`;
                
                fetch("http://docketu.iutnc.univ-lorraine.fr:42769/api/soiree/"+element.details.soiree_id)
                .then(function(response) {  
                    if (!response.ok) {
                        throw new Error("Réponse réseau incorrecte");
                    }
                    return response.json();
                })
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


    document.getElementById("filtre").addEventListener("click", function(){
        console.log("click");
        document.getElementById("filtre").classList.toggle("filtre2");
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