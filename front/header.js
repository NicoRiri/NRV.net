var header = document.getElementById("monHeader");
var isSticky = false;



const panier = document.querySelector('.connecter');

let token=localStorage.getItem("token");

let cheminDeLaPage = window.location.pathname;
let segments = cheminDeLaPage.split('/');
let deuxDerniersSegments = segments.slice(-2).join('/');

if(token!=null){
    panier.style.visibility = 'visible';
    let parent=document.querySelector(".popup").children;
    parent[0].innerHTML="Profil";
    parent[1].innerHTML="Deconnexion";
    if(deuxDerniersSegments=="front/Index.html"){
        parent[0].href="../front/profil/index.html";
        parent[1].href="../front/index.html";
    }else{
        parent[0].href="../profil/index.html";
        parent[1].href="../index.html";
    }
    parent[1].onclick=function(){
        localStorage.removeItem("token");
    }


}else{
    panier.style.visibility = 'hidden';
}

window.onscroll = function() {
    popup.style.visibility = 'hidden';
    if (window.pageYOffset > 0 && !isSticky) {
        header.classList.add("sticky");
        popup.style.top="8%";
        header.classList.remove("reversed");
        isSticky = true;
    } else if (window.pageYOffset === 0 && isSticky) {
        header.classList.remove("sticky");
        popup.style.top="10%";
        header.classList.add("reversed");
        isSticky = false;
    }
}

// Sélectionnez le bouton et l'élément .popup
const bouton = document.querySelector('.myIcon');
const popup = document.querySelector('.popup');
// Ajoutez un gestionnaire d'événement pour le clic sur le bouton
bouton.addEventListener('click', function(event) {
    // Empêchez la propagation du clic pour éviter de fermer immédiatement la fenêtre modale
    event.stopPropagation();

    // Affichez la fenêtre modale
    popup.style.visibility = 'visible';

    // Ajoutez un gestionnaire d'événement pour les clics sur le document
    document.addEventListener('click', function closePopup(e) {
        // Vérifiez si l'élément cliqué n'est pas la fenêtre modale
        if (e.target !== popup && !popup.contains(e.target)) {
            // Clique en dehors de la fenêtre modale, donc cachez-la
            popup.style.visibility = 'hidden';

            // Supprimez le gestionnaire d'événement pour éviter des fermetures supplémentaires
            document.removeEventListener('click', closePopup);
        }
    });
});