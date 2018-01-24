<?php
require_once 'inc/cfg.php';
require_once 'class/Produit.php';
require_once 'class/Categorie.php';
$tabCategorie = Categorie::tous();
if(isset($_POST['submit'])){
$selected_val = $_POST['Color'];  // Storing Selected Value In Variable
echo "You have selected :" .$selected_val;  // Displaying Selected Value
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
            <form name="form1" method='POST' action='editer.php'> 
                <select name="id_categorie">
                    <option disabled="disabled" selected="selected">Choisissez...</option>
                    <?php
                    foreach ($tabCategorie as $categorie) {
                        ?>
                        <option value="<?php $categorie->nom?>"> <?= $categorie->nom?> </option>   
                        <?php } ?>
                </select>
                <p> nom </p> <input type="text"/> 
                <p> référence </p> <input type="text"/> 
                <p> prix </p> <input type="text"/> 
                <input type="submit" value="enregistrer"/>
            </form>
        </div>
    </body>
</html>