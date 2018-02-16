<?php

require_once 'class/Cfg.php';
$tabCategorie = Categorie::tab();
//var_dump(Produit::tab());
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
        <header id ="entete">
            <!--si la personne n'est pas connectée-->
            <input type ="button" value="Login" onclick="location = 'login.php'">
            <!--si la personne est connectée-->
            <p>Bonjour  </p> 
            <!--<?//=sprintf('%s %!', $user->nom ,$user->prenom)?>-->
            <input type ="button" value="Délogin" onclick="">
        </header>
        <div id="container">
            <h1>Produits</h1>
            <?php
            foreach ($tabCategorie as $categorie) {
                $tabProduit = $categorie->getTabProduit();
                ?>
                <h2><?= $categorie->nom ?></h2>
                <!--ajout de la condition si connecté-->
                <input type="button" name="bouton" value="Ajouter" onclick="redirection(<?= $categorie->id_categorie ?>)">
                <!-- -->
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
                         <!--ajout de la condition si connecté-->
                        <input type="button" value="modifier" onclick="editerProduit(event,<?=$produit->id_produit?>)">
                        <input type="button" value="supprimer" onclick="supprimerProduit(event,<?=$produit->id_produit?>)">
                        <!-- -->
                        </div>
                        </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>
