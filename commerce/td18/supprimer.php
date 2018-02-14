<?php

require_once 'class/Cfg.php';
header('Content-Type:application/json');
$reponse = false;
$data = json_decode(filter_input(INPUT_POST, 'data'));
$opt=['options'=>['min_range'=>1]];
if (property_exists($data, 'id_produit')) {
    $produit=new Produit();
    $produit->id_produit = filter_var($data->id_produit, FILTER_VALIDATE_INT, $opt);
    if ($reponse = $produit->supprimer()) {
        @unlink(Cfg::IMG_RACINE."{$id_produit}_v.jpg");
        @unlink(Cfg::IMG_RACINE."{$id_produit}_p.jpg");
    }
}
echo json_encode($reponse);//garantie de recevoir un message d'erreur même en cas de false 

