<?php

require_once "Psr4Autoloader.php";

$loader = new \Autoloader\Psr4Autoloader;
$loader->register();
$loader->addNamespace('Box\Spout', 'src/Spout');

?>