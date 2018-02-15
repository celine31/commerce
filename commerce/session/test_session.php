<?php
require_once 'Session.php';
require_once 'Databasable.php';
$session = new Session(3000);
var_dump($session);
var_dump("$register : ".session_set_save_handler($session));
var_dump("start :".session_start());
//var_dump("x : ".(isset()));
session_start();

//session_set_save_handler(new Session(3000));