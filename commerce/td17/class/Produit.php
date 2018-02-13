<?php

class Produit {

    public $id_produit;
    public $id_categorie;
    public $nom;
    public $ref;
    public $prix;

    public function __construct($id_produit = null, $id_categorie = null, $nom = null, $ref = null, $prix = null) {
        $this->id_produit = $id_produit;
        $this->id_categorie = $id_categorie;
        $this->nom = $nom;
        $this->ref = $ref;
        $this->prix = $prix;
    }

    public function getCategorie() {
        
        $req = "SELECT * FROM categorie WHERE id_categorie = {$this->id_categorie}";
        return Connexion::getInstance()->xeq($req)->prem('Categorie');// en passant en chainede caractère PHP transforme en classe
        }

    public function refExiste() {
        $cnx=Connexion::getInstance();
        $this->id_produit = $this->id_produit ? $this->id_produit : 0;
        //ou en PHP7 ternaire combiné $this->id_produit = $this->id_produit?:0;
        $req = "SELECT * FROM produit WHERE ref = {$cnx->esc($this->ref)} AND id_produit != {$this->id_produit}"; //pour ne pas que les quotes soient interprétés et transformés
        return (bool) $cnx->xeq($req)->nb();
        }

    public static function tous() {
        $req = "SELECT * FROM produit ORDER BY nom";
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);//représente la classe en cours
    }
}
