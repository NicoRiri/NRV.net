var header = document.getElementById("monHeader");
var isSticky = false;

window.onscroll = function() {
    if (window.pageYOffset > 0 && !isSticky) {
        header.classList.add("sticky");
        header.classList.remove("reversed");
        isSticky = true;
    } else if (window.pageYOffset === 0 && isSticky) {
        header.classList.remove("sticky");
        header.classList.add("reversed");
        isSticky = false;
    }
}
