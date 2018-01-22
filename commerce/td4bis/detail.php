<?php
require_once 'inc/cfg.php';
$id_produit=isset($_GET['id_produit'])?(int)$_GET['id_produit']:0;
$req = "SELECT * FROM produit WHERE id_produit={$id_produit}";
$jeu = $db->query($req);
$jeu->setFetchMode(PDO::FETCH_OBJ);
$prod = $jeu->fetch();
/*$id_produit = file_exists("img/prod_{$prod->id_produit}_v.jpg") ? $prod->id_produit : 0;*/
 ?>   
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$prod->nom?></title>
        <link rel = "stylesheet" type="text/css" href="css/commerce.css"/>
     </head>
    <body> 
        <div class="vignetteDetail">
            <img src = "img/prod_<?=$prod->id_produit?>_p.jpg" alt= "image"/>
            <h2><?=$prod->ref?></h2>
            <p class="detailler"><?=$prod->prix?></p>
        </div>
        <a href="index.php">Retour</a>
    </body>
</html>