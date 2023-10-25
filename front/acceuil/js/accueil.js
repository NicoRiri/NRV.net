var header = document.getElementById("monHeader");
var isSticky = false;

window.onscroll = function() {
    if (window.pageYOffset > 0 && !isSticky) {
        header.classList.add("sticky");
        popup.style.visibility = 'hidden';
        header.classList.remove("reversed");
        isSticky = true;
    } else if (window.pageYOffset === 0 && isSticky) {
        header.classList.remove("sticky");
        header.classList.add("reversed");
        isSticky = false;
    }
}

// Sélectionnez le bouton et l'élément .popup
const bouton = document.querySelector('.myIcon');
const popup = document.querySelector('.popup');

console.log(popup.style);
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