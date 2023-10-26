
const divToCapture = document.getElementById("content");

document.getElementById("imprimer").addEventListener("click", function() {
    html2canvas(divToCapture).then(function (canvas) {
        const screenshotDataURL = canvas.toDataURL("image/png");
        const screenshotImage = new Image();
        screenshotImage.src = screenshotDataURL;
        const downloadLink = document.createElement("a");
        downloadLink.href = screenshotDataURL;
        downloadLink.download = "screenshot.png";
        downloadLink.click();
    });
});
