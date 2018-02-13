<?php

$opt = ['options' => ['min_range' => 1]];
$id_produit = filter_input(INPUT_GET, 'id_produit', FILTER_VALIDATE_INT, $opt);
if (!$id_produit) {
	header('Location:indispo.php');
	exit("Produit indisponible");
}
$req = "SELECT * FROM produit WHERE id_produit={$id_produit}";
$produit = Connexion::getInstance()->xeq($req)-> prem('Produit');
if (!$produit) {
	header('Location:indispo.php');
	exit("Produit indisponible");
}
$idImg = file_exists(Cfg::IMG_RACINE."prod_{$produit->id_produit}_p.jpg") ? $produit->id_produit : 0;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?= $produit->nom ?></title>
		<link rel="stylesheet" type="text/css" href="css/commerce.css"/>
	</head>
	<body>
		<header></header>
		<div id="container">
			<div class="categorie"><a href="javascript:history.go(-1)"><?= $produit->getCategorie()->nom ?></a> &gt; <?= $produit->nom ?></div>
			<div id="detailProduit">
				<img src="<?=Cfg::IMG_RACINE?>prod_<?= $idImg ?>_p.jpg?alea=<?= rand() ?>" alt=""/>
				<div>
					<div class="prix"><?= $produit->prix ?></div>
					<div class="ref">Référence<br/>
						<?= $produit->ref ?></div>
				</div>
			</div>
		</div>
	</body>
</html>
