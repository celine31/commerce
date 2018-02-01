<?php

class Upload {

    public $nomChamp;
    public $tabExt;
    public $tabMIME;
    public $nomClient;
    public $extension;
    public $cheminServeur;
    public $codeErreur;
    public $octets;
    public $typeMIME;
    public $tabErreur = [];

    public function __construct($nomChamp, $tabExt = [], $tabMIME = []) {
        $this->nomChamp = $nomChamp;
        $this->tabExt = $tabExt;
        $this->tabMIME = $tabMIME;
        //verification que le nom du fichier est bien transmis
        if (!isset($_FILES [$this->nomChamp])) {
            $this->tabErreur[] = "Fichier trop lourd (post)"; //seul cas où le nom n'est pas conservé
            return;
        }
        $fichier = $_FILES[$this->nomChamp];
        $this->nomClient = $fichier['name'];
        //accès au type d'extension mis en minuscule on extrait de la chaine de caractère à partir du point 
        $this->extension = mb_strtolower(mb_substr(mb_strrchr($this->nomClient, '.'), 1)); //puis on retire le point premier caractère(1)
        //chemin du serveur temporaire
        $this->cheminServeur = $fichier['tmp_name'];

        $this->codeErreur = $fichier['error'];
        $this->octets = $fichier['size'];
        $this->typeMIME = $fichier['type'];

        if ($this->tabErreur) {
            $this->tabErreur[] = 'todo'; //TODO
        }
        if (!$this->tabErreur && $this->tabExt && !in_array($this->extension, $tabExt)) {
            $this->tabErreur[] = "L'extansion du fichier est invalide.";
        }
        if (!$this->tabMIME && !in_array($this->typeMIME, $this->tabMIME)) {
            $this->tabErreur[] = "Le type MIME du fichier est invalide.";
        }
        if (!$this->octets) {
            $this->tabErreur[] = "Le fichier est vide.";
        }
    }

    public function sauver($chemin) {
        if (!move_uploaded_file($this->cheminServeur, $chemin)) {
            $this->tabErreur[] = "Le fichier n'a pas pu être sauvegardé"; //TODO;
        }
    }

//retourne le poids maximum de chargement
    public static function maxFileSize($octets = true) {
        $kmg = ini_get('upload_max_filesize');
        if (!$octets) {
            return $kmg;
        }
        $strPoids = str_ireplace('G', '*1024**3+', str_ireplace('M', '*1024**2+', str_ireplace('K', '* 1024+', $kmg))) . '0';
        eval("\$poids = {$strPoids};"); //on échappe $poids pour créer la variable puis il évalue $strPoids donc il réalise l'addition
        return $poids;
    }

}
