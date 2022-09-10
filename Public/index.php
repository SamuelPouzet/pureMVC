<?php

const DS = DIRECTORY_SEPARATOR;
const PUBLIC_PATH = __DIR__;
define('ROOT_PATH', dirname( PUBLIC_PATH ));
const VENDOR_PATH = ROOT_PATH . DS . 'Vendor';
const LIBRARY_PATH = VENDOR_PATH . DS . 'Library';
const SRC_PATH = ROOT_PATH . DS . 'Src';

require_once VENDOR_PATH . DS . 'autoloader.php';

$autoloader = new \Vendor\autoloader();
$autoloader->register();

$request = new \Vendor\Library\Request();
$response = new \Vendor\Library\Response();


$bootstrap = new \Vendor\Library\Bootstrap();
$container = $bootstrap->getContainer();

$router = new \Vendor\Library\Router($container, $request, $response);
$router->route();

$dispatcher = new \Vendor\Library\Dispatcher($container, $request, $response);
$view = $dispatcher->dispatch();

$renderer = new \Vendor\Library\ViewRenderer($container, $request, $response, $view);
$renderer->render();

echo $response->getBody();
