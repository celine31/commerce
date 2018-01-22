<?php
require_once "inc/cfg.php";
$id_produit = $_GET['id_produit'];
echo $id_produit;
$req = "SELECT * FROM produit WHERE id_produit=" . $id_produit;
$jeu = $dp->query($req);
$jeu->setFetchMode(PDO::FETCH_OBJ);
$prod = $jeu->fetch();
?>   
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>commerce</title>
        <link rel = "stylesheet" href="css/commerce.css"/>
        <script src="js/index.js"></script>
    </head>
    <body> 
        <div class="vignette">
            <img src = "img/prod_<?= $prod->id_produit ?>_p.jpg" alt= "image"/>
            <h1><?= $prod->ref ?></h1>
            <p><?= $prod->prix ?></p>
        </div>
    </body>
</html>