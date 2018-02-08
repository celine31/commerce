window.addEventListener('DOMContentLoaded', () => {//se declenche à la fin de chargement de la page avec une array function
    var vignette = document.querySelector('#vignette');
    document.querySelector('#photo').onchange = function () {
        vignette.innerHTML = '';
        var fichiers = this.files;
        if (fichiers.length !== 1) {
            return;
        }
        var fichier = fichiers[0];
        if (!fichier.size) {
            return alert(UPLOAD_ERR_WRONG_EMPTY_FILE);
        }
        if (fichier.size > MAX_FILE_SIZE) {
            return alert(UPLOAD_ERR_FORM_SIZE);
        }
        if (fichier.type !== 'image/jpeg') {
            return alert(IMAGE_ERR_WRONG_IMAGE_TYPE);
        }
        var reader = new FileReader();
        reader.onload = function () {
            var image = new Image();
            image.style.maxWidth = '100%';
            image.style.maxHeight = '100%';
            vignette.appendChild(image);
            image.src = this.result;
        };
        reader.readAsDataURL(fichier);
    };
});


