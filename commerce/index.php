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
$req = "DELETE FROM produit WHERE id_produit=3";
echo $pdo->exec($req);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>commerce</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>