<?php
require_once 'class/Upload.php';
$upload = new Upload("photo");
var_dump($upload);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Test</title>

    </head>
    <body>
        <form name="form1" action="" method="post" enctype="multipart/form-data">
            <input id="photo" type="file" name="photo"/> 
            <div id="vignette"></div>
            <input type="submit" value="envoyer"/>
            
        </form>
        <script>
       
    document.querySelector('#photo').onchange = function () {
                var fichiers = this.files;
                if (fichiers.length !== 1) {
                    return;
                }
                var fichier = fichiers[0];
                if (fichier.size > <?= Upload::maxFileSize() ?>) {
                    return alert("le fichier est trop lourd");
                }
                if (fichier.type !== 'image/jpeg') {
                    return alert("le fichier n'est pas JPEG")
                }
                
                };
        </script>
    </body>
</html>
