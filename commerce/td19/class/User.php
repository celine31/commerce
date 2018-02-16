<?php

class User implements Databasable{
   private $id_user;
   private $password;
   private $email;
   private $nom;
   private $prenom;
   
     public function __construct($timeout = null) {
        $this->timeout = $timeout;
    }

    //méthode de Databasable à redéfinir
    public function charger() {//permet de charger le cookie de session en base de données  
        $cnx = Connexion::getInstance();
        $req = "SELECT * FROM user WHERE sid= {$cnx->esc($this->sid)}" . ($this->timeout ? " AND TIMESTAMPDIFF(SECOND, dateMaj, NOW())<{$this->timeout}" : '');
        return(bool) $cnx->xeq($req)->ins($this);
    }

    public function sauver() {//permet de sauvegarder en base de données
        $cnx = Connexion::getInstance();
        $req = "INSERT INTO user VALUES({$cnx->esc($this->sid)},{$cnx->esc($this->data)},DEFAULT) ON DUPLICATE KEY UPDATE data = {$cnx->esc($this->data)}, dateMaj=DEFAULT";
        $cnx->xeq($req);
        return $this;
    }

    public function supprimer() {//permet de supprimer en base de données
        $cnx = Connexion::getInstance();
        $req = "DELETE FROM user WHERE sid={$cnx->esc->$this->sid}";
        return(bool) $cnx->xeq($req)->nb();
    }

    public static function tab($where = '1', $orderBy = '1', $limit = null) {
        //Inutile ici
        return[];
    }

   public function login(){
//méthode de vérification de compte
//retourne true si $this->log et $this->mdp correspondent à un user existant
// retourne false sinon
       
   }
  
   public static function getUserSession(){
       //retourne le user en session le cas échéant ou retourne null
   $user=new User();
   $user->id_user=$_SESSION['id_user']?? null;//opérateur ternaire ?? remplace un isset
   return $user->charger()?$user:null;
 //  public function update(){
   //méthode de mise à jour de compte
   }
}
