 <?php
 require_once 'inc/cfg.php';

class Produit {
    public $id_produit;
    public $id_categorie;
    public $nom;
    public $ref;
    public $prix;

    public function __construct($id_produit = null, $id_categorie = null, $nom = null, $ref = null, $prix = null) {
        $this->id_produit = $id_produit;
        $this->id_categorie=$id_categorie;
        $this->nom = $nom;
        $this->ref = $ref;
        $this->prix = $prix;
    }

    public static function tous() {
        global $db;
        $req = "SELECT * FROM produit ORDER BY nom";
        $jeu = $db->query($req);
        $jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Produit');
        return $jeu->fetchAll();
       }
       
    public function getProduit(){
        global $db;
        $req = "SELECT * FROM categorie WHERE id_categorie={$this->id_categorie} ";
        $jeu = $db->query($req);
        $jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
        return $jeu->fetch();
    }   
      }
