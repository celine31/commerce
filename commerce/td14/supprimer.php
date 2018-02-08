<?php

/* ou
  require_once 'inc/cfg.php';
  header('Content-Type:application/json');
  $reponse = false;
  $data = json_decode(filter_input(INPUT_POST, 'data'));
  if (property_exists($data, 'id_produit') && is_int($data->id_produit)) {
  $req = "DELETE FROM produit WHERE id_produit={$data->id_produit}";
  $reponse = $db->exec($req);
  }
  echo json_encode($reponse);
 */
/*2ème version pour garantir la stabilité pour de futurs modifications et 
éviter des messages d'erreurs en cas de piratages (si une chaine de caractères est passée)*/
require_once 'inc/cfg.php';
header('Content-Type:application/json');
$reponse = false;
$data = json_decode(filter_input(INPUT_POST, 'data'));
$opt=['options'=>['min_range'=>1]];
if (property_exists($data, 'id_produit')) {
    $id_produit = filter_var($data->id_produit, FILTER_VALIDATE_INT, $opt);
    if ($id_produit) {
        $req = "DELETE FROM produit WHERE id_produit={$data->id_produit}";
        $reponse = $db->exec($req);
        @unlink("../img/prod_{$id_produit}_v.jpg");
        @unlink("../img/prod_{$id_produit}_p.jpg");
    }
}
echo json_encode($reponse);//garantie de recevoir un message d'erreur même en cas de false 

