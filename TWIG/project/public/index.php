<?php

// Get Vendor autoload
require_once '../vendor/autoload.php';

use MyApp\Controllers\DefaultController;

$defaultController = new DefaultController();

if (empty($_GET)){
	echo $defaultController->indexAction();
}