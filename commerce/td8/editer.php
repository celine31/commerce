<?php
require_once 'inc/cfg.php';
require_once 'class/Produit.php';
require_once 'class/Categorie.php';
$tabErreur = [];
$tabCategorie = Categorie::tous();
$submit = filter_input(INPUT_POST, 'submit');
$produit = new Produit();
if ($submit) {
//recupération des données POST
    $opt = ['options' => ['min_range' => 1]];
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
    if ($produit->prix === false) {
        $tabErreur[] = "prix invalide ou absent";
    }
    //si ok, INSERT dans la table produit  
    if (!$tabErreur) {//tableau vide vu comme false
        $req = "INSERT INTO produit VALUES(DEFAULT,{$produit->id_categorie},{$db->quote($produit->nom)},{$db->quote($produit->ref)},{$produit->prix})";
        $db->exec($req);
        //redirection après INSERT  
        header('Location:index.php');
        exit("Ajout OK");
    }
} else {
    //arrivée en get par le formulaire
    $opt = ['options' => ['min_range' => 1]];
    $produit->id_categorie = filter_input(INPUT_GET, 'id_categorie', FILTER_VALIDATE_INT, $opt);
    if (!$produit->id_categorie) {
        header('Location:indispo.php');
        exit("Produit indisponible");
    }
  }
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
            <h3>Editer un produit</h3>
            <div class="erreur"><?=implode('<br/>',$tabErreur)?></div> <!-- a la place d'un foreach pour l'affichage des erreurs-->
            <form name="form1" method='POST' action='editer.php'> 
                <select name="id_categorie">
                    <?php
                    foreach ($tabCategorie as $categorie) {
                        $selected = $produit->id_categorie == $categorie->id_categorie ? 'selected="selected"' : '';
                        ?>
                        <option value="<?= $categorie->id_categorie?>"<?= $selected ?>><?= $categorie->nom?> </option>   
                    <?php } ?>
                </select>
                <p> nom </p> <input type="text" name="nom" value="<?=$produit->nom?>"/> 
                <p> référence </p> <input type="text" name="reference" value="<?=$produit->ref?>"/> 
                <p> prix </p> <input type="text" name="prix" value="<?=$produit->prix?>"/> <br/>
                <label><input type="button" value="annuler" onclick="location = 'index.php'"/></label>
                <input type="submit" value="enregistrer" name="submit"/>
            </form>
          </div>
    </body>
</html>