<?php require_once '../app/bootstrap.php'; 

$db->connect('demo_neon');

$session->_set('Hello World','Greeting');

alert($session->_get());