<?php

require_once 'inc/cfg.php';
require_once 'class/Produit.php';

$produit = new Produit();
$opt = ['options' => ['min_range' => 1]];
$produit->id_produit = filter_input(INPUT_GET, 'id_produit', FILTER_VALIDATE_INT, $opt);
//arrivee depuis index.php pour la suppression
if ($produit->id_produit) {
    $req = "DELETE FROM produit WHERE id_produit={$produit->id_produit}";
    $db->exec($req);
    header('Location:index.php');
    exit("suppression OK");
    
} else {//erreur donc redirection vers indispo.php
        header('Location:indispo.php');
        exit("Produit indisponible");
    }

