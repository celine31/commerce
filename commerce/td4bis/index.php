<?php
require_once 'inc/cfg.php';
$req = "SELECT * FROM produit ORDER BY nom ";
$jeu = $db->query($req);
$jeu->setFetchMode(PDO::FETCH_OBJ);
$tab = $jeu->fetchAll();
?>        
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>commerce</title>
        <link rel = "stylesheet" href="css/commerce.css"/>
        <script src="js/index.js" type="text/javascript"></script>
    </head>
    <body>
        <div id ="conteneur"> 
            <h1> Produits </h1>
            <?php
            foreach ($tab as $prod) {
                $id_produit = file_exists("img/prod_{$prod->id_produit}_v.jpg") ? $prod->id_produit : 0;
                ?>
                <div class="vignette" onclick="detail(<?= $id_produit ?>)">
                    <img src = "img/prod_<?= $id_produit ?>_v.jpg" alt= "image"/>
                    <h2><?= $prod->nom ?></h2>
                    <p> <?= $prod->prix ?></p>
                </div>
            <?php } ?>
        </div>     
    </body>
</html>