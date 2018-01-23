<?php
require_once 'inc/cfg.php';
require_once 'class/Produit.php';
require_once 'class/Categorie.php';
$tab = Categorie::tous();
$cat=new Categorie(2);
$tab2=$cat->getTabProduit();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Produits</title>
        <link rel="stylesheet" type="text/css" href="css/commerce.css"/>
        <script type="text/javascript" src="js/index.js"></script>
    </head>
    <body>
        <div id="container">
            <h1>Produits</h1>                                       
             <div>
                <?php
            foreach ($tab2 as $prod) {
                $id_produit = file_exists("img/prod_{$prod->id_produit}_v.jpg") ? $prod->id_produit : 0;
            ?>
            <div class="blocProduit" onclick="detail(<?= $prod->id_produit ?>)">
                <img src="img/prod_<?= $id_produit ?>_v.jpg" alt=""/>
                <div class="nom"><?= $prod->nom ?></div>
                <div class="prix"><?= $prod->prix ?></div>
            </div>
            <?php }?>             
            </div>
        </div>
      </body>
</html>
