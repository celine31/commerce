<?php
require_once 'inc/cfg.php';
$id_produit = isset($_GET['id_produit']) ? (int) $_GET['id_produit'] : 0;
$req = "SELECT * FROM produit WHERE id_produit={$id_produit}";
$jeu = $db->query($req);
$jeu->setFetchMode(PDO::FETCH_OBJ);
$prod = $jeu->fetch();
if(!$prod){
    header('location:indispo.php');
    exit("produit indisponible");
}
$id_produit = file_exists("img/prod_{$prod->id_produit}_p.jpg") ? $prod->id_produit : 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?= $prod->nom ?></title>
		<link rel="stylesheet" type="text/css" href="css/commerce.css"/>
	</head>
	<body>
		<div id="container">
			<div class="retour"><a href="index.php">Retour</a></div>
			<h1><?= $prod->nom ?></h1>
			<div id="detailProduit">
				<img src="img/prod_<?= $id_produit ?>_p.jpg" alt=""/>
                                <div class="categorie"><?=$prod->id_categorie?></div>
                                <div class="ref"><?= $prod->ref ?></div>
				<div class="prix"><?= $prod->prix ?></div>
			</div>
		</div>
	</body>
</html>
