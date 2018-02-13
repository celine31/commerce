<?php

require_once 'class/Cfg.php';
$tabCategorie = Categorie::tous();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Produits</title>
        <link rel="stylesheet" type="text/css" href="css/commerce.css"/>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/Ajax.js"></script>
    </head>
    <body>
        <div id="container">
            <h1>Produits</h1>
            <?php
            foreach ($tabCategorie as $categorie) {
                $tabProduit = $categorie->getTabProduit();
                ?>
                <h2><?= $categorie->nom ?></h2>
                <input type="button" name="bouton" value="Ajouter" onclick="redirection(<?= $categorie->id_categorie ?>)">
                <br/>
                <?php
                foreach ($tabProduit as $produit) {
                    $id_produit = file_exists(Cfg::IMG_RACINE."prod_{$produit->id_produit}_v.jpg") ? $produit->id_produit : 0;
                    ?>
                    <div class="blocProduit" onclick="detail(<?= $produit->id_produit ?>)">
                        <img src= "<?=Cfg::IMG_RACINE?>prod_<?= $id_produit ?>_v.jpg?alea=<?=rand()?>" alt=""/>
                        <div>
                        <div class="nom"><?= $produit->nom ?></div>
                        <div class="prix"><?= $produit->prix ?></div>
                        <input type="button" value="modifier" onclick="editerProduit(event,<?=$produit->id_produit?>)">
                        <input type="button" value="supprimer" onclick="supprimerProduit(event,<?=$produit->id_produit?>)">
                        </div>
                        </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>
