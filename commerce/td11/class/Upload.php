<?php

class Upload {

    public $nomChamp;
    public $tabExt = [];
    public $nomClient = '';
    public $extension = '';
    public $cheminServeur = '';
    public $codeErreur = 0;
    public $octets = 0;
    public $typeMime = '';
    public $tabErreur = [];

    public function __construct($nomChamp = null, $tabExt = []) {
        $this->nomChamp = $nomChamp;
        $this->tabExt = $tabExt;
        $this->nomClient = $nomClient;
        $this->extension = $extension;
        $this->cheminServeur = $cheminServeur;
        $this->codeErreur = $codeErreur;
        $this->octets = $octets;
        $this->typeMime = $typeMime;
        $this->tabErreur = $tabErreur;
        
        $_FILES['nomChamp'];     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
        $_FILES['type']; //Le type du fichier. Par exemple, cela peut être « image/png ».
        $_FILES['size'];     //La taille du fichier en octets.
        $_FILES['tmp_name']; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
        $_FILES['error'];    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.

    }

    public function sauver($chemin) {
        mkdir('fichier/1/', 0777, true);
//créer un identifiant difficile à deviner
        $nom = md5(uniqid(rand(), true));
        $nom = "avatars/{$id_membre}.{$extension_upload}";
        $resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
        if ($resultat) echo "Transfert réussi";
    }

}
