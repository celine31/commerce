<?php

class Produit {

    public $id_produit;
    public $id_categorie;
    public $nom;
    public $ref;
    public $prix;

    public function charger() {
        if (!$this->id_produit) {
            return false;
        }
        $req = "SELECT * FROM produit WHERE id_produit={$this->id_produit}";
        return(bool) Connexion::getInstance()->xeq($req)->ins($this);
    }

    public function sauver() {
        $cnx = Connexion::getInstance();
        if ($this->id_produit) {
            $req = "UPDATE produit SET id_categorie={$this->id_categorie},nom={$cnx->esc($this->nom)},ref={$cnx->esc($this->ref)},prix={$this->prix} WHERE id_produit = {$this->id_produit}";
            $cnx->xeq($req);
        } else {
            $req = "INSERT INTO produit VALUES(DEFAULT,{$this->id_categorie}, {$cnx->esc($this->nom)},{$cnx->esc($this->ref)},{$this->prix})";
            $this->id_produit = $cnx->xeq($req)->pk();
        }
        return $this;
    }

    public function supprimer() {
        if (!$this->id_produit) {
            return false;
        }
        $req = "DELETE FROM produit WHERE id_produit={$this->id_produit}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();
    }

    public static function tab($where = '1', $orderBy = '1', $limit = null) {
        $req = "SELECT * FROM " . mb_strToLower(__CLASS__) . " WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        //mb_strToLower permet de rendre la méthode universelle ca mysql est insensible à la casse 
        return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
    }

    public function __construct($id_produit = null, $id_categorie = null, $nom = null, $ref = null, $prix = null) {
        $this->id_produit = $id_produit;
        $this->id_categorie = $id_categorie;
        $this->nom = $nom;
        $this->ref = $ref;
        $this->prix = $prix;
    }

    public function getCategorie() {

        $req = "SELECT * FROM categorie WHERE id_categorie = {$this->id_categorie}";
        return Connexion::getInstance()->xeq($req)->prem('Categorie'); // en passant en chainede caractère PHP transforme en classe
    }

    public function refExiste() {
        $cnx = Connexion::getInstance();
        $this->id_produit = $this->id_produit ? $this->id_produit : 0;
        //ou en PHP7 ternaire combiné $this->id_produit = $this->id_produit?:0;
        $req = "SELECT * FROM produit WHERE ref = {$cnx->esc($this->ref)} AND id_produit != {$this->id_produit}"; //pour ne pas que les quotes soient interprétés et transformés
        return (bool) $cnx->xeq($req)->nb();
    }
}
