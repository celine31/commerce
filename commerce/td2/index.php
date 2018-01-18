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
/*$req = "DELETE FROM produit WHERE id_produit=3";
echo $pdo->exec($req);*/
?>
<?php
        $req="SELECT * FROM produit";
        $jeu=$pdo->query($req);
        $jeu->setFetchMode(PDO::FETCH_OBJ);
        $tab=$jeu->fetchAll();
?>        
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>commerce</title>
        <link rel = "stylesheet" href="css/commerce.css"/>
    </head>
    <body>
         <table>
                       
           <tr>
               <th> nom </th>
               <th> Référence </th>
               <th> Prix </th>
           </tr>
           <?php foreach($tab as $prod){?>
          <tr>
               <td><?=$prod->nom?>
               </td>
               <td><?=$prod->ref?>
               </td>
               <td><?=$prod->prix?>
               </td>
           <?php }?>
            </table>
      
    </body>
</html>