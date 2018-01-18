<?php
const DSN = 'mysql:dbname=commerce;host=localhost;charset=utf8mb4';
const LOG = 'root';
const OPT = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
try {
    $pdo = new PDO(DSN, LOG, '', OPT);
} catch (PDOException $e) {
    exit("Erreur : {$e->getMessage()}");
}
/* $req = "DELETE FROM produit WHERE id_produit=3";
  echo $pdo->exec($req); */
?>
<?php
$req = "SELECT * FROM produit ORDER BY nom ";
$jeu = $pdo->query($req);
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
            $file="img/prod_{$prod->id_produit}_v.jpg"
            ?>
        <div class="vignette">
            <?php if (file_exists($file)){?>
            <img src = "img/prod_<?= $prod->id_produit?>_v.jpg" alt= "image"/>
            <?php }
            else echo "vignette indisponible"?>   
            <h1><?= $prod->nom ?></h1>
            <p> <?= $prod->prix ?></p>
        </div>
          
    <?php } ?>
        </div>

</body>
</html>