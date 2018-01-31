<?php
require_once 'inc/cfg.php';
require_once 'class/Produit.php';
require_once 'class/Categorie.php';
$tabErreur = [];
$produit = new Produit();
$opt = ['options' => ['min_range' => 1]];
$produit->id_produit = filter_input(INPUT_GET, 'id_produit', FILTER_VALIDATE_INT, $opt);
$produit->id_categorie = filter_input(INPUT_GET, 'id_categorie', FILTER_VALIDATE_INT, $opt);
//  arrivee depuis editer.php pour ajouter ou mettre à jour. 

$submit = filter_input(INPUT_POST, 'submit');
if ($submit) {
//recupération des données POST
    $opt = ['options' => ['min_range' => 1]];
    $produit->id_produit = filter_input(INPUT_POST, 'id_produit', FILTER_VALIDATE_INT);//on tente de récuperer l'id_produit
    $produit->id_categorie = filter_input(INPUT_POST, 'id_categorie', FILTER_VALIDATE_INT, $opt);
    $produit->nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $produit->ref = filter_input(INPUT_POST, 'reference', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $produit->prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);

//vérification des données POST
    if (!$produit->id_categorie || !$produit->getCategorie()) {
        $tabErreur[] = "Categorie incorrecte";
    }
    if (!$produit->nom) {
        $tabErreur[] = "Nom invalide ou absent";
    }
    if (!$produit->ref || $produit->refExiste()) {
        $tabErreur[] = "référence absente ou invalide ou en doublon";
    }
    if ($produit->prix === false || $produit->prix >=1000000) {
        $tabErreur[] = "prix invalide ou absent";
    }
    //si ok, INSERT dans la table produit  
    if (!$tabErreur) {//tableau vide vu comme false
        if($produit->id_produit){
        $req="UPDATE produit SET id_categorie = {$produit->id_categorie},nom={$db->quote($produit->nom)},ref={$db->quote($produit->ref)},prix={$produit->prix} WHERE id_produit={$produit->id_produit}";           
        }else{
        $req = "INSERT INTO produit VALUES(DEFAULT,{$produit->id_categorie},{$db->quote($produit->nom)},{$db->quote($produit->ref)},{$produit->prix})";
        }
        $db->exec($req);
        //redirection après INSERT  
        header('Location:index.php');
        exit("Ajout/Modif OK");
    }
} elseif ($produit->id_produit) {//arrivee depuis index.php pour modifier
    $req = "SELECT * FROM produit WHERE id_produit={$produit->id_produit}";
    $jeu = $db->query($req);
    $jeu->setFetchMode(PDO::FETCH_INTO, $produit);
    if (!$jeu->fetch()) {//permet d'éviter des failles en cas d'id inexistant
        header('Location:indispo.php');
        exit("Produit indisponible");
    }
} elseif ($produit->id_categorie) {
//arrivee depuis index.php pour ajouter :rien à faire
} else {//erreur donc redirection vers indispo.php
    header('Location:indispo.php');
    exit("Produit indisponible");
}

$tabCategorie = Categorie::tous();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editer</title>
        <link rel="stylesheet" type="text/css" href="css/commerce.css"/>
    </head>
    <body>
        <div id="categorie">
            <h3>Catégories</h3>
            <form name="form1" method='POST' action=''> 
                <input type="hidden" name="id_produit" value="<?= $produit->id_produit ?>"/> 
                <select name="id_categorie">
                    <?php
                    foreach ($tabCategorie as $categorie) {
                        $selected = $produit->id_categorie == $categorie->id_categorie ? 'selected="selected"' : '';
                        ?>
                        <option value="<?= $categorie->id_categorie ?>" <?= $selected ?>><?= $categorie->nom ?> </option>   
                    <?php } ?>
                </select>               
                <p> nom </p> <input type="text" name="nom" value="<?= $produit->nom ?>"/> 
                <p> référence </p> <input type="text" name="reference" value="<?= $produit->ref ?>" /> 
                <p> prix </p> <input type="text" name="prix" value="<?= $produit->prix ?>"/> <br/>
                <label><input type="button" value="annuler" onclick="location = 'index.php'"/></label>
                <input type="submit" value="enregistrer" name="submit"/>
            </form>
        </div>
    </body>
</html>