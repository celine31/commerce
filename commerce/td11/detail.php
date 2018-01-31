<?php
require_once 'inc/cfg.php';
require_once 'class/Produit.php';
require_once 'class/Categorie.php';

$id_produit=filter_input(INPUT_GET,'id_produit',FILTER_VALIDATE_INT);
if(!$id_produit){
	header('Location:indispo.php');
	exit("Produit indisponible");
}
$req = "SELECT * FROM produit WHERE id_produit={$id_produit}";
$jeu = $db->query($req);
$jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Produit');
$produit = $jeu->fetch();
if(!$produit){
	header('Location:indispo.php');
	exit("Produit indisponible");
}
$categorie = $produit->getCategorie();
$id_produit = file_exists("../img/prod_{$produit->id_produit}_p.jpg") ? $produit->id_produit : 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?= $produit->nom ?></title>
		<link rel="stylesheet" type="text/css" href="css/commerce.css"/>
	</head>
	<body>
		<div id="container">
			<div class="retour"><a href="index.php">Retour</a></div>
			<h1><?= $produit->nom ?></h1>
			<h2><?= $categorie->nom ?></h2>
			<div id="detailProduit">
				<img src="../img/prod_<?= $id_produit ?>_p.jpg" alt=""/>
				<div class="ref"><?= $produit->ref ?></div>
				<div class="prix"><?= $produit->prix ?></div>
			</div>
		</div>
	</body>
</html>
