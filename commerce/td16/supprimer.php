<?php

require_once 'inc/cfg.php';
header('Content-Type:application/json');
$reponse = false;
$data = json_decode(filter_input(INPUT_POST, 'data'));
$opt=['options'=>['min_range'=>1]];
if (property_exists($data, 'id_produit')) {
    $id_produit = filter_var($data->id_produit, FILTER_VALIDATE_INT, $opt);
    if ($id_produit) {
        $req = "DELETE FROM produit WHERE id_produit={$data->id_produit}";
        $reponse = Connexion::getInstance()->xeq($req)->nb();//nb() pour que l'on est 1 ou 0 pour reponse de index.js
        @unlink("../img/prod_{$id_produit}_v.jpg");
        @unlink("../img/prod_{$id_produit}_p.jpg");
    }
}
echo json_encode($reponse);//garantie de recevoir un message d'erreur même en cas de false 

