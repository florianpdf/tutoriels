<?php

// Récupération des valaurs une par une
$db_name = 'mvcAtelier';
$db_host = 'localhost';
$db_port = '3306';

// Définition des constantes
define('APP_DB_USER', 'root');
define('APP_DB_PWD', 'root');
define('APP_DSN', 'mysql:dbname=' . $db_name . ';host=' . $db_host . ':' . $db_port);