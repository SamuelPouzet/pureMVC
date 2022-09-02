<?php

const DS = DIRECTORY_SEPARATOR;
define('PUBLIC_PATH', dirname(__FILE__));
define('ROOT_PATH', dirname( PUBLIC_PATH ));
const VENDOR_PATH = ROOT_PATH . DS . 'Vendor';
const LIBRARY_PATH = VENDOR_PATH . DS . 'Library';
const SRC_PATH = ROOT_PATH . DS . 'Src';

require_once VENDOR_PATH . DS . 'autoloader.php';

$autoloader = new \Vendor\autoloader();
$autoloader->register();

$request = new \Vendor\Library\Request();

$config = new \Vendor\Library\Configuration();

$bootstrap = new \Vendor\Library\Bootstrap($config);
$bootstrap->createRoutes();

var_dump($config->getRoutes());

