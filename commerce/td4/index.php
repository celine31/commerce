<?php include("inc/cfg.php"); 
$req = "SELECT * FROM produit ORDER BY nom ";
$jeu = $dp->query($req);
$jeu->setFetchMode(PDO::FETCH_OBJ);
$tab = $jeu->fetchAll();
?>        
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>commerce</title>
        <link rel = "stylesheet" href="css/commerce.css"/>
        
    </head>
    <body>
        <div id ="conteneur"> 
        <?php foreach ($tab as $prod) { 
            $id_produit=file_exists("img/prod_{$prod->id_produit}_v.jpg")?$prod->id_produit:0;
            ?>
            
        <div class="vignette">
            <a href="detail.php?id_produit=id_produit">
            <img src = "img/prod_<?= $id_produit?>_v.jpg" alt= "image"/>
            <h1><?= $prod->nom ?></h1>
            <p> <?= $prod->prix ?></p>
            </a>
        </div>
       <?php } ?>
      </div>     
</body>
</html>