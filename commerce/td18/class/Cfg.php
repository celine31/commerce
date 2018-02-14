<?php

Cfg::init();
class Cfg {

    private static $initDone = false;

    const IMG_RACINE = '../img/';
    const IMG_LARGEUR_VIGNETTE = 300;
    const IMG_HAUTEUR_VIGNETTE = 300;
    const IMG_LARGEUR_PHOTO = 150;
    const IMG_HAUTEUR_PHOTO = 150;

    private function __construct() {
        
    }

    public static function init() {
        if (self::$initDone) {
            return false;
        }
        spl_autoload_register(function($classe) {
            @include "class/{$classe}.php";
        });
        Connexion::setDSN('commerce', 'root', '', 'localhost');
        return self::$initDone = true;
    }

}
