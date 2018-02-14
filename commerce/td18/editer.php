<?php
require_once 'class/Cfg.php';

$cnx = Connexion::getInstance();

$tabErreur = [];
$tabCategorie = Categorie::tab();
$produit = new Produit();
$opt = ['options' => ['min_range' => 1]];
$produit->id_produit = filter_input(INPUT_GET, 'id_produit', FILTER_VALIDATE_INT, $opt);
$produit->id_categorie = filter_input(INPUT_GET, 'id_categorie', FILTER_VALIDATE_INT, $opt);
$submit = filter_input(INPUT_POST, 'submit');

if ($submit) {
// Arriver depuis editer.php pour INSERT ou UPDATE
    $opt = ['options' => ['min_range' => 1]];
    $produit->id_produit = filter_input(INPUT_POST, 'id_produit', FILTER_VALIDATE_INT, $opt);
    $produit->id_categorie = filter_input(INPUT_POST, 'id_categorie', FILTER_VALIDATE_INT, $opt);
    $produit->nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $produit->ref = filter_input(INPUT_POST, 'ref', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $produit->prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
    // Vérification des données
    if (!$produit->id_categorie || !$produit->getCategorie()) {
        $tabErreur[] = "Categorie incorrecte";
    }
    if (!$produit->nom) {
        $tabErreur[] = "Nom invalide ou absent";
    }
    if (!$produit->ref || $produit->refExiste()) {
        $tabErreur[] = "Référence absente,invalide ou doublon";
    }
    if ($produit->prix === false || $produit->prix >= 1000000) {
        $tabErreur[] = "Prix invalide ou absent";
    }
    // Si données OK, INSERT dans la table produit.
    if (!$tabErreur) {
        $cnx->start(); // On commence la transaction
        $produit->sauver();

        if (!$_FILES['photo']['tmp_name']) {
            $cnx->commit();
            header('Location:index.php');
            exit("Ajout/Modif sans photo"); // exit stop l'execution du php
        }
        $upload = new Upload('photo', [], ['image/jpeg']); // On peux rajouter ,'image/png
        // var_dump($upload->tabErreur);
        if ($upload->tabErreur) {
            $tabErreur = array_merge($tabErreur, $upload->tabErreur);
            $cnx->rollback();
        } else {
            $image = new Image($upload->cheminServeur);
            if ($image->tabErreur) {
                $tabErreur = array_merge($tabErreur, $image->tabErreur);
                $cnx->rollback();
            } else {
                $image->copier(Cfg::IMG_LARGEUR_VIGNETTE, Cfg::IMG_HAUTEUR_VIGNETTE, Cfg::IMG_RACINE . "prod_{$produit->id_produit}_p.jpg", Image::REDIM_CONTAIN);
                $image->copier(Cfg::IMG_LARGEUR_PHOTO, Cfg::IMG_HAUTEUR_PHOTO, Cfg::IMG_RACINE . "prod_{$produit->id_produit}_v.jpg", Image::REDIM_COVER);
                if ($image->tabErreur) {
                    $tabErreur = array_merge($tabErreur, $image->tabErreur);
                    $cnx->rollback();
                } else {
                    $cnx->commit();
                    header('Location:index.php');
                    exit("TOUT OK"); // exit stop l'execution du php
                }
            }
        }
        // Redirection après INSERT
    }
} elseif ($produit->id_produit) {
    // Arriver depuis index.php pour éditer
    if (!$produit->charger()){                     // si le jeu ramène false on ramene vers page indispo(car piratage)
        header('Location:indispo.php');
        exit("Catégorie indisponible"); //PRODUIT CHARGER() TODO
    }
} elseif ($produit->id_categorie) {
    // Arriver depuis index.php pour ajouter: rien à faire
} else {
// Erreur donc redirection vers indispo.php

    header('Location:indispo.php');
    exit("Catégorie indisponible");
}
$idImg = file_exists(Cfg::IMG_RACINE . "prod_{$produit->id_produit}_v.jpg") ? $produit->id_produit : 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editer un produit</title>
        <link rel="stylesheet" type="text/css" href="css/commerce.css"/>
        <style>
            #vignette{
                width: <?= Cfg::IMG_LARGEUR_VIGNETTE ?>px; 
                height: <?= Cfg::IMG_HAUTEUR_VIGNETTE ?>px;
            }
        </style>
        <script type="text/javascript" src="js/editer.js"></script>
        <script type="text/javascript" src="js/AjaxPromise.js"></script>
        <script>
            const MAX_FILE_SIZE = <?= Upload::maxFileSize() ?>;
            const UPLOAD_ERR_FORM_SIZE = "<?= I18n::get(UPLOAD_ERR_FORM_SIZE) ?>";
            const UPLOAD_ERR_WRONG_EMPTY_FILE = "<?= I18n::get('UPLOAD_ERR_WRONG_EMPTY_FILE') ?>";// les quotes sont nécéssaire pour string
            const IMAGE_ERR_WRONG_IMAGE_TYPE = "<?= I18n::get('IMAGE_ERR_WRONG_IMAGE_TYPE') ?>";

        </script>
    </head>
    <body>
        <div id="container">
            <h1>Editer un produit</h1>
            <div class="erreur"><?= implode('<br/>', $tabErreur) ?></div>
            <form name="form1" action="editer.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name ="id_produit" value="<?= $produit->id_produit ?>"/>
                <div class="item">
                    <label>Catégorie</label>
                    <select name="id_categorie">
                        <?php
                        foreach ($tabCategorie as $categorie) {
                            $selected = $produit->id_categorie == $categorie->id_categorie ? 'selected="selected"' : '';
                            ?>
                            <option value = "<?= $categorie->id_categorie ?>" <?= $selected ?>><?= $categorie->nom ?> </option>
                            <?php
                        }
                        ?>        
                    </select>
                </div>
                <div class="item">
                    <label> Reference</label>
                    <input name="ref" value="<?= $produit->ref ?>"/>
                </div>
                <div class="item">
                    <label> Nom</label>
                    <input name="nom" value="<?= $produit->nom ?>"/>
                </div>
                <div class="item">
                    <label> Prix</label>
                    <input name="prix" value="<?= $produit->prix ?>"/>
                </div>
                <label><input type="button" value="Annuler" onclick="location = 'index.php'"/></label>	
                <input name="submit" type="submit" value="Valider"/>
                <div id="vignetteEditer">
                    <label>Photo</label>
                    <input id="photo" type="file" name="photo"/>
                    <input type="button" value="Parcourir..." onclick="this.form.photo.click()"/>
                    <!--<input type="submit" name="submit" value="Envoyer"/> -->
                    <div id="vignette" style=" background-image: url('<?= Cfg::IMG_RACINE ?>prod_<?= $idImg ?>_v.jpg?alea=<?= rand() ?>')"></div>
                </div>
            </form>

        </div>

    </body>
</html>