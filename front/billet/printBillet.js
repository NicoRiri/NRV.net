const divToCapture = document.getElementsByClassName("contenu");

document.getElementById("imprimer").addEventListener("click", function () {
    for (let i = 0; i < divToCapture.length; i++) {
        html2canvas(divToCapture[i]).then(function (canvas) {
            const screenshotDataURL = canvas.toDataURL("image/png");
            const screenshotImage = new Image();
            screenshotImage.src = screenshotDataURL;
            const downloadLink = document.createElement("a");
            downloadLink.href = screenshotDataURL;
            downloadLink.download = "screenshot.png";
            downloadLink.click();
        });
    }
});
