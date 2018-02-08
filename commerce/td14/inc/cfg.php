<?php
require_once 'class/Connexion.php';
//const DSN = "mysql:dbname=commerce;host=localhost;charset=utf8mb4";
//const LOG = 'root';
//const MDP = '';
Connexion::setDSN('commerce','root','', 'localhost');
$cnx=Connexion::getInstance();
//on a modifié le fichier de configuration pour l'utilisation de la classe Connexion