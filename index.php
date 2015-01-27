<?php

require 'config.php';
require 'util/Auth.php';

// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
    require LIBS . $class .".php";
}

$system_path = 'libs';
// Load the Bootstrap!
$bootstrap = new Bootstrap();


//Defined
define('BASEPATH', str_replace('\\', '/', $system_path)); 
// Optional Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();

$bootstrap->init();