<?php

declare(strict_types = 1);

class Session implements SessionHandlerInterface, Databasable {

    public $sid; // PHPSESSID
    public $data; //données de session sérialisées par PHP
    public $dateMaj; // Date de mise à jour (auto)
    private $timeout; //Timeout en secondes, aucun si null

    public function __construct($timeout = null) {
        $this->timeout = $timeout;
    }

    //méthode de SessionHandlerInterface à redéfinir
    public function close(): bool {//void utiliser pour sauvegarder un systeme de fichier il faut une ouverture et une fermeture 
        // var_dump("Write");
        return true;
    }

    public function destroy($session_id): bool {//permet de détruire le cookie de session en base de données
        //var_dump("Write, session_id={session_id}");
        $this->sid = $session_id;
        return $this->supprimer();
    }

    public function gc($maxlifetime): int {//permet de supprimer en base de données après un certain temps
        //var_dump("Write , maxlifetime={$maxlifetime}");
        $req = "DELETE FROM session WHERE TIMESTAMPDIFF(SECOND, dateMaj, NOW())>{$this->timeout}";
        return (bool) Connexion::getInstance()->xeq($req)->nb();
    }

    public function open($save_path, $session_name): bool {//utiliser pour sauvegarder un systeme de fichier il faut une ouverture et une fermeture
        //var_dump("Write, save_path={$save_path}, session_name={$session_name}");
        return true;
    }

    public function read($session_id): string {//permet de lire le cookie de session en base de données
        //var_dump("Write, session_id ={$session_id}");
       $this->sid = $session_id; 
       return $this->charger() ? $this->data : ''; 
    }

    public function write($session_id, $session_data): bool {//permet d'écrire le cookie en base de données
       // var_dump("Write, sid={$session_id} , session_data = {session_data}");
        $this->sid=$session_id;
        $this->data=$session_data;
        $this->sauver();
        return true;
    }

    //méthode de Databasable à redéfinir
    public function charger() {//permet de charger le cookie de session en base de données  
        $cnx = Connexion::getInstance();
        $req = "SELECT * FROM session WHERE sid={$cnx->esc->$this->sid}" . ($this->timeout ? " AND TIMESTAMPDIFF(SECOND, dateMaj, NOW())<{$this->timeout}" : '');
        return(bool) $cnx->xeq($req)->ins($this);
    }

    public function sauver() {//permet de sauvegarder en base de données
        $cnx = Connexion::getInstance();
        $req = "INSERT INTO session VALUES({$cnx->esc($this->sid)},({$cnx->esc($this->data)},DEFAULT) ON DUPLICATE KEY UPDATE data = {$cnx->esc($this->data)}, dateMaj=DEFAULT";
        $cnx->xeq($req);
        return $this;
    }

    public function supprimer() {//permet de supprimer en base de données
        $cnx = Connexion::getInstance();
        $req = "DELETE FROM session WHERE sid={$cnx->esc->$this->sid}";
        return(bool) $cnx->xeq($req)->nb();
    }

    public static function tab($where = '1', $orderBy = '1', $limit = null) {
        //Inutile ici
        return[];
    }
}
