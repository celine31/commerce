 <?php
 require_once 'inc/cfg.php';

class Produit {

    public $id_produit;
    public $nom;
    public $ref;
    public $prix;

    public function __construct($id_produit = null, $nom = null, $ref = null, $prix = null) {
        $this->id_produit = $id_produit;
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
   }
