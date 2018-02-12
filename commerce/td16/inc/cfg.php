<?php

spl_autoload_register(function($classe){
   @include "class/{$classe}.php";
   //include ne met qu'un warning au lieu de require mais @include passe l'erreur
   // en cas de plusieurs fichiers avec des classes autant de spl_autoload_register que nécessaire
   //d'où des erreurs possibles avec require
});
Connexion::setDSN('commerce','root','', 'localhost');

