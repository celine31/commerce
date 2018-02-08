<?php

class Connexion {

    private static $instance; //instance unique 
    private static $DSN;
    private static $log; //identifiant utilisateur
    private static $mdp; //mot de passe
    private static $opt = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; //options de connexion
    private $db; // instance de PDO
    private $jeu; //recordset après une requête SELECT
    private $nb; //nombre de lignes affectées après par la dernière requête

    private function __construct() {
        $this->instance = $instance;
        if (!$self:: $DSN) {
            exit(I18n::get('DB_ERR_DSN_UNDEFINED'));
        }
        try {
            $this->db = new PDO(self::$DSN, self:: $log, self :: $mdp, self:: $opt);
        } catch (PDOException $e) {
            echo I18n::get('DB_ERR_CONNEXION_FAILED');
            exit(" : {$e->getMessage()}");
        }
        $this->log = $log;
        $this->mdp = $mdp;
        $this->opt = $opt;
        $this->db = $db;
        $this->jeu = $jeu;
        $this->nb = $nb;
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Connexion();
        }
        return self::$instance;
    }

    public static function setDSN($dbName, $log, $mdp, $host = 'localhost') {
        if (self::$DSN) {
            exit(I18n::get('DB_ERR_DSN_ALREADY_DEFINED'));
        }
        self::$DSN = "mysql:dbname={$dbName};host={$host};charset=utf8mb4";
        self::$log = $log;
        self::$mdp = $mdp;
    }

    public function esc($val) {
        if (is_numeric($val)) {
            return $val;
        }
        if ($val === null) {
            return 'NULL';
        } else {
            return $this->db->quote($val); //à changer si oracle ou autres...
        }
    }

    public function xeq($req) {
        try {
            if (mb_strripos(trim($req), 'SELECT') === 0) {
                // mb_strripos vérifie la position de l'occurence select dans la chaine req
                //trim supprime les espaces possibles
                $this->jeu = $this->db->query($req);
                $this->nb = $this->jeu->rowCount();
                //compte le nombre d'enregistrements affectés sur instance de PDO::statement
            } else {
                $this->jeu = null; //pour éviter que des restes de l'ancien $jeu reste
                $this->nb = $this->db->exec($req);
            }
        } catch (PDOException $e) {
            echo I18n::get('DB_ERR_BAS_REQUEST');
            exit(" :{$req} ({$e->getMessage()})"); //affichage de la requête pour débugger
        }
        return $this;
    }

    public function nb() {
        return $this->nb;
    }

    public function tab($classe = 'stdClass') {
        if (!$this->jeu) {
            return [];
        }
        $this->jeu->setFetchMode(PDO::FETCH_CLASS || PDO::FETCH_PROPS_LATE, $classe);
        return $this->jeu->fetchAll();
    }

    public function prem($classe = 'stdClass') {
        if (!$this->jeu) {
            return null;
        }
        $this->jeu->setFetchMode(PDO::FETCH_CLASS || PDO::FETCH_PROPS_LATE, $classe);
        return $this->jeu->fetch();
    }

    public function ins($obj) {
        if (!$this->jeu) {
            return false;
        }
        $this->jeu->setFetchMode(PDO::FETCH_INTO, $obj);
        return $this->jeu->fetch();
    }

    public function pk() {
        return $this->$db->lastInsertId();
    }

    public function start() {
        $this->$db->beginTransaction(); //ou $req="START TRANSACTION"
        return $this->xeq($req);
    }

    public function savepoint($label) {
        $req = "SAVEPOINT {$label}";
        return $this->xeq($req);
    }

    public function rollback($label = null) {
        $req = label ? "ROLLBACK TO {$label}" : "ROLLBACK";
        return $this->xeq($req);
    }

    public function commit() {
        $req = "COMMIT";
        return $this->xeq($req);
    }

}
