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
	
	public function getCategorie(){
		global $db;
		$req = "SELECT * FROM categorie WHERE id_categorie = {$this->id_categorie}";
		$jeu = $db->query($req);
		$jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
		return $jeu->fetch();
	}

        public function refExiste(){
                global $db;
		$req = "SELECT * FROM produit WHERE ref = {$db->quote($this->ref)}";//pour ne pas que les quotes soient interprétés et transformés
		$jeu = $db->query($req);
		return (bool)$jeu->fetch();//pour caster 
        }
        
	public static function tous() {
		global $db;
		$req = "SELECT * FROM produit ORDER BY nom";
		$jeu = $db->query($req);
		$jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Produit');
		return $jeu->fetchAll();
	}

}
