<?php

require_once 'inc/cfg.php';
$data = json_decode(filter_input(INPUT_POST, 'data'));
if (property_exists($data, 'id_produit')) {
    $req = "DELETE FROM produit WHERE id_produit={$data->id_produit}";
    header('Content-Type:application/json');
    echo json_encode($db->exec($req));
}
