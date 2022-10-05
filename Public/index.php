<?php

const DS = DIRECTORY_SEPARATOR;
const PUBLIC_PATH = __DIR__;
define('ROOT_PATH', dirname(PUBLIC_PATH));
const VENDOR_PATH = ROOT_PATH . DS . 'Vendor';
const LIBRARY_PATH = VENDOR_PATH . DS . 'Library';
const SRC_PATH = ROOT_PATH . DS . 'Src';

require_once VENDOR_PATH . DS . 'autoloader.php';

\Vendor\autoloader::register();

$request = new \Vendor\Library\Request();
$response = new \Vendor\Library\Response();

$bootstrap = new \Vendor\Library\Bootstrap();
$container = $bootstrap->getContainer();

try {
    $router = new \Vendor\Library\Router($container, $request, $response);
    $router->route();

    $dispatcher = new \Vendor\Library\Dispatcher($container, $request, $response);
    $dispatcher->dispatch();
} catch (Exception $e) {
    $code = (string)$e->getCode();
    if(! isset($container->getConfiguration()->getConfig()['routes'][$code]) ) {
        $code = '500';
    }

    $navigationService = $container->get(\Vendor\Library\Services\NavigationService::class);
    $redirect = new \Vendor\Library\ResponseStrategy\RedirectResponse($navigationService);
    $redirect->toRoute($code);
} catch(Error $e){
    die($e->getMessage());
}


