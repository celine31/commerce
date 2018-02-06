<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'class/image.php';
        $largeur= 100;
        $hauteur = 100;
        $largeurCadreDest= 200;
        $hauteurCadreDest= 200;
        $modeRedim= Image::REDIM_CONTAIN;
        //$modeRedim=Image::REDIM_COVER;
        (new Image($largeur,$hauteur))->copier($largeurCadreDest, $hauteurCadreDest, $cheminDest, $modeRedim = Image::REDIM_CONTAIN);
        
        ?>
    </body>
</html>
