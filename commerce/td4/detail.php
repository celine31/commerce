<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>commerce</title>
        <link rel = "stylesheet" href="css/commerce.css"/>
    </head>
    <body> 
        <?php
        include("inc/cfg.php");
        $req = "SELECT * FROM produit WHERE id_produit='$prod->id_produit'";
        $jeu = $dp->query($req);
        $jeu->setFetchMode(PDO::FETCH_OBJ);
        $tab = $jeu->fetch();

        if ($id = isset($_GET['id_produit']) ? (int) $_GET['id_produit'] : 0) {
            ?>   <div class="vignette">
                <img src = "img/prod_<?= $id ?>_p.jpg" alt= "image"/>
                <h1><?= $tab->ref ?></h1>
                <p><?= $tab->prix ?></p>
            </div>
        <?php
        } else
            echo "Il faut cliquer sur une image"
            ?>
    </body>
</html>