<?php
require_once 'inc/cfg.php';
require_once 'class/Produit.php';
require_once 'class/Categorie.php';
$tabCategorie = Categorie::tous();
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
            <?php
            foreach ($tabCategorie as $categorie) {
                $tabProduit = $categorie->getTabProduit();
                ?>
                <h2><?= $categorie->nom ?></h2>
                <input type="button" name="bouton" value="Ajouter" onclick="redirection(<?= $categorie->id_categorie ?>)">
                <br/>
                <?php
                foreach ($tabProduit as $produit) {
                    $id_produit = file_exists("../img/prod_{$produit->id_produit}_v.jpg") ? $produit->id_produit : 0;
                    ?>
                    <div class="blocProduit" onclick="detail(<?= $produit->id_produit ?>)">
                        <img src="../img/prod_<?= $id_produit ?>_v.jpg" alt=""/>
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
