<?php

class Categorie {

	public $id_categorie;
	public $nom;

	public function __construct($id_categorie = null, $nom = null) {
		$this->id_categorie = $id_categorie;
		$this->nom = $nom;
	}
	
	public function getTabProduit(){
		$req = "SELECT * FROM produit WHERE id_categorie = {$this->id_categorie} ORDER BY nom";
		return Connexion::getInstance()->xeq($req)->tab('Produit');
	}

        public function existe(){
                if ($id_categorie==$this->id_categorie)
                    return true; 
        }
        
	public static function tous() {
		$req = "SELECT * FROM categorie ORDER BY nom";
		return Connexion::getInstance()->xeq($req)->tab(__CLASS__);
	}

}
