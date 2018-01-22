
<?php
const DSN = 'mysql:dbname=commerce;host=localhost;charset=utf8mb4';
const LOG = 'root';
const OPT = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
try {
    $db = new PDO(DSN, LOG, '', OPT);
} catch (PDOException $e) {
    exit("Erreur : {$e->getMessage()}");
}
?>
